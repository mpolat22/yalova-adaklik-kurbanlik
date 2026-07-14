<section class="section pt-0 pb-16 sm:pb-20">
    <div class="shell">
        <article class="relative overflow-hidden rounded-[2.4rem] border border-[#d8d0c3] bg-[linear-gradient(135deg,#fbf6ef_0%,#f3efe6_42%,#eef2ea_100%)] px-6 py-8 shadow-[0_28px_90px_rgba(73,54,34,0.10)] sm:px-8 sm:py-10 lg:px-12 lg:py-12">
            <div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top_left,rgba(184,130,74,0.22),transparent_58%),radial-gradient(circle_at_top_right,rgba(111,118,105,0.18),transparent_52%)]"></div>
            <div class="absolute -left-16 bottom-0 h-44 w-44 rounded-full bg-[#d8b184]/18 blur-3xl"></div>
            <div class="absolute -right-10 top-16 h-36 w-36 rounded-full bg-[#9faa95]/18 blur-3xl"></div>

            <div class="relative z-10 flex justify-center">
                <span class="section-badge">Hakkımızda</span>
            </div>

            <h2
                class="relative z-10 mx-auto mt-5 max-w-5xl text-center text-3xl font-extrabold leading-[1.04] text-brand-900 sm:text-4xl lg:text-[3.1rem]"
                data-home-about-heading
            >
                Yalova'da Güvenilir Adaklık ve Kurbanlık Hizmeti
            </h2>

            <div class="relative z-10 mt-8 grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center lg:gap-12" data-home-about-grid>
                <div class="max-w-3xl">
                    <p class="max-w-3xl text-base leading-8 text-[#5f625b] sm:text-[1.06rem] sm:leading-9">
                        Yaklaşık 30 yıldır Yalova Çiftlikköy'de adaklık koyun, kuzu, koç ve keçi yetiştiriciliği yapıyor; İslami usullere uygun kesim anlayışımızla adak ve kurban ibadetlerinizi güvenle yerine getirmenize yardımcı oluyoruz.
                    </p>
                    <p class="mt-4 max-w-3xl text-base leading-8 text-[#5f625b] sm:text-[1.06rem] sm:leading-9">
                        Sağlıklı ve bakımlı küçükbaş hayvanlarımız, şeffaf hizmet anlayışımız ve müşteri memnuniyetine verdiğimiz önemle Yalova'da güvenilir adaklık ve kurbanlık hizmeti sunmaya devam ediyoruz.
                    </p>
                    <a href="{{ route('about') }}" class="button-primary group mt-8 inline-flex min-h-12 gap-2.5 px-6 py-3 text-sm shadow-[0_12px_26px_rgba(44,48,44,0.16)]">
                        Hakkımızda
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <path d="m7.5 4.5 5.5 5.5-5.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <a
                    href="{{ route('about') }}"
                    aria-label="Hakkımızda sayfasını inceleyin"
                    class="group relative block min-h-[19rem] overflow-hidden rounded-[2rem] border border-white/75 bg-[#dfe3d9] shadow-[0_20px_52px_rgba(73,54,34,0.14)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_26px_60px_rgba(73,54,34,0.20)] sm:min-h-[24rem]"
                    style="background-image: url('{{ asset('images/yalova-adaklik-kurbanlik-hakkimizda-ana-sayfa.webp') }}?v=20260714'); background-position: 32% center; background-size: cover;"
                >
                    <span class="absolute inset-0 bg-[linear-gradient(180deg,rgba(24,29,24,0.03)_24%,rgba(24,29,24,0.25)_100%)] transition duration-300 group-hover:bg-[linear-gradient(180deg,rgba(24,29,24,0.01)_24%,rgba(24,29,24,0.18)_100%)]"></span>
                </a>
            </div>
        </article>
    </div>
</section>
