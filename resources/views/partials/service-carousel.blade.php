@php($homeServices = $homeServices ?? false)

<section class="section pt-0 pb-0">
    <div class="shell">
        @if ($homeServices)
            <div class="relative overflow-hidden rounded-[2.4rem] border border-[#d8d0c3] bg-[linear-gradient(135deg,#fbf6ef_0%,#f3efe6_42%,#eef2ea_100%)] px-6 py-8 shadow-[0_28px_90px_rgba(73,54,34,0.10)] sm:px-8 sm:py-10 lg:px-12 lg:py-12">
                <div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top_left,rgba(184,130,74,0.22),transparent_58%),radial-gradient(circle_at_top_right,rgba(111,118,105,0.18),transparent_52%)]"></div>
                <div class="absolute -left-16 bottom-0 h-44 w-44 rounded-full bg-[#d8b184]/18 blur-3xl"></div>
                <div class="absolute -right-10 top-16 h-36 w-36 rounded-full bg-[#9faa95]/18 blur-3xl"></div>
        @else
            <div class="section-alt border-[#ddd5c9] bg-[#f3eee6] px-6 py-6 shadow-[0_24px_60px_rgba(44,48,44,0.08)] sm:px-8 sm:py-8 lg:px-10 lg:py-10">
        @endif
            <div class="relative z-10 flex justify-center">
                <span class="{{ $homeServices ? 'section-badge' : 'eyebrow mb-0' }}">{{ $carouselEyebrow ?? 'Diğer hizmetlerimiz' }}</span>
            </div>

            @if (!empty($carouselTitle))
                <div class="relative z-10 mx-auto max-w-4xl text-center">
                    <h2 class="mt-5 text-3xl font-extrabold text-brand-900 sm:text-4xl lg:text-[3.1rem] lg:leading-[1.04]">
                        {{ $carouselTitle }}
                    </h2>
                    @if (!empty($carouselDescription))
                        <p class="mx-auto mt-5 max-w-3xl text-base leading-8 text-[#5f625b] sm:text-[1.06rem] sm:leading-9">
                            {{ $carouselDescription }}
                        </p>
                    @endif
                </div>
            @endif

            <div class="relative z-10 {{ !empty($carouselTitle) ? 'mt-8' : 'mt-6' }}" data-related-carousel>
                <button
                    type="button"
                    data-carousel-prev
                    class="absolute left-3 top-[41%] z-20 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-brand-300/80 bg-white/96 text-brand-800 shadow-[0_14px_32px_rgba(44,48,44,0.14)] transition hover:-translate-y-[55%] hover:border-brand-400 disabled:pointer-events-none disabled:opacity-35"
                    aria-label="Önceki hizmetleri göster"
                >
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                        <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <div class="overflow-hidden rounded-[1.85rem] px-1 py-1 sm:px-2 sm:py-2 xl:px-4 {{ $homeServices ? 'bg-transparent' : 'bg-[#f3eee6]' }}">
                    <div data-carousel-track class="flex gap-5 transition-transform duration-500 ease-out will-change-transform">
                        @foreach ($carouselServices as $carouselService)
                            @php($carouselCardTitle = \Illuminate\Support\Str::replaceEnd(' Hizmeti', '', $carouselService['title']))
                            <a href="{{ $carouselService['url'] }}" class="group flex min-w-0 basis-full flex-none flex-col overflow-hidden rounded-[1.9rem] border border-brand-200/70 bg-white/92 shadow-[0_18px_46px_rgba(44,48,44,0.08)] transition duration-300 hover:-translate-y-1.5 hover:scale-[1.02] hover:shadow-[0_26px_60px_rgba(44,48,44,0.16)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400/80 sm:basis-[calc((100%-1.25rem)/2)] xl:basis-[calc((100%-3.75rem)/4)]" data-carousel-card>
                                <div class="aspect-[4/4.8] overflow-hidden bg-brand-100">
                                    <img
                                        src="{{ asset(ltrim($carouselService['image_path'], '/')) }}"
                                        alt="{{ $carouselService['image_alt'] }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>

                                <div class="flex flex-1 flex-col p-5 sm:p-6">
                                    <h3 class="text-[1.32rem] font-extrabold leading-8 text-brand-900">{{ $carouselCardTitle }}</h3>
                                    <p class="mt-3 flex-1 text-sm leading-7 text-ink-500 sm:text-[0.97rem]">{{ $carouselService['card_copy'] }}</p>
                                    <span class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold text-brand-700 transition group-hover:text-brand-800">
                                        Hizmetimizi İnceleyin
                                        <span aria-hidden="true">&rarr;</span>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <button
                    type="button"
                    data-carousel-next
                    class="absolute right-3 top-[41%] z-20 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-brand-300/80 bg-white/96 text-brand-800 shadow-[0_14px_32px_rgba(44,48,44,0.14)] transition hover:-translate-y-[55%] hover:border-brand-400 disabled:pointer-events-none disabled:opacity-35"
                    aria-label="Sonraki hizmetleri göster"
                >
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                        <path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>