@extends('layouts.site')

@section('content')
    <x-page-hero
        image="images/yalova-adaklik-kurbanlik-hero-ferah.webp"
        alt="Yalova Elgin Adaklık ve Kurbanlık için gündüz merada otlayan küçükbaş sürüsü"
        title="Yalova Elgin Adaklık ve Kurbanlık Hakkında"
        description="Yaklaşık 30 yıllık tecrübemizle Yalova Çiftlikköy’de küçükbaş yetiştiriyor; adaklık ve kurbanlık süreçlerini İslami usullere uygun şekilde yürütüyoruz."
        width="1672"
        height="941"
    />

    <section class="section pt-6 pb-8 sm:pt-8 sm:pb-10">
        <div class="shell">
            <div class="grid gap-8 lg:grid-cols-[1.05fr_0.75fr] lg:items-start lg:gap-12">
                <div class="max-w-3xl">
                    <span class="text-[0.78rem] font-extrabold uppercase tracking-[0.26em] text-brand-500" data-about-section-eyebrow>
                        Hakkımızda
                    </span>

                    <h2 class="mt-4 max-w-3xl text-3xl font-extrabold leading-[1.05] text-brand-900 sm:text-4xl lg:text-[3rem] lg:tracking-[-0.03em]" data-about-content-heading>
                        Yalova’da İslami Usullere Uygun Adaklık ve Kurbanlık Hizmeti
                    </h2>

                    <p class="mt-6 max-w-3xl text-lg font-medium leading-9 text-brand-800 sm:text-[1.15rem]">
                        Elgin Adaklık ve Kurbanlık olarak Yalova’nın Çiftlikköy ilçesinde koyun, kuzu, koç ve keçi yetiştiriyoruz. Yaklaşık 30 yıllık tecrübemizle hayvanların düzenli bakımına, sağlık durumlarının açıkça paylaşılmasına ve kesimlerin İslami usullere uygun biçimde gerçekleştirilmesine özen gösteriyoruz.
                    </p>

                    <p class="mt-5 max-w-3xl text-base leading-8 text-ink-500 sm:text-[1.02rem] sm:leading-9">
                        Adak, akika ve şükür kurbanı ihtiyaçları için
                        <a href="{{ route('adaklik') }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-about-content-link>Yalova adaklık hizmetimizde</a>;
                        Kurban Bayramı ve diğer dönemlerde ise
                        <a href="{{ route('kurbanlik') }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-about-content-link>Yalova kurbanlık seçeneklerimizde</a>
                        ihtiyaca ve bütçeye uygun küçükbaşları birlikte değerlendiriyoruz. Kesim sonrasında
                        <a href="{{ route('services.show', ['slug' => 'yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme']) }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-about-content-link>ücretsiz parçalama ve paketleme hizmeti</a>
                        sunuyor, süreci kapalı ve hijyenik ortamda titizlikle tamamlıyoruz.
                    </p>

                    <p class="mt-5 max-w-3xl text-base leading-8 text-ink-500 sm:text-[1.02rem] sm:leading-9">
                        Yalova Merkez, Çiftlikköy, Altınova, Çınarcık, Termal ve çevresinden bize ulaşan kişilere açık ve anlaşılır bilgi veriyoruz. Şehir dışında bulunanlar için
                        <a href="{{ route('services.show', ['slug' => 'yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim']) }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-about-content-link>vekâlet ile kesim ve dağıtım hizmeti</a>
                        sunuyor, kesim sırasında görüntülü aramayla süreci takip etmelerini sağlıyoruz. Telefon, WhatsApp ve konum bilgilerimiz için
                        <a href="{{ route('contact') }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-about-content-link>iletişim sayfamızı</a>
                        inceleyebilirsiniz.
                    </p>
                </div>

                <div class="mx-auto w-full max-w-[24rem] overflow-hidden rounded-[2rem] border border-brand-200/70 bg-white/80 shadow-[0_20px_60px_rgba(44,48,44,0.08)] lg:self-start">
                    <img
                        src="{{ asset('images/ciftlikkoy-yalova-adaklik-kurbanlik-hakkimizda-dikey.webp') }}"
                        alt="Yalova Elgin Adaklık ve Kurbanlık için kuzu görseli"
                        class="aspect-[9/16] h-full w-full object-cover object-center"
                        width="938"
                        height="1668"
                        sizes="(min-width: 1024px) 384px, 90vw"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="shell">
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" data-about-trust-grid>
                <article class="group relative overflow-hidden rounded-[1.7rem] border border-[#decdb8] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-[#c98f54] hover:bg-white/88 hover:shadow-[0_20px_42px_rgba(73,54,34,0.11)]" data-about-trust-card>
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#c98f54] text-white shadow-[0_10px_24px_rgba(201,143,84,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="12" cy="12" r="8.25"></circle>
                                <path d="M12 7.5v4.9l3.1 1.9"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[0.72rem] font-extrabold uppercase tracking-[0.2em] text-[#9d6d43]">Tecrübe</p>
                            <h3 class="mt-2 text-[1.06rem] font-extrabold leading-7 text-brand-900">30 Yıllık Küçükbaş Yetiştiriciliği</h3>
                        </div>
                    </div>
                    <p class="mt-3 text-sm leading-7 text-brand-700">
                        Yalova Çiftlikköy’de koyun, kuzu, koç ve keçi yetiştiriciliğinde yaklaşık 30 yıllık bilgi ve deneyimimizle hizmet veriyoruz.
                    </p>
                </article>

                <article class="group relative overflow-hidden rounded-[1.7rem] border border-[#cfe0cf] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-[#6f8a67] hover:bg-white/88 hover:shadow-[0_20px_42px_rgba(73,54,34,0.11)]" data-about-trust-card>
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#6f8a67] text-white shadow-[0_10px_24px_rgba(111,138,103,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M12 3.75 19 7.2v4.9c0 4-2.75 6.9-7 8.15-4.25-1.25-7-4.15-7-8.15V7.2l7-3.45Z"></path>
                                <path d="m8.5 12 2.2 2.2 4.8-4.8"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[0.72rem] font-extrabold uppercase tracking-[0.2em] text-[#6f8a67]">İslami Hassasiyet</p>
                            <h3 class="mt-2 text-[1.06rem] font-extrabold leading-7 text-brand-900">İslami Usullere Uygun Kesim</h3>
                        </div>
                    </div>
                    <p class="mt-3 text-sm leading-7 text-brand-700">
                        Adak, akika, şükür ve kurban kesimlerini dini hassasiyetleri gözeterek, kapalı ve hijyenik ortamda titizlikle gerçekleştiriyoruz.
                    </p>
                </article>

                <article class="group relative overflow-hidden rounded-[1.7rem] border border-[#decdb8] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-[#c98f54] hover:bg-white/88 hover:shadow-[0_20px_42px_rgba(73,54,34,0.11)]" data-about-trust-card>
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#c98f54] text-white shadow-[0_10px_24px_rgba(201,143,84,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M4.75 8.25 12 4.5l7.25 3.75L12 12 4.75 8.25Z"></path>
                                <path d="M4.75 8.25v7.5L12 19.5l7.25-3.75v-7.5"></path>
                                <path d="M12 12v7.5"></path>
                                <path d="m8.2 15.35 1.45 1.45 3.15-3.15"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[0.72rem] font-extrabold uppercase tracking-[0.2em] text-[#9d6d43]">Kesim Sonrası</p>
                            <h3 class="mt-2 text-[1.06rem] font-extrabold leading-7 text-brand-900">Ücretsiz Parçalama ve Paketleme</h3>
                        </div>
                    </div>
                    <p class="mt-3 text-sm leading-7 text-brand-700">
                        Kesim sonrası parçalama ve paketleme işlemlerini ek ücret talep etmeden, temiz ve düzenli biçimde tamamlıyoruz.
                    </p>
                </article>

                <article class="group relative overflow-hidden rounded-[1.7rem] border border-[#cfe0cf] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-[#6f8a67] hover:bg-white/88 hover:shadow-[0_20px_42px_rgba(73,54,34,0.11)]" data-about-trust-card>
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#6f8a67] text-white shadow-[0_10px_24px_rgba(111,138,103,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <rect x="4" y="6.5" width="11" height="11" rx="2.4"></rect>
                                <path d="M15 10.25 20 7.75v8.5l-5-2.5"></path>
                                <path d="M8.2 12.1 9.8 13.7l3.2-3.2"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[0.72rem] font-extrabold uppercase tracking-[0.2em] text-[#6f8a67]">Vekâlet</p>
                            <h3 class="mt-2 text-[1.06rem] font-extrabold leading-7 text-brand-900">Vekâlet ile Kesim ve Dağıtım</h3>
                        </div>
                    </div>
                    <p class="mt-3 text-sm leading-7 text-brand-700">
                        Şehir dışında olsanız da vekâletinizi alıyor, kesim sırasında sizi görüntülü arıyor ve dağıtım sürecini adınıza güvenle tamamlıyoruz.
                    </p>
                </article>
            </div>
        </div>
    </section>
@endsection