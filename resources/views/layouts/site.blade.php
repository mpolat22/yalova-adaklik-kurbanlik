<!DOCTYPE html>
<html lang="tr">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7LPT3RVJDW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-7LPT3RVJDW');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="{{ $site['legal_name'] }}">
    <meta name="theme-color" content="#7a3f24">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta http-equiv="content-language" content="tr-TR">
    <link rel="canonical" href="{{ $meta['canonical'] }}">
    <link rel="alternate" hreflang="tr-TR" href="{{ $meta['canonical'] }}">
    <meta property="og:type" content="{{ $meta['type'] }}">
    <meta property="og:locale" content="tr_TR">
    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:url" content="{{ $meta['canonical'] }}">
    <meta property="og:site_name" content="{{ $site['legal_name'] }}">
    <meta property="og:image" content="{{ $meta['image'] }}">
    <meta property="og:image:alt" content="{{ $meta['image_alt'] }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] }}">
    <meta name="twitter:description" content="{{ $meta['description'] }}">
    <meta name="twitter:image" content="{{ $meta['image'] }}">
    <meta name="twitter:image:alt" content="{{ $meta['image_alt'] }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Cormorant+Garamond:wght@500;600;700&family=Cinzel:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @foreach ($schemas as $schema)
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @endforeach
</head>
<body>
    @php
        $galleryLink = [
            'label' => 'Galeri',
            'href' => route('gallery'),
            'active' => request()->routeIs('gallery'),
        ];

        $navigationLinks = collect($navLinks)
            ->map(function (array $link): array {
                return array_merge($link, [
                    'active' => ($link['active'] ?? false) || url()->current() === $link['href'],
                ]);
            })
            ->flatMap(function (array $link) use ($galleryLink): array {
                if (($link['label'] ?? null) === 'İletişim') {
                    return [$galleryLink, $link];
                }

                return [$link];
            })
            ->when(
                ! collect($navLinks)->contains(fn (array $link): bool => ($link['label'] ?? null) === 'İletişim'),
                fn ($links) => $links->push($galleryLink)
            )
            ->unique('href')
            ->values()
            ->all();
    @endphp


    <header class="sticky top-0 z-30 border-b border-brand-200/60 bg-white/75 backdrop-blur-xl">
        <div class="shell relative flex items-center justify-between gap-5 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-brand-800">
                <span class="inline-flex h-16 w-16 items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/elgin-logo.png') }}" alt="Elgin Adaklık ve Kurbanlık logosu" class="h-full w-full object-contain mix-blend-multiply" />
                </span>
                <span class="flex flex-col items-center justify-center leading-none text-center">
                    <span class="text-[2.1rem] font-bold tracking-[0.14em] text-brand-900 sm:text-[2.25rem]" style="font-family: var(--font-logo);">Elgin</span>
                    <span class="mt-1 text-[0.82rem] font-semibold tracking-[0.08em] text-brand-700 sm:text-[0.9rem]" style="font-family: var(--font-logo);">Adaklık ve Kurbanlık</span>
                </span>
            </a>

            <div class="lg:absolute lg:left-1/2 lg:top-1/2 lg:-translate-x-1/2 lg:-translate-y-1/2"
                data-site-nav
                data-props='@json([
                    "links" => $navigationLinks,
                ])'
            ></div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @include('partials.floating-contact')

    @include('partials.contact-cta')

    <footer class="mt-10 border-t border-brand-200/60 bg-[#f8f6f1]/70">
        <div class="shell py-12">
            <div
                class="footer-carousel -mx-4 flex snap-x snap-mandatory gap-4 overflow-x-auto overscroll-x-contain px-4 pb-4 lg:mx-0 lg:grid lg:grid-cols-[1.2fr_0.8fr_1fr] lg:gap-10 lg:overflow-visible lg:px-0 lg:pb-0"
                data-footer-carousel
                role="region"
                aria-label="Site bilgileri, hızlı bağlantılar ve iletişim"
            >
                <section class="min-w-[88%] snap-start rounded-[1.8rem] border border-brand-200/70 bg-white/78 p-6 shadow-[0_16px_44px_rgba(73,54,34,0.07)] sm:min-w-[72%] lg:min-w-0 lg:rounded-none lg:border-0 lg:bg-transparent lg:p-0 lg:shadow-none">
                    <h2>
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-brand-800">
                            <span class="inline-flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/elgin-logo.png') }}" alt="Elgin Adaklık ve Kurbanlık logosu" class="h-full w-full object-contain mix-blend-multiply" loading="lazy" />
                            </span>
                            <span class="flex flex-col items-center justify-center text-center leading-none">
                                <span class="text-[2rem] font-bold tracking-[0.14em] text-brand-900" style="font-family: var(--font-logo);">Elgin</span>
                                <span class="mt-1 text-[0.8rem] font-semibold tracking-[0.08em] text-brand-700" style="font-family: var(--font-logo);">Adaklık ve Kurbanlık</span>
                            </span>
                        </a>
                    </h2>
                    <p class="mt-5 max-w-xl text-base leading-8 text-ink-500">
                        Yalova'nın Çiftlikköy ilçesinde yaklaşık 30 yıllık tecrübemizle adaklık, kurbanlık, akika ve şükür kurbanı hizmeti sunuyor; küçükbaş hayvan seçimi, İslami usullere uygun kesim, parçalama ve paketleme süreçlerini titizlikle yürütüyoruz.
                    </p>
                </section>

                <section class="min-w-[82%] snap-start rounded-[1.8rem] border border-brand-200/70 bg-white/78 p-6 shadow-[0_16px_44px_rgba(73,54,34,0.07)] sm:min-w-[56%] lg:min-w-0 lg:rounded-none lg:border-0 lg:bg-transparent lg:p-0 lg:shadow-none">
                    <h2 class="mb-5 text-sm font-extrabold uppercase tracking-[0.2em] text-brand-500">Hızlı Bağlantılar</h2>
                    <ul class="space-y-3 text-ink-500">
                        @foreach ($navigationLinks as $link)
                            <li>
                                <a href="{{ $link['href'] }}" class="inline-flex font-semibold transition hover:translate-x-1 hover:text-brand-700">
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <section class="min-w-[92%] snap-start rounded-[1.8rem] border border-brand-200/70 bg-white/78 p-6 shadow-[0_16px_44px_rgba(73,54,34,0.07)] sm:min-w-[72%] lg:min-w-0 lg:rounded-none lg:border-0 lg:bg-transparent lg:p-0 lg:shadow-none">
                    <h2 class="mb-5 text-sm font-extrabold uppercase tracking-[0.2em] text-brand-500">İletişim</h2>
                    <ul class="space-y-3 text-ink-500" data-footer-contact-list>
                        <li>
                            <a href="tel:+{{ $site['phone_link'] }}" class="group flex items-center gap-3 hover:text-brand-700">
                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#f0dfca] text-[#9d6d43] transition group-hover:bg-[#e8ceb0]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M6.6 3.5h2.6c.5 0 1 .4 1.1.9l.5 3.1c.1.5-.1 1-.5 1.3l-1.8 1.5a15.6 15.6 0 0 0 5.2 5.2l1.5-1.8c.3-.4.8-.6 1.3-.5l3.1.5c.5.1.9.6.9 1.1v2.6c0 .7-.6 1.3-1.3 1.3C10 20 4 14 4 6.8c0-.7.6-1.3 1.3-1.3Z"></path></svg>
                                </span>
                                <span><span class="block text-xs font-bold text-brand-500">Serhat Elgin</span><span class="font-semibold">{{ $site['phone_display'] }}</span></span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+{{ $site['secondary_phone_link'] }}" class="group flex items-center gap-3 hover:text-brand-700">
                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#f0dfca] text-[#9d6d43] transition group-hover:bg-[#e8ceb0]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M6.6 3.5h2.6c.5 0 1 .4 1.1.9l.5 3.1c.1.5-.1 1-.5 1.3l-1.8 1.5a15.6 15.6 0 0 0 5.2 5.2l1.5-1.8c.3-.4.8-.6 1.3-.5l3.1.5c.5.1.9.6.9 1.1v2.6c0 .7-.6 1.3-1.3 1.3C10 20 4 14 4 6.8c0-.7.6-1.3 1.3-1.3Z"></path></svg>
                                </span>
                                <span><span class="block text-xs font-bold text-brand-500">Sercan Elgin</span><span class="font-semibold">{{ $site['secondary_phone_display'] }}</span></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/{{ $site['whatsapp_link'] }}" target="_blank" rel="noopener" class="group flex items-center gap-3 hover:text-[#6f8a67]">
                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#dce8d8] text-[#6f8a67] transition group-hover:bg-[#cfe0ca]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor" aria-hidden="true"><path d="M19.1 4.9A9.9 9.9 0 0 0 3.3 16.8L2 22l5.3-1.3a9.9 9.9 0 0 0 4.7 1.2h.1A9.9 9.9 0 0 0 22 12 9.8 9.8 0 0 0 19.1 4.9Zm-7 15.3h-.1a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3.1.8.8-3-.2-.3a8.2 8.2 0 1 1 7.1 3.9Z"></path></svg>
                                </span>
                                <span class="font-semibold">WhatsApp'tan Ulaşın</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ $site['email'] }}" class="group flex min-w-0 items-center gap-3 hover:text-brand-700">
                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#ece4d9] text-[#8b6f4e] transition group-hover:bg-[#e3d6c5]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 16.5v-9Z"></path><path d="m5.5 7 6.5 5 6.5-5"></path></svg>
                                </span>
                                <span class="break-all font-semibold">{{ $site['email'] }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $site['maps_url'] }}" target="_blank" rel="noopener" class="group flex items-start gap-3 hover:text-brand-700">
                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#eadfd6] text-[#9b6849] transition group-hover:bg-[#dfcebf]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 20s6-5.2 6-10a6 6 0 1 0-12 0c0 4.8 6 10 6 10Z"></path><circle cx="12" cy="10" r="2.3"></circle></svg>
                                </span>
                                <span class="pt-1 font-semibold leading-6">{{ $site['address'] }}</span>
                            </a>
                        </li>
                    </ul>

                    <div class="mt-5 flex gap-2 border-t border-brand-200/70 pt-4">
                        <a href="{{ $site['instagram_url'] }}" target="_blank" rel="noopener" aria-label="Instagram" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-brand-200 bg-white text-brand-700 transition hover:border-brand-500 hover:text-brand-900">
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="4"></rect><circle cx="12" cy="12" r="4.2"></circle><circle cx="17.3" cy="6.7" r="1.1" fill="currentColor" stroke="none"></circle></svg>
                        </a>
                        <a href="{{ $site['facebook_url'] }}" target="_blank" rel="noopener" aria-label="Facebook" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-brand-200 bg-white text-brand-700 transition hover:border-brand-500 hover:text-brand-900">
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor" aria-hidden="true"><path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.6 1.7-1.6H17V4.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.4V11H7.5v3h2.8v8h3.2Z"></path></svg>
                        </a>
                    </div>
                </section>
            </div>
        </div>

        <div class="shell flex flex-col gap-3 border-t border-brand-200/60 py-5 text-sm text-ink-500 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ now()->year }} {{ $site['name'] }}. Tüm hakları saklıdır.</p>
            <div class="flex flex-wrap gap-x-4 gap-y-2">
                <span>{{ $site['district'] }}, {{ $site['city'] }}</span>
                <span>{{ $site['email'] }}</span>
            </div>
        </div>
    </footer>
</body>
</html>
