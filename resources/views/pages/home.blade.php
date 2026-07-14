@extends('layouts.site')

@section('content')
    <x-page-hero
        image="images/yalova-adaklik-kurbanlik-hero-ferah.webp"
        alt="Yalova Elgin Adaklık ve Kurbanlık küçükbaş sürüsü"
        title="Yalova Elgin Adaklık ve Kurbanlık"
        description="Yalova'da adaklık ve kurbanlık ihtiyacı için özenle yetiştirilen küçükbaş sunuyor, İslami hassasiyet ve düzenli bakım anlayışıyla süreci güven veren şekilde yürütüyoruz."
        width="1672"
        height="941"
    />

    <section class="section pb-10 sm:pb-14">
        <div class="shell">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-[2rem] font-extrabold text-brand-900 sm:text-[2.35rem] lg:text-[2.7rem] lg:whitespace-nowrap">
                    Her Bütçeye Uygun Adak ve Kurbanlıklar
                </h2>
                <p class="mx-auto mt-6 max-w-4xl text-lg leading-9 text-ink-500 sm:text-[1.08rem]">
                    Adak, akika, şükür kurbanı ve kurban bayramı için özenle yetiştirilen küçükbaş hizmeti sunuyoruz. İslami usullere uygun, temiz ve düzenli bir hizmet anlayışıyla; satış, kesim ve teslim sürecini titizlikle yürütüyor, her aşamada açık iletişim ve güven veren yaklaşımı ön planda tutuyoruz. Yalova merkez başta olmak üzere bize ulaşan ailelerin ihtiyacına uygun seçenekler sunarak süreci daha sade ve huzurlu hale getiriyoruz.
                </p>

                <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row sm:gap-4">
                    <a
                        href="{{ route('contact') }}"
                        class="button-primary group min-h-14 w-full gap-3 px-7 py-3.5 shadow-[0_14px_32px_rgba(44,48,44,0.18)] hover:shadow-[0_18px_38px_rgba(44,48,44,0.24)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 sm:w-auto"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M8.5 19.5 4 21l1.5-4.5A8 8 0 1 1 8.5 19.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.5 10.5h7M8.5 14h4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                        <span>İletişime Geçin</span>
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <path d="m7.5 4.5 5.5 5.5-5.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                    <a
                        href="tel:05413649379"
                        class="group inline-flex min-h-14 w-full items-center justify-center gap-3 rounded-full border border-brand-300/80 bg-white/90 px-7 py-3.5 text-sm font-bold text-brand-900 shadow-[0_10px_28px_rgba(44,48,44,0.08)] transition duration-300 hover:-translate-y-0.5 hover:border-brand-500 hover:bg-brand-50 hover:shadow-[0_16px_34px_rgba(44,48,44,0.13)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 sm:w-auto"
                    >
                        <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-100 text-brand-700 transition-colors duration-300 group-hover:bg-brand-200">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="M6.6 3.8 8.15 6.9 6.85 8.05c.9 1.95 2.15 3.2 4.1 4.1l1.15-1.3 3.1 1.55-.55 2.05c-.13.5-.58.85-1.1.85C8.15 15.3 4.7 11.85 4.7 6.35c0-.52.35-.97.85-1.1l2.05-.55Z" stroke="currentColor" stroke-width="1.55" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="text-left leading-tight">
                            <span class="block text-[0.68rem] font-extrabold uppercase tracking-[0.16em] text-brand-500">Hemen Arayın</span>
                            <span class="mt-0.5 block">0541 364 93 79</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.home-experience-section')
    @include('partials.home-discovery-links')
    @include('partials.service-carousel', [
        'carouselServices' => $services,
        'carouselEyebrow' => 'Hizmetlerimiz',
        'carouselTitle' => 'Yalova’da Adaklık ve Kurbanlık Hizmetlerimiz',
        'carouselDescription' => 'Yalova ve Çiftlikköy’de adaklık, kurbanlık, akika ve şükür kurbanı ihtiyaçlarınız için küçükbaş hayvan seçenekleri sunuyor; İslami usullere uygun hijyenik kesim, ücretsiz parçalama ve paketleme, vekâletle kesim ve dağıtım hizmetleri sağlıyoruz. Uygun fiyat, kolay ödeme ve şeffaf bilgilendirme anlayışımızla süreci baştan sona güvenle yürütüyoruz.',
        'homeServices' => true,
    ])
    @include('partials.home-gallery-carousel', [
        'galleryItems' => $galleryItems,
    ])
    @include('partials.home-faq', [
        'faqs' => $faqs,
    ])
@endsection
