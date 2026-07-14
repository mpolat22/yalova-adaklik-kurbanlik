@extends('layouts.site')

@section('content')
    <x-page-hero
        :image="$service['image_path']"
        :alt="$service['image_alt']"
        :title="$service['hero_title']"
        :description="$service['hero_description']"
        :image-position="$service['hero_image_position'] ?? 'center'"
    />

    <section class="section pt-6 pb-8 sm:pt-8 sm:pb-10">
        <div class="shell">
            @if (!empty($service['trust_cards']))
                <div>
                    <span class="text-[0.78rem] font-extrabold uppercase tracking-[0.26em] text-brand-500">{{ $service['section_eyebrow'] }}</span>
                    <h2 class="mt-4 max-w-4xl text-3xl font-extrabold leading-[1.06] text-brand-900 sm:text-4xl lg:text-[3rem] lg:tracking-[-0.03em]">
                        {{ $service['section_title'] }}
                    </h2>

                    @foreach ($service['intro_paragraphs'] as $paragraph)
                        <p class="mt-6 max-w-4xl text-base leading-9 text-ink-500 sm:text-[1.04rem]">{{ $paragraph }}</p>
                    @endforeach
                </div>

                <div @class([
                    'mt-10 grid gap-4 sm:grid-cols-2',
                    'xl:grid-cols-4' => count($service['trust_cards']) === 4,
                    'xl:grid-cols-3' => count($service['trust_cards']) !== 4,
                ])>
                    @foreach ($service['trust_cards'] as $card)
                        <article class="group relative overflow-hidden rounded-[1.7rem] border p-5 shadow-[0_16px_38px_rgba(44,48,44,0.06)] transition hover:-translate-y-0.5 hover:shadow-[0_20px_44px_rgba(44,48,44,0.09)] {{ $card['card_classes'] }}">
                            <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full blur-2xl {{ $card['glow_classes'] }}"></div>
                            <span class="relative inline-flex h-12 w-12 items-center justify-center rounded-2xl {{ $card['icon_classes'] }}">
                                @if ($card['icon'] === 'heart')
                                    <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.85" aria-hidden="true">
                                        <path d="M12 20.25S4.5 16.1 4.5 9.75A4.25 4.25 0 0 1 12 7a4.25 4.25 0 0 1 7.5 2.75c0 6.35-7.5 10.5-7.5 10.5Z"></path>
                                    </svg>
                                @elseif ($card['icon'] === 'checklist')
                                    <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.85" aria-hidden="true">
                                        <rect x="4.25" y="4.25" width="15.5" height="15.5" rx="2.5"></rect>
                                        <path d="m7.5 9.1 1.25 1.25 2-2.25M12.5 9.25h4M7.5 14.6l1.25 1.25 2-2.25M12.5 14.75h4"></path>
                                    </svg>
                                @elseif ($card['icon'] === 'clock')
                                    <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.85" aria-hidden="true">
                                        <path d="M12 5.25c-3.7 0-6.75 3.05-6.75 6.75S8.3 18.75 12 18.75 18.75 15.7 18.75 12 15.7 5.25 12 5.25Z"></path>
                                        <path d="M12 8.2v3.9l2.4 1.45"></path>
                                    </svg>
                                @elseif ($card['icon'] === 'shield')
                                    <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.85" aria-hidden="true">
                                        <path d="M12 3.75 18.75 6v5.4c0 4.2-2.78 7.95-6.75 8.85-3.97-.9-6.75-4.65-6.75-8.85V6L12 3.75Z"></path>
                                        <path d="m9.2 12.15 1.8 1.85 3.9-4.2"></path>
                                    </svg>
                                @else
                                    <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.85" aria-hidden="true">
                                        <path d="M12 20s6-5.2 6-10a6 6 0 1 0-12 0c0 4.8 6 10 6 10Z"></path>
                                        <circle cx="12" cy="10" r="2.25"></circle>
                                    </svg>
                                @endif
                            </span>
                            <p class="relative mt-4 text-sm font-extrabold uppercase tracking-[0.18em] {{ $card['label_classes'] }}">{{ $card['label'] }}</p>
                            <h3 class="relative mt-3 text-[1.15rem] font-extrabold leading-7 text-brand-900">{{ $card['title'] }}</h3>
                            <p class="relative mt-3 text-sm leading-7 text-ink-500 sm:text-[0.97rem]">{{ $card['copy'] }}</p>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="grid gap-8 lg:grid-cols-[1.1fr_0.85fr] lg:items-start lg:gap-12">
                    <div>
                        <span class="text-[0.78rem] font-extrabold uppercase tracking-[0.26em] text-brand-500">{{ $service['section_eyebrow'] }}</span>
                        <h2 class="mt-4 max-w-4xl text-3xl font-extrabold leading-[1.06] text-brand-900 sm:text-4xl lg:text-[3rem] lg:tracking-[-0.03em]">
                            {{ $service['section_title'] }}
                        </h2>

                        @foreach ($service['intro_paragraphs'] as $paragraph)
                            <p class="mt-6 max-w-3xl text-base leading-9 text-ink-500 sm:text-[1.04rem]">{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    <aside class="section-alt p-6 sm:p-7 lg:sticky lg:top-28">
                        <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-brand-500">Bu hizmette öne çıkanlar</p>
                        <div class="mt-5 grid gap-4">
                            @foreach ($service['quick_points'] as $point)
                                <div class="rounded-[1.4rem] border border-brand-200/70 bg-white/85 p-4 shadow-[0_10px_24px_rgba(44,48,44,0.05)]">
                                    <p class="text-base font-extrabold text-brand-900">{{ $point['title'] }}</p>
                                    <p class="mt-2 text-sm leading-7 text-ink-500">{{ $point['copy'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            @endif
        </div>
    </section>

    @if (empty($service['trust_cards']))
        <section class="section pt-0">
            <div class="shell">
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($service['feature_cards'] as $card)
                        <article class="group relative overflow-hidden rounded-[1.7rem] border border-brand-200/75 bg-white/90 p-5 shadow-[0_16px_38px_rgba(44,48,44,0.06)] transition hover:-translate-y-0.5 hover:shadow-[0_20px_44px_rgba(44,48,44,0.09)]">
                            <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-brand-100/60 blur-2xl"></div>
                            <h3 class="relative text-[1.18rem] font-extrabold leading-7 text-brand-900">{{ $card['title'] }}</h3>
                            <p class="relative mt-3 text-sm leading-7 text-ink-500 sm:text-[0.97rem]">{{ $card['copy'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.service-carousel', [
        'carouselServices' => $relatedServices,
        'carouselEyebrow' => 'Diğer hizmetlerimiz',
    ])
@endsection
