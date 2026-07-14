# Elgin Adaklık ve Kurbanlık

`yalovaadaklikkurbanlik.com` için hazırlanmış Laravel 12 tabanlı kurumsal web sitesidir.

## Gereksinimler

- PHP 8.2 veya üzeri
- Composer 2
- Node.js ve npm
- Apache veya Nginx
- HTTPS sertifikası

Web sunucusunun yayın kökü mutlaka projenin `public` klasörü olmalıdır. `.env`, `storage`, kaynak kodları ve diğer uygulama dosyaları doğrudan web üzerinden erişilebilir olmamalıdır.

## Yerel geliştirme

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
php artisan serve
```

## İlk sunucu kurulumu

1. Git deposunu sunucuda örneğin `/var/www/yalovaadaklikkurbanlik` dizinine klonlayın.
2. `.env.production.example` dosyasını `.env` adıyla kopyalayın.
3. `php artisan key:generate` komutuyla üretim anahtarını oluşturun.
4. `storage` ve `bootstrap/cache` klasörlerine web sunucusu kullanıcısı için yazma izni verin.
5. Web sunucusunun document root değerini `/var/www/yalovaadaklikkurbanlik/public` olarak ayarlayın.
6. DNS kayıtları sunucuya yönlendikten sonra `yalovaadaklikkurbanlik.com` ve `www.yalovaadaklikkurbanlik.com` için HTTPS sertifikası oluşturun.

Nginx için başlangıç şablonu `deploy/nginx/yalovaadaklikkurbanlik.com.conf.example` dosyasındadır. Sunucudaki PHP-FPM sürümü ve proje yolu kullanılmadan önce kontrol edilmelidir.

## Etiketle canlıya alma

Canlı sürümler `vMAJOR.MINOR.PATCH` biçiminde etiketlenir. Örnek:

```bash
git add .
git commit -m "Site içeriğini güncelle"
git push origin main
git tag -a v1.0.1 -m "v1.0.1"
git push origin v1.0.1
```

Ardından sunucuda:

```bash
cd /var/www/yalovaadaklikkurbanlik
bash deploy/deploy.sh v1.0.1
```

Dağıtım betiği yalnızca sürüm etiketlerini kabul eder; bağımlılıkları üretim modunda kurar, ön yüz dosyalarını derler ve Laravel önbelleklerini yeniler. Sunucudaki `.env` dosyası Git'e eklenmez ve sürümler arasında korunur.

## Kanonik domain

Sitenin kanonik adresi `https://yalovaadaklikkurbanlik.com` olarak belirlenmiştir. `www` ve HTTP istekleri web sunucusu katmanında bu adrese 301 yönlendirilmelidir.
