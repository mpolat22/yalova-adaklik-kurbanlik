@props([
    'image',
    'alt',
    'title',
    'description',
    'imagePosition' => 'center',
    'width' => 1680,
    'height' => 945,
])

<section class="hero-shell">
    <div class="hero-stage hero-stage--compact hero-stage--framed min-h-0 overflow-hidden">
        <img
            src="{{ asset(ltrim($image, '/')) }}"
            alt="{{ $alt }}"
            class="hero-image"
            style="object-position: {{ $imagePosition }};"
            width="{{ $width }}"
            height="{{ $height }}"
            sizes="100vw"
            fetchpriority="high"
            decoding="async"
        >

        <div class="hero-overlay hero-overlay--airy"></div>

        <div class="shell relative z-10 flex h-full items-end justify-start py-8 sm:py-10 lg:py-12">
            <div class="hero-copy hero-copy--left">
                <div class="hero-panel max-w-3xl">
                    <h1 class="hero-title mt-0 max-w-4xl">{{ $title }}</h1>
                    <div class="hero-divider"></div>
                    <p class="hero-description max-w-2xl">{{ $description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>