#!/usr/bin/env bash

set -Eeuo pipefail

if [[ $# -ne 1 ]]; then
    echo "Kullanım: bash deploy/deploy.sh v1.0.0" >&2
    exit 1
fi

release_ref="$1"

if [[ ! "$release_ref" =~ ^v[0-9]+\.[0-9]+\.[0-9]+([.-][0-9A-Za-z.-]+)?$ ]]; then
    echo "Geçersiz sürüm etiketi: $release_ref" >&2
    exit 1
fi

app_dir="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$app_dir"

if [[ ! -f .env ]]; then
    echo "Sunucuda .env dosyası bulunamadı." >&2
    exit 1
fi

if ! grep -Eq '^APP_ENV=production$' .env; then
    echo ".env içinde APP_ENV=production olmalıdır." >&2
    exit 1
fi

if ! grep -Eq '^APP_DEBUG=false$' .env; then
    echo ".env içinde APP_DEBUG=false olmalıdır." >&2
    exit 1
fi

if ! grep -Eq '^APP_URL=https://yalovaadaklikkurbanlik\.com/?$' .env; then
    echo "APP_URL kanonik üretim domainiyle eşleşmiyor." >&2
    exit 1
fi

if ! grep -Eq '^APP_KEY=.+$' .env; then
    echo "APP_KEY oluşturulmamış. Önce php artisan key:generate çalıştırın." >&2
    exit 1
fi

if [[ -n "$(git status --porcelain --untracked-files=no)" ]]; then
    echo "Sunucudaki Git çalışma alanında commitlenmemiş değişiklikler var." >&2
    exit 1
fi

git fetch origin --tags --prune

if ! git rev-parse --verify --quiet "refs/tags/${release_ref}^{commit}" >/dev/null; then
    echo "Sürüm etiketi uzak depoda bulunamadı: $release_ref" >&2
    exit 1
fi

maintenance_started=0

restore_application() {
    if [[ $maintenance_started -eq 1 && -f artisan && -f vendor/autoload.php ]]; then
        php artisan up || true
    fi
}

trap restore_application EXIT

if [[ -f vendor/autoload.php ]]; then
    php artisan down --retry=15
    maintenance_started=1
fi

git checkout --detach "$release_ref"

composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

npm ci --include=dev --no-audit --no-fund
npm run build

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan up

maintenance_started=0
trap - EXIT

echo "Canlı sürüm: $release_ref"
