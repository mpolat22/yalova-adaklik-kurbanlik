@extends('layouts.site')

@section('content')
    <x-page-hero
        image="images/yalova-adaklik-kurbanlik-hero-ferah.webp"
        alt="Yalova adaklık ve kurbanlık hizmetlerimiz için merada otlayan küçükbaş sürüsü"
        title="Yalova Elgin Adaklık ve Kurbanlık Hizmetlerimiz"
        description="Yalova’da adaklık ve kurbanlık ihtiyaçlarınız için küçükbaş satışı, İslami usullere uygun kesim, parçalama, paketleme ve vekâlet hizmetleri sunuyoruz."
        width="1672"
        height="941"
    />

    <section class="section pt-6 pb-8 sm:pt-8 sm:pb-10">
        <div class="shell">
            <div class="max-w-4xl">
                <span class="text-[0.78rem] font-extrabold uppercase tracking-[0.26em] text-brand-500">Hizmetlerimiz</span>
                <h2 class="mt-4 text-3xl font-extrabold leading-[1.06] text-brand-900 sm:text-4xl lg:text-[3rem] lg:tracking-[-0.03em]">
                    Yalova Adaklık ve Kurbanlık Hizmetlerimiz
                </h2>
                <p class="mt-6 max-w-3xl text-lg font-medium leading-9 text-brand-800 sm:text-[1.15rem]">
                    Yalova ve Çiftlikköy’de adaklık, kurbanlık, akika ve şükür kurbanı ihtiyaçlarınız için koyun, kuzu, koç ve keçi seçenekleri sunuyoruz. Küçükbaş hayvan satışından İslami usullere uygun hijyenik kesime, ücretsiz parçalama ve paketlemeden vekâletle kesim ve dağıtıma kadar tüm süreci açık bilgilendirme ve düzenli hizmet anlayışıyla yürütüyoruz.
                </p>
            </div>
        </div>
    </section>

    <section class="section pt-0 pb-10 sm:pb-14">
        <div class="shell">
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($services as $service)
                    @php($cardTitle = \Illuminate\Support\Str::replaceEnd(' Hizmeti', '', $service['title']))
                    <a href="{{ $service['url'] }}" class="group flex h-full flex-col overflow-hidden rounded-[1.9rem] border border-brand-200/70 bg-white/92 shadow-[0_18px_46px_rgba(44,48,44,0.08)] transition duration-300 hover:-translate-y-1.5 hover:scale-[1.02] hover:shadow-[0_26px_60px_rgba(44,48,44,0.16)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400/80" data-service-grid-card>
                        <div class="aspect-[4/5] overflow-hidden bg-brand-100">
                            <img
                                src="{{ asset(ltrim($service['image_path'], '/')) }}"
                                alt="{{ $service['image_alt'] }}"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
                                sizes="(min-width: 1280px) 22vw, (min-width: 640px) 46vw, 100vw"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>

                        <div class="flex flex-1 flex-col p-5 sm:p-6">
                            <h3 class="text-[1.45rem] font-extrabold leading-8 text-brand-900">{{ $cardTitle }}</h3>
                            <p class="mt-3 flex-1 text-sm leading-7 text-ink-500 sm:text-[0.97rem]">{{ $service['card_copy'] }}</p>
                            <span class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold text-brand-700 transition group-hover:text-brand-800">
                                Hizmetimizi İnceleyin
                                <span aria-hidden="true">&rarr;</span>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection