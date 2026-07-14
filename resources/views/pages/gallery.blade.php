@extends('layouts.site')

@section('content')
    <x-page-hero
        image="images/yalova-adaklik-kurbanlik-hero-ferah.webp"
        alt="Yalova Elgin Adaklık ve Kurbanlık galeri görselleri"
        title="Yalova Elgin Adaklık ve Kurbanlık Galerisi"
        description="Yalova Çiftlikköy’deki işletmemize, küçükbaş hayvanlarımıza ve adaklık ile kurbanlık hizmetlerimize ait fotoğraf ve videoları inceleyebilirsiniz."
        width="1672"
        height="941"
    />

    <section class="section pt-6 pb-8 sm:pt-8 sm:pb-10">
        <div class="shell">
            <div class="max-w-4xl">
                <span class="text-[0.78rem] font-extrabold uppercase tracking-[0.26em] text-brand-500">Galeri</span>
                <h2 class="mt-4 text-3xl font-extrabold leading-[1.06] text-brand-900 sm:text-4xl lg:text-[3rem] lg:tracking-[-0.03em]">
                    Yalova Adaklık ve Kurbanlık Galerisi
                </h2>
                <p class="mt-6 max-w-3xl text-lg font-medium leading-9 text-brand-800 sm:text-[1.15rem]">
                    Galerimizde Yalova Çiftlikköy’deki işletmemizi, yetiştirdiğimiz koyun, kuzu, koç ve keçileri; adaklık ve kurbanlık hizmetlerimizin farklı aşamalarını güncel fotoğraf ve videolarla yakından inceleyebilirsiniz. Küçükbaş seçeneklerimiz ve sunduğumuz süreçler hakkında ayrıntılı bilgi için
                    <a href="{{ route('adaklik') }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-gallery-intro-link>Yalova adaklık</a>,
                    <a href="{{ route('kurbanlik') }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-gallery-intro-link>Yalova kurbanlık</a>
                    ve
                    <a href="{{ route('services') }}" class="font-extrabold text-brand-800 underline decoration-brand-300 underline-offset-4 transition hover:text-brand-600" data-gallery-intro-link>Hizmetlerimiz</a>
                    sayfalarımızı ziyaret edebilirsiniz.
                </p>
            </div>
        </div>
    </section>

    <section class="section pt-8 pb-6 sm:pt-10" data-gallery-root>
        <div class="shell">
            <div class="mb-6 text-center sm:mb-8">
                <span class="inline-flex rounded-full border border-brand-300/70 bg-brand-50 px-4 py-1 text-[0.72rem] font-semibold uppercase tracking-[0.28em] text-brand-700">
                    Görseller
                </span>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-brand-900 sm:text-[2.2rem]">
                    İşletmemizden Güncel Fotoğraflar
                </h2>
            </div>

            @if ($galleryItems->isEmpty())
                <div class="mx-auto max-w-3xl rounded-[2rem] border border-brand-200/70 bg-white/88 px-8 py-12 text-center shadow-[0_20px_48px_rgba(44,48,44,0.08)]">
                    <h3 class="text-2xl font-extrabold text-brand-900">Galeri görselleri yakında burada olacak</h3>
                    <p class="mt-4 text-base leading-8 text-ink-500">
                        Yeni görseller eklendikçe bu sayfada yayınlanacaktır.
                    </p>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    @foreach ($galleryItems as $index => $galleryItem)
                        <article class="overflow-hidden rounded-[2rem] border border-brand-200/70 bg-white/92 shadow-[0_18px_46px_rgba(44,48,44,0.08)]">
                            <button
                                type="button"
                                class="group relative block w-full overflow-hidden text-left focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-inset"
                                data-gallery-page-item
                                data-gallery-item
                                data-gallery-index="{{ $index }}"
                                data-gallery-src="{{ $galleryItem['url'] }}"
                                data-gallery-alt="{{ $galleryItem['alt'] }}"
                                aria-label="{{ $galleryItem['alt'] }} görselini büyüt"
                            >
                                <img
                                    src="{{ $galleryItem['url'] }}"
                                    alt="{{ $galleryItem['alt'] }}"
                                    class="aspect-[4/4.8] w-full object-cover transition duration-500 group-hover:scale-[1.04]"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <span class="absolute inset-0 bg-black/0 transition duration-300 group-hover:bg-black/10" aria-hidden="true"></span>
                                <span class="absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full border border-white/70 bg-white/90 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] text-brand-900 opacity-0 shadow-lg transition duration-300 group-hover:opacity-100 group-focus-visible:opacity-100">
                                    Büyüt
                                </span>
                            </button>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <div
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#171915]/92 p-3 backdrop-blur-sm sm:p-6"
        data-gallery-lightbox-root
        role="dialog"
        aria-modal="true"
        aria-hidden="true"
        aria-label="Büyütülmüş galeri görseli"
    >
        <div class="absolute inset-0" data-gallery-lightbox-backdrop aria-hidden="true"></div>

        <p class="absolute left-4 top-4 z-20 rounded-full bg-black/40 px-3 py-1.5 text-sm font-bold text-white sm:left-6 sm:top-6" data-gallery-lightbox-counter aria-live="polite"></p>

        <button
            type="button"
            class="absolute right-4 top-4 z-30 inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/40 bg-black/45 text-3xl font-light leading-none text-white shadow-xl transition hover:bg-black/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white sm:right-6 sm:top-6"
            data-gallery-lightbox-close
            aria-label="Galeriyi kapat"
            aria-keyshortcuts="Escape"
        >
            <span aria-hidden="true">&times;</span>
        </button>

        <button
            type="button"
            class="absolute left-3 top-1/2 z-30 inline-flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/40 bg-black/45 text-4xl font-light leading-none text-white shadow-xl transition hover:bg-black/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white sm:left-6 sm:h-14 sm:w-14"
            data-gallery-lightbox-prev
            aria-label="Önceki görsel"
            aria-keyshortcuts="ArrowLeft"
        >
            <span aria-hidden="true">&lsaquo;</span>
        </button>

        <figure class="relative z-10 flex max-h-full max-w-full flex-col items-center justify-center">
            <img
                data-gallery-lightbox-image
                alt=""
                class="max-h-[calc(100vh-7rem)] max-w-[calc(100vw-2rem)] rounded-[1.4rem] object-contain shadow-[0_28px_100px_rgba(0,0,0,0.45)] sm:max-w-[calc(100vw-8rem)]"
                decoding="async"
            >
            <figcaption class="mt-3 max-w-3xl px-16 text-center text-sm font-semibold leading-6 text-white/90" data-gallery-lightbox-caption></figcaption>
        </figure>

        <button
            type="button"
            class="absolute right-3 top-1/2 z-30 inline-flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/40 bg-black/45 text-4xl font-light leading-none text-white shadow-xl transition hover:bg-black/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white sm:right-6 sm:h-14 sm:w-14"
            data-gallery-lightbox-next
            aria-label="Sonraki görsel"
            aria-keyshortcuts="ArrowRight"
        >
            <span aria-hidden="true">&rsaquo;</span>
        </button>
    </div>
    <section class="section pt-6 pb-10 sm:pt-8 sm:pb-14">
        <div class="shell">
            <div class="mb-6 text-center sm:mb-8">
                <span class="inline-flex rounded-full border border-brand-300/70 bg-brand-50 px-4 py-1 text-[0.72rem] font-semibold uppercase tracking-[0.28em] text-brand-700">
                    Videolar
                </span>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-brand-900 sm:text-[2.2rem]">
                    İşletmemizden Kısa Videolar
                </h2>
            </div>

            @if ($videoItems->isEmpty())
                <div class="mx-auto max-w-3xl rounded-[2rem] border border-brand-200/70 bg-white/88 px-8 py-12 text-center shadow-[0_20px_48px_rgba(44,48,44,0.08)]">
                    <h3 class="text-2xl font-extrabold text-brand-900">Galeri videoları yakında burada olacak</h3>
                    <p class="mt-4 text-base leading-8 text-ink-500">
                        İlk mp4 videoları eklediğinizde bu bölüm otomatik olarak dolacaktır.
                    </p>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    @foreach ($videoItems as $videoItem)
                        <article class="overflow-hidden rounded-[2rem] border border-brand-200/70 bg-white/92 shadow-[0_18px_46px_rgba(44,48,44,0.08)]">
                            <video
                                class="aspect-[4/4.8] w-full bg-brand-950 object-cover"
                                controls
                                preload="metadata"
                                playsinline
                            >
                                <source src="{{ $videoItem['url'] }}" type="video/mp4">
                                Tarayıcınız video oynatmayı desteklemiyor.
                            </video>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
