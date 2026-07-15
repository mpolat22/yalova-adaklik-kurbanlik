<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

class GalleryPageController extends Controller
{
    public function __invoke(): View
    {
        $galleryItems = collect($this->mediaFiles('images/gallery', ['jpg', 'jpeg', 'png', 'webp', 'avif']))
            ->map(function (SplFileInfo $file): array {
                $title = $this->titleFromFile($file);

                return [
                    'url' => asset('images/gallery/' . $file->getFilename()),
                    'title' => $title !== '' ? $title : 'Galeri Görseli',
                    'alt' => $title !== '' ? $title : 'Yalova Elgin Adaklık ve Kurbanlık galeri görseli',
                ];
            })
            ->values();

        $videoItems = collect($this->mediaFiles('videos/gallery', ['mp4']))
            ->map(function (SplFileInfo $file): array {
                $title = $this->titleFromFile($file);
                $posterPath = 'images/gallery/video-posters/' . $file->getFilenameWithoutExtension() . '.webp';

                return [
                    'url' => asset('videos/gallery/' . $file->getFilename()),
                    'title' => $title !== '' ? $title : 'Galeri Videosu',
                    'poster_url' => asset($posterPath),
                ];
            })
            ->values();

        return view('pages.gallery', [
            'galleryItems' => $galleryItems,
            'videoItems' => $videoItems,
            'site' => $this->siteData(),
            'navLinks' => $this->navLinks(),
            'meta' => $this->meta(
                title: 'Galeri | Yalova Elgin Adaklık ve Kurbanlık',
                description: 'Yalova’daki adaklık ve kurbanlık hizmetlerimizi, küçükbaş hayvanlarımızı ve işletme ortamımızı güncel fotoğraf ve kısa videolarla inceleyin.',
                path: '/galeri',
                imagePath: '/images/yalova-adaklik-kurbanlik-hero-ferah.webp',
                imageAlt: 'Yalova Elgin Adaklık ve Kurbanlık galeri görselleri'
            ),
            'schemas' => [
                $this->organizationSchema(),
                $this->breadcrumbSchema([
                    ['name' => 'Anasayfa', 'url' => route('home')],
                    ['name' => 'Galeri', 'url' => route('gallery')],
                ]),
                $this->gallerySchema($galleryItems->all(), $videoItems->all()),
            ],
        ]);
    }

    private function mediaFiles(string $relativeDirectory, array $extensions): array
    {
        $directory = public_path($relativeDirectory);

        if (! File::exists($directory)) {
            return [];
        }

        return collect(File::files($directory))
            ->filter(function (SplFileInfo $file) use ($extensions): bool {
                return in_array(strtolower($file->getExtension()), $extensions, true);
            })
            ->sortByDesc(fn (SplFileInfo $file): int => $file->getMTime())
            ->values()
            ->all();
    }

    private function titleFromFile(SplFileInfo $file): string
    {
        return Str::of($file->getFilenameWithoutExtension())
            ->replace(['-', '_'], ' ')
            ->squish()
            ->title()
            ->toString();
    }

    private function navLinks(): array
    {
        return [
            ['label' => 'Anasayfa', 'href' => route('home')],
            ['label' => 'Hakkımızda', 'href' => route('about')],
            ['label' => 'Hizmetlerimiz', 'href' => route('services')],
            ['label' => 'İletişim', 'href' => route('contact')],
        ];
    }

    private function meta(
        string $title,
        string $description,
        string $path,
        string $imagePath,
        string $imageAlt,
        string $type = 'website'
    ): array {
        return [
            'title' => $title,
            'description' => $description,
            'canonical' => url($path),
            'image' => $this->imageUrl($imagePath),
            'image_alt' => $imageAlt,
            'type' => $type,
        ];
    }

    private function siteData(): array
    {
        return [
            'name' => 'Elgin Kurbanlık ve Adaklık',
            'legal_name' => 'Elgin Kurbanlık ve Adaklık',
            'city' => 'Yalova',
            'district' => 'Çiftlikköy',
            'address' => 'Çiftlik, Güvercin Sk. no:8, 77600 Çiftlikköy/Yalova',
            'maps_url' => 'https://www.google.com/maps/place//data=!4m2!3m1!1s0x14cae35582ea184d:0x419015c6eaa0d815?sa=X&ved=1t:8290&ictx=111',
            'phone_display' => '0541 364 93 79',
            'phone_link' => '905413649379',
            'secondary_phone_display' => '0544 418 48 98',
            'secondary_phone_link' => '905444184898',
            'whatsapp_link' => '905413649379',
            'email' => 'yalovadaklik@hotmail.com',
            'instagram_url' => 'https://www.instagram.com/elginkurbanlikadaklik?igsh=MTBrcTlmeGUxanA3eA%3D%3D&utm_source=qr',
            'facebook_url' => 'https://www.facebook.com/share/1DpHiNKPzM/?mibextid=wwXIfr',
        ];
    }

    private function organizationSchema(): array
    {
        $site = $this->siteData();

        return [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $site['legal_name'],
            'url' => url('/'),
            'image' => $this->imageUrl('/images/yalova-adaklik-kurbanlik-hero-ferah.webp'),
            'description' => 'Yalova adaklık ve kurbanlık hizmeti sunan, yaklaşık 30 yıllık tecrübesiyle İslami hassasiyet ve açık iletişim odaklı çalışan yerel işletme.',
            'telephone' => '+90 541 364 93 79',
            'email' => $site['email'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Çiftlik, Güvercin Sk. no:8',
                'addressLocality' => 'Çiftlikköy',
                'addressRegion' => 'Yalova',
                'postalCode' => '77600',
                'addressCountry' => 'TR',
            ],
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Yalova'],
                ['@type' => 'AdministrativeArea', 'name' => 'Yalova Merkez'],
                ['@type' => 'AdministrativeArea', 'name' => 'Çiftlikköy'],
                ['@type' => 'AdministrativeArea', 'name' => 'Altınova'],
                ['@type' => 'AdministrativeArea', 'name' => 'Çınarcık'],
                ['@type' => 'AdministrativeArea', 'name' => 'Termal'],
            ],
            'hasMap' => $site['maps_url'],
            'sameAs' => [
                $site['instagram_url'],
                $site['facebook_url'],
            ],
        ];
    }

    private function breadcrumbSchema(array $items): array
    {
        $listItems = [];

        foreach ($items as $index => $item) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ];
    }

    private function gallerySchema(array $galleryItems, array $videoItems): array
    {
        $images = [];
        $videos = [];

        foreach ($galleryItems as $galleryItem) {
            $images[] = [
                '@type' => 'ImageObject',
                'contentUrl' => $galleryItem['url'],
                'name' => $galleryItem['title'],
            ];
        }

        foreach ($videoItems as $videoItem) {
            $videos[] = [
                '@type' => 'VideoObject',
                'contentUrl' => $videoItem['url'],
                'name' => $videoItem['title'],
                'thumbnailUrl' => $videoItem['poster_url'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Yalova Elgin Adaklık ve Kurbanlık Galerisi',
            'url' => route('gallery'),
            'description' => 'Yalova’daki adaklık ve kurbanlık hizmetlerimizi, küçükbaş hayvanlarımızı ve işletme ortamımızı güncel fotoğraf ve kısa videolarla inceleyin.',
            'mainEntity' => [
                '@type' => 'ImageGallery',
                'name' => 'Elgin Adaklık ve Kurbanlık Galerisi',
                'image' => $images,
            ],
            'hasPart' => $videos,
        ];
    }

    private function imageUrl(string $path): string
    {
        return asset(ltrim($path, '/'));
    }
}
