@if (!empty($galleryItems))
    <section class="section pb-0" data-gallery-root>
        <div class="shell">
            <div class="relative overflow-hidden rounded-[2.4rem] border border-[#d8d0c3] bg-[linear-gradient(135deg,#fbf6ef_0%,#f3efe6_42%,#eef2ea_100%)] px-6 py-8 shadow-[0_28px_90px_rgba(73,54,34,0.10)] sm:px-8 sm:py-10 lg:px-12 lg:py-12">
                <div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top_left,rgba(184,130,74,0.22),transparent_58%),radial-gradient(circle_at_top_right,rgba(111,118,105,0.18),transparent_52%)]"></div>
                <div class="absolute -left-16 bottom-0 h-44 w-44 rounded-full bg-[#d8b184]/18 blur-3xl"></div>
                <div class="absolute -right-10 top-16 h-36 w-36 rounded-full bg-[#9faa95]/18 blur-3xl"></div>

                <div class="relative z-10 flex justify-center">
                    <span class="section-badge">Galeri</span>
                </div>

                <div class="relative z-10 mx-auto max-w-4xl text-center">
                    <h2 class="mt-5 text-3xl font-extrabold text-brand-900 sm:text-4xl lg:text-[3.1rem] lg:leading-[1.04]">
                        <span class="block">Yalova Adaklık ve Kurbanlık</span>
                        <span class="mt-1 block">Galerimiz</span>
                    </h2>
                    <p class="mx-auto mt-5 max-w-3xl text-base leading-8 text-[#5f625b] sm:text-[1.06rem] sm:leading-9">
                        Yalova Çiftlikköy’deki işletmemize, küçükbaş hayvanlarımıza ve sunduğumuz adaklık ve kurbanlık hizmetlerine ait güncel fotoğrafları inceleyin.
                    </p>
                </div>

                <div class="relative z-10 mt-8" data-home-gallery-carousel>
                    <button
                        type="button"
                        data-gallery-carousel-prev
                        class="absolute left-2 top-1/2 z-20 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-brand-300/80 bg-white/96 text-3xl font-light leading-none text-brand-800 shadow-[0_14px_32px_rgba(44,48,44,0.18)] transition hover:-translate-y-[55%] hover:border-brand-400 disabled:pointer-events-none disabled:opacity-35 sm:left-3"
                        aria-label="Önceki galeri görsellerini göster"
                    >
                        <span aria-hidden="true">&lsaquo;</span>
                    </button>

                    <div class="overflow-hidden rounded-[1.85rem] px-1 py-1 sm:px-2 sm:py-2 xl:px-4">
                        <div data-gallery-carousel-track class="flex gap-5 transition-transform duration-500 ease-out will-change-transform">
                            @foreach ($galleryItems as $index => $galleryItem)
                                <button
                                    type="button"
                                    class="group relative min-w-0 basis-full flex-none overflow-hidden rounded-[1.9rem] border border-brand-200/70 bg-white/92 text-left shadow-[0_18px_46px_rgba(44,48,44,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_26px_60px_rgba(44,48,44,0.16)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 sm:basis-[calc((100%-1.25rem)/2)] xl:basis-[calc((100%-3.75rem)/4)]"
                                    data-home-gallery-item
                                    data-gallery-item
                                    data-gallery-index="{{ $index }}"
                                    data-gallery-src="{{ $galleryItem['url'] }}"
                                    data-gallery-alt="{{ $galleryItem['alt'] }}"
                                    aria-label="{{ $galleryItem['alt'] }} görselini büyüt"
                                >
                                    <img
                                        src="{{ $galleryItem['url'] }}"
                                        alt="{{ $galleryItem['alt'] }}"
                                        width="{{ $galleryItem['width'] }}"
                                        height="{{ $galleryItem['height'] }}"
                                        class="aspect-[4/4.8] w-full object-cover transition duration-500 group-hover:scale-[1.04]"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                    <span class="absolute inset-0 bg-black/0 transition duration-300 group-hover:bg-black/10" aria-hidden="true"></span>
                                    <span class="absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full border border-white/70 bg-white/90 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] text-brand-900 opacity-0 shadow-lg transition duration-300 group-hover:opacity-100 group-focus-visible:opacity-100">
                                        Büyüt
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <button
                        type="button"
                        data-gallery-carousel-next
                        class="absolute right-2 top-1/2 z-20 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-brand-300/80 bg-white/96 text-3xl font-light leading-none text-brand-800 shadow-[0_14px_32px_rgba(44,48,44,0.18)] transition hover:-translate-y-[55%] hover:border-brand-400 disabled:pointer-events-none disabled:opacity-35 sm:right-3"
                        aria-label="Sonraki galeri görsellerini göster"
                    >
                        <span aria-hidden="true">&rsaquo;</span>
                    </button>
                </div>

                <div class="relative z-10 mt-8 flex justify-center">
                    <a
                        href="{{ route('gallery') }}"
                        class="button-primary group min-h-12 gap-2.5 px-6 py-3 text-sm shadow-[0_12px_26px_rgba(44,48,44,0.16)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2"
                    >
                        Tüm Galeriyi Gör
                        <span class="transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
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
@endif