@extends('layouts.site')

@section('content')
    <section class="section">
        <div class="shell">
            <span class="eyebrow">Hizmet sayfası</span>
            <h1 class="max-w-4xl text-6xl text-brand-900 sm:text-7xl">Yalova Adaklık</h1>
            <p class="mt-6 max-w-3xl text-lg leading-9 text-ink-500">
                Yalova'da adaklık hizmeti arayan kişiler için hazırlanan bu sayfa; güven, iletişim ve süreç bilgilerini anlaşılır biçimde sunar.
            </p>
        </div>
    </section>

    <section class="section pt-0">
        <div class="shell grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
            <div class="prose-copy">
                <p>Adaklık hizmeti arayan kullanıcılar çoğu zaman önce güvenebilecekleri bir işletmeye ulaşmak ister. Bu nedenle bu sayfanın amacı yalnızca anahtar kelime yerleştirmek değil, ziyaretçiye net ve gerçek bir ilk izlenim vermektir.</p>
                <p>Hizmetin nasıl ilerlediği, hangi bölgelerde destek verildiği, nasıl iletişim kurulacağı ve süreçte nelere dikkat edildiği bu sayfada açık şekilde anlatılır. Böylece kullanıcı, tekrar arama yapmadan karar verebilecek kadar bilgiye ulaşır.</p>
                <p>Yerel aramalarda öne çıkmak için sayfa dili doğal, başlık yapısı net ve iletişim alanları görünür olmalıdır. Bu sayfa tam olarak o amaçla kurgulanır.</p>
            </div>

            <div class="section-alt p-8">
                <h2 class="text-4xl text-brand-800">Bu sayfanın görevleri</h2>
                <div class="mt-6 grid gap-4">
                    <div class="card">
                        <p class="text-2xl font-bold text-brand-800">Hizmet tanımı</p>
                        <p class="mt-2 text-base leading-8 text-ink-500">Adaklık hizmetinizin ne sunduğunu net şekilde anlatır.</p>
                    </div>
                    <div class="card">
                        <p class="text-2xl font-bold text-brand-800">Güven sinyalleri</p>
                        <p class="mt-2 text-base leading-8 text-ink-500">Adres, telefon, gerçek görsel ve açık süreç dili ile desteklenir.</p>
                    </div>
                    <div class="card">
                        <p class="text-2xl font-bold text-brand-800">İletişim akışı</p>
                        <p class="mt-2 text-base leading-8 text-ink-500">Telefon ve WhatsApp odaklı hızlı bağlantı kurar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection