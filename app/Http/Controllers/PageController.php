<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

class PageController extends Controller
{
    public function home(): View
    {
        $services = array_values($this->servicesCatalog());
        $galleryItems = $this->homeGalleryItems();
        $faqs = $this->homeFaqs();

        return $this->page('pages.home', [
            'services' => $services,
            'galleryItems' => $galleryItems,
            'faqs' => $faqs,
            'meta' => $this->meta(
                title: 'Yalova Adaklık ve Kurbanlık | Elgin Adaklık ve Kurbanlık',
                description: 'Yalova adaklık ve kurbanlık hizmeti için İslami hassasiyet, düzenli bakım, vekalet ile kesim ve açık iletişim sunan Elgin Adaklık ve Kurbanlık ana sayfası.',
                path: '/',
                imagePath: '/images/yalova-adaklik-kurbanlik-hero-ferah.webp',
                imageAlt: 'Yalova adaklık ve kurbanlık için gündüz merada otlayan küçükbaş sürüsü'
            ),
            'schemas' => [
                $this->organizationSchema(),
                $this->websiteSchema(),
                $this->faqSchema($faqs),
            ],
        ]);
    }

    public function services(): View
    {
        $services = array_values($this->servicesCatalog());

        return $this->page('pages.services', [
            'services' => $services,
            'meta' => $this->meta(
                title: 'Hizmetlerimiz | Yalova Adaklık ve Kurbanlık',
                description: 'Yalova’da adaklık, kurbanlık, akika ve şükür kurbanı için küçükbaş satışı, İslami usullere uygun kesim, ücretsiz parçalama, paketleme ve vekâlet hizmetleri.',
                path: '/hizmetler',
                imagePath: '/images/yalova-adaklik-kurbanlik-hero-ferah.webp',
                imageAlt: 'Yalova adaklık ve kurbanlık hizmetlerimiz için küçükbaş sürüsü'
            ),
            'schemas' => [
                $this->organizationSchema(),
                $this->breadcrumbSchema([
                    ['name' => 'Anasayfa', 'url' => route('home')],
                    ['name' => 'Hizmetlerimiz', 'url' => route('services')],
                ]),
                $this->serviceCollectionSchema($services),
            ],
        ]);
    }

    public function adaklik(): View
    {
        return $this->servicePage('yalova-adaklik');
    }

    public function kurbanlik(): View
    {
        return $this->servicePage('yalova-kurbanlik');
    }

    public function service(string $slug): View|RedirectResponse
    {
        $aliases = $this->serviceSlugAliases();

        if (isset($aliases[$slug])) {
            return redirect()->route('services.show', ['slug' => $aliases[$slug]], 301);
        }

        return $this->servicePage($slug);
    }

    public function about(): View
    {
        return $this->page('pages.about', [
            'meta' => $this->meta(
                title: 'Hakkımızda | Yalova Elgin Adaklık ve Kurbanlık',
                description: 'Yalova Elgin Adaklık ve Kurbanlık hakkında; yaklaşık 30 yıllık tecrübe, İslami şartlara uygun hizmet anlayışı, vekalet ile kesim ve Yalova merkezli yerel yapı bilgileri.',
                path: '/hakkimizda',
                imagePath: '/images/yalova-adaklik-kurbanlik-hero-ferah.webp',
                imageAlt: 'Yalova Elgin Adaklık ve Kurbanlık için gündüz merada otlayan küçükbaş sürüsü'
            ),
            'schemas' => [
                $this->organizationSchema(),
                $this->breadcrumbSchema([
                    ['name' => 'Anasayfa', 'url' => route('home')],
                    ['name' => 'Hakkımızda', 'url' => route('about')],
                ]),
                $this->aboutPageSchema(),
            ],
        ]);
    }

    public function contact(): View
    {
        return $this->page('pages.contact', [
            'meta' => $this->meta(
                title: 'İletişim | Yalova Elgin Adaklık ve Kurbanlık',
                description: 'Yalova adaklık ve kurbanlık hizmeti için Serhat Elgin ve Sercan Elgin iletişim numaraları, WhatsApp, sosyal medya ve Çiftlikköy adres bilgilerine buradan ulaşın.',
                path: '/iletisim',
                imagePath: '/images/yalova-adaklik-kurbanlik-hero-ferah.webp',
                imageAlt: 'Yalova adaklık ve kurbanlık için iletişim görseli'
            ),
            'schemas' => [
                $this->organizationSchema(),
                $this->breadcrumbSchema([
                    ['name' => 'Anasayfa', 'url' => route('home')],
                    ['name' => 'İletişim', 'url' => route('contact')],
                ]),
            ],
        ]);
    }

    private function servicePage(string $slug): View
    {
        $services = $this->servicesCatalog();

        abort_unless(isset($services[$slug]), 404);

        $service = $services[$slug];
        $relatedServices = array_values(array_filter(
            $services,
            fn (array $item): bool => $item['slug'] !== $slug
        ));

        return $this->page('pages.service-detail', [
            'service' => $service,
            'relatedServices' => $relatedServices,
            'meta' => $this->meta(
                title: $service['seo_title'],
                description: $service['seo_description'],
                path: $service['path'],
                imagePath: $service['image_path'],
                imageAlt: $service['image_alt']
            ),
            'schemas' => [
                $this->organizationSchema(),
                $this->breadcrumbSchema([
                    ['name' => 'Anasayfa', 'url' => route('home')],
                    ['name' => 'Hizmetlerimiz', 'url' => route('services')],
                    ['name' => $service['title'], 'url' => $service['url']],
                ]),
                $this->serviceSchema($service),
            ],
        ]);
    }

    private function page(string $view, array $data = []): View
    {
        return view($view, array_merge([
            'site' => $this->siteData(),
            'navLinks' => $this->navLinks(),
            'schemas' => [],
            'meta' => $this->meta(
                title: 'Yalova Elgin Adaklık ve Kurbanlık',
                description: 'Yalova adaklık ve kurbanlık hizmeti için Elgin Adaklık ve Kurbanlık.',
                path: '/',
                imagePath: '/images/yalova-adaklik-kurbanlik-hero-ferah.webp',
                imageAlt: 'Yalova adaklık ve kurbanlık için gündüz merada otlayan küçükbaş sürüsü'
            ),
        ], $data));
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

    private function serviceSlugAliases(): array
    {
        return [
            'ucretsiz-parcalama-ve-paketleme' => 'yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme',
            'kapali-ve-hijyenik-ortamda-kesim' => 'yalova-adaklik-kurbanlik-kapali-ve-hijyenik-ortamda-kesim',
            'vekalet-ile-kesim-ve-dagitim' => 'yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim',
            'uygun-fiyat-garantisi' => 'yalova-adaklik-kurbanlik-uygun-fiyat-garantisi',
            'kolay-odeme-imkani' => 'yalova-adaklik-kurbanlik-kolay-odeme-imkani',
            'canli-hayvan-alim-satimi' => 'yalova-adaklik-kurbanlik-canli-hayvan-alim-satimi',
        ];
    }

    private function homeFaqs(): array
    {
        return [
            [
                'question' => 'Yalova’da adaklık ve kurbanlık seçimi nasıl yapılır?',
                'answer' => 'Yalova ve Çiftlikköy’de adaklık, akika, şükür kurbanı veya Kurban Bayramı için küçükbaş hayvan seçerken ihtiyacınızı ve bütçenizi belirlemeniz yeterlidir. Elgin Adaklık ve Kurbanlık olarak koyun, kuzu, koç ve keçi seçenekleri hakkında telefon veya WhatsApp üzerinden güncel bilgi vererek uygun tercihi yapmanıza yardımcı oluyoruz.',
            ],
            [
                'question' => 'Yalova’da adaklık ve kurbanlık kesimleri İslami usullere uygun mu?',
                'answer' => 'Evet. Adaklık ve kurbanlık kesimlerini İslami usullere ve dini hassasiyetlere uygun, kapalı ve hijyenik ortamda gerçekleştiriyoruz. Kesim süreci hakkında işlem öncesinde açık bilgilendirme yapıyoruz.',
            ],
            [
                'question' => 'Ücretsiz parçalama ve paketleme hizmeti sunuyor musunuz?',
                'answer' => 'Evet. Kesim sonrasında etleri ücretsiz olarak parçalıyor ve düzenli biçimde paketliyoruz. Böylece Yalova adaklık ve kurbanlık hizmetini seçimden teslim aşamasına kadar daha pratik şekilde tamamlıyoruz.',
            ],
            [
                'question' => 'Vekâlet ile kesim ve dağıtım hizmetiniz var mı?',
                'answer' => 'Evet. İşletmemize gelemeyen müşterilerimiz için vekâlet ile kesim ve dağıtım hizmeti sunuyoruz. Vekâlet ve süreç detaylarını kesim öncesinde netleştirerek işlemleri talebinize uygun şekilde yürütüyoruz.',
            ],
            [
                'question' => 'Yalova adaklık ve kurbanlık fiyatları ile ödeme seçenekleri nelerdir?',
                'answer' => 'Adaklık ve kurbanlık fiyatları seçilen küçükbaş hayvanın özelliklerine ve güncel seçeneklere göre değişebilir. Güncel fiyat bilgisi için telefon veya WhatsApp üzerinden bize ulaşabilirsiniz. Ödemelerde nakit ve EFT/Havale kabul ediyoruz.',
            ],
            [
                'question' => 'Elgin Adaklık ve Kurbanlık nerede, nasıl ulaşabilirim?',
                'answer' => 'İşletmemiz Çiftlik, Güvercin Sk. No:8, 77600 Çiftlikköy/Yalova adresindedir. Yalova adaklık ve kurbanlık seçenekleri hakkında bilgi almak için telefon, WhatsApp veya iletişim sayfamız üzerinden bize ulaşabilirsiniz.',
            ],
        ];
    }

    private function faqSchema(array $faqs): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(
                fn (array $faq): array => [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'],
                    ],
                ],
                $faqs
            ),
        ];
    }

    private function homeGalleryItems(): array
    {
        $directory = public_path('images/gallery');

        if (! File::exists($directory)) {
            return [];
        }

        return collect(File::files($directory))
            ->filter(fn (SplFileInfo $file): bool => in_array(
                strtolower($file->getExtension()),
                ['jpg', 'jpeg', 'png', 'webp', 'avif'],
                true
            ))
            ->sortByDesc(fn (SplFileInfo $file): int => $file->getMTime())
            ->take(8)
            ->values()
            ->map(function (SplFileInfo $file, int $index): array {
                $title = Str::of($file->getFilenameWithoutExtension())
                    ->replace(['-', '_'], ' ')
                    ->squish()
                    ->title()
                    ->toString();
                $size = getimagesize($file->getPathname());

                return [
                    'url' => asset('images/gallery/' . $file->getFilename()),
                    'title' => $title !== '' ? $title : 'Galeri Görseli ' . ($index + 1),
                    'alt' => 'Yalova Elgin Adaklık ve Kurbanlık çiftliğinden galeri görseli ' . ($index + 1),
                    'width' => $size[0] ?? 1200,
                    'height' => $size[1] ?? 1440,
                ];
            })
            ->all();
    }

    private function servicesCatalog(): array
    {
        $services = [
            'yalova-adaklik' => [
                'slug' => 'yalova-adaklik',
                'path' => '/yalova-adaklik',
                'title' => 'Yalova Adaklık Hizmeti',
                'card_label' => 'Adaklık',
                'card_copy' => 'Adak, akika ve şükür kurbanı için sağlıklı koyun, kuzu, koç ve keçi seçenekleri sunuyor; Yalova’da süreci İslami hassasiyet ve özenle yürütüyoruz.',
                'seo_title' => 'Yalova Adaklık Hizmeti | Elgin Adaklık ve Kurbanlık',
                'seo_description' => 'Yalova’da adak, akika ve şükür kurbanı için koyun, kuzu, koç ve keçi seçenekleri sunuyor; İslami usullere uygun kesim, ücretsiz parçalama ve paketleme yapıyoruz.',
                'image_path' => '/images/yalova-adaklik.webp',
                'image_alt' => 'Yalova adaklık hizmeti için koyun, keçi ve kuzu görseli',
                'hero_kicker' => 'Yalova Elgin Adaklık ve Kurbanlık',
                'hero_title' => 'Yalova Adaklık Hizmeti',
                'hero_description' => 'Yalova’da adak, akika ve şükür kurbanı için özenle yetiştirilen koyun, kuzu, koç ve keçi seçenekleri sunuyor; kesim sürecini İslami usullere uygun yürütüyoruz.',
                'section_eyebrow' => 'Yalova Adaklık Hizmeti',
                'section_title' => 'Yalova’da Adaklık Seçiminden Kesim ve Teslime Kadar Güvenilir Hizmet',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak Yalova’nın Çiftlikköy ilçesinde yaklaşık 30 yıllık küçükbaş yetiştiriciliği tecrübemizle hizmet veriyoruz. Adak, akika ve şükür kurbanı için koyun, kuzu, koç ve keçi seçenekleri sunuyor; hayvanlarımızın özellikleri ve güncel seçenekler hakkında açık bilgi veriyoruz.',
                    'Seçtiğiniz adaklığın kesimini İslami usullere uygun, kapalı ve hijyenik ortamda gerçekleştiriyor; parçalama ve paketleme işlemlerini ücretsiz tamamlıyoruz. İşletmemize gelemeyenler için vekâletle kesim hizmeti sunuyor, kesim sırasında görüntülü arama yapıyor ve talep edilmesi hâlinde dağıtım sürecini güvenle yürütüyoruz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Müşteri Memnuniyeti',
                        'title' => 'İhtiyacınıza Uygun Adaklık Seçimi',
                        'copy' => 'Adak, akika veya şükür kurbanı için ihtiyacınıza ve bütçenize uygun koyun, kuzu, koç ve keçi seçeneklerini işletmemizde değerlendirebilirsiniz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Süreç',
                        'title' => 'Seçimden Teslime Kadar Net Hizmet',
                        'copy' => 'Seçtiğiniz hayvanı, ücreti ve uygulanacak işlemleri kesim öncesinde netleştiriyor; kesim, parçalama, paketleme ve teslim sürecini belirlenen şekilde tamamlıyoruz.',
                    ],
                    [
                        'icon' => 'clock',
                        'label' => 'Tecrübe',
                        'title' => '30 Yıllık Küçükbaş Yetiştiriciliği',
                        'copy' => 'Yalova Çiftlikköy’de yaklaşık 30 yıldır küçükbaş yetiştiriyor; hayvanlarımızın bakımını kendi işletmemizde sürdürüyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'İslami Hassasiyet',
                        'title' => 'İslami Usullere Uygun Kesim',
                        'copy' => 'Adaklık kesimini dini hassasiyetleri gözeterek, kapalı ve hijyenik ortamda gerçekleştiriyoruz.',
                    ],
                ]),
                'feature_cards' => [
                    [
                        'title' => 'Adak niyetine göre daha doğru yönlendirme',
                        'copy' => 'Adak, akika ve şükür kurbanı için hangi küçükbaş gruplarının değerlendirilebileceğini kısa ve anlaşılır biçimde açıklıyoruz.',
                    ],
                    [
                        'title' => 'Hayvanların durumu hakkında açık bilgi',
                        'copy' => 'Koyun, keçi, kuzu ve oğlak gruplarıyla ilgili soruları doğrudan cevaplıyor, kararı kolaylaştıran net bilgi sunuyoruz.',
                    ],
                    [
                        'title' => 'Yalova merkezli hızlı iletişim',
                        'copy' => 'Telefon ve WhatsApp üzerinden hızlı dönüş sağlayarak adaklık sürecinin daha rahat ilerlemesine destek oluyoruz.',
                    ],
                ],
            ],
            'yalova-kurbanlik' => [
                'slug' => 'yalova-kurbanlik',
                'path' => '/yalova-kurbanlik',
                'title' => 'Yalova Kurbanlık Hizmeti',
                'card_label' => 'Kurbanlık',
                'card_copy' => 'Yalova’da kurban ibadetinizi gönül rahatlığıyla yerine getirebilmeniz için bakımlı ve sağlıklı küçükbaş kurbanlık seçenekleri sunuyoruz.',
                'seo_title' => 'Yalova Kurbanlık Hizmeti | Elgin Adaklık ve Kurbanlık',
                'seo_description' => 'Yalova’da Kurban Bayramı için koyun, koç ve keçi seçenekleri sunuyor; İslami usullere uygun kesim, ücretsiz parçalama ve paketleme yapıyoruz.',
                'image_path' => '/images/yalova-kurbanlik.webp',
                'image_alt' => 'Yalova kurbanlık hizmeti için küçükbaş sürüsü',
                'hero_kicker' => 'Yalova Elgin Adaklık ve Kurbanlık',
                'hero_title' => 'Yalova Kurbanlık Hizmeti',
                'hero_description' => 'Yalova’da Kurban Bayramı için koyun, koç ve keçi seçenekleri sunuyor; İslami usullere uygun kesim, ücretsiz parçalama ve paketleme hizmeti veriyoruz.',
                'section_eyebrow' => 'Yalova Kurbanlık Hizmeti',
                'section_title' => 'Yalova’da Kurbanlık Koyun, Koç ve Keçi Seçenekleri',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak Yalova Çiftlikköy’de yaklaşık 30 yıllık küçükbaş yetiştiriciliği tecrübemizle hizmet veriyoruz. Kurban Bayramı için koyun, koç ve keçi yetiştiriyor; hayvanlarımızın bakımını kendi işletmemizde düzenli olarak sürdürüyoruz. Kurbanlıklarımızı yerinde görebilir, ihtiyacınıza ve bütçenize uygun küçükbaşı seçebilirsiniz.',
                    'Seçtiğiniz kurbanlığın kesimini İslami usullere uygun, kapalı ve hijyenik ortamda gerçekleştiriyor; etleri ücretsiz parçalayıp paketleyerek teslim ediyoruz. İşletmemize gelemeyenler için vekâletle kesim, görüntülü takip ve talep edilmesi hâlinde dağıtım hizmeti sunuyoruz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Müşteri Memnuniyeti',
                        'title' => 'İhtiyacınıza Uygun Kurbanlık Seçimi',
                        'copy' => 'Kurban Bayramı için bütçenize ve tercihinize uygun koyun, koç ve keçi seçeneklerini işletmemizde yakından inceleyerek seçebilirsiniz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Süreç',
                        'title' => 'Seçimden Teslime Kadar Net Hizmet',
                        'copy' => 'Seçtiğiniz kurbanlığı ve toplam ücreti işlem öncesinde netleştiriyor; kesim, parçalama, paketleme ve teslim aşamalarını belirlenen şekilde tamamlıyoruz.',
                    ],
                    [
                        'icon' => 'clock',
                        'label' => 'Tecrübe',
                        'title' => '30 Yıllık Küçükbaş Yetiştiriciliği',
                        'copy' => 'Yalova Çiftlikköy’de yaklaşık 30 yıldır koyun, koç ve keçi yetiştiriyor; hayvanlarımızın bakımını kendi işletmemizde sürdürüyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'İslami Hassasiyet',
                        'title' => 'İslami Usullere Uygun Kurban Kesimi',
                        'copy' => 'Kurban kesimlerini dini hassasiyetleri gözeterek, kapalı ve hijyenik ortamda gerçekleştiriyoruz.',
                    ],
                ]),
                'quick_points' => [
                    [
                        'title' => 'Kurbanlık seçeneklerinde açık yönlendirme',
                        'copy' => 'Küçükbaş gruplarını ihtiyaca göre daha rahat karşılaştırabilmeniz için net bilgi sunuyoruz.',
                    ],
                    [
                        'title' => 'Bakım süreci hakkında görünür bilgi',
                        'copy' => 'Hayvanların genel durumu ve bakım düzeni konusunda anlaşılır açıklamalar paylaşıyoruz.',
                    ],
                    [
                        'title' => 'Yalova odaklı hızlı iletişim',
                        'copy' => 'Telefon ve WhatsApp üzerinden kurbanlık süreci için hızlı şekilde bilgi alabilirsiniz.',
                    ],
                ],
                'feature_cards' => [
                    [
                        'title' => 'Küçükbaş gruplarını daha rahat karşılaştırma',
                        'copy' => 'Koyun, koç ve keçi grupları hakkında temel bilgileri sade biçimde aktarıyoruz.',
                    ],
                    [
                        'title' => 'İslami hassasiyeti gözeten hizmet yaklaşımı',
                        'copy' => 'Kurbanlık sürecinde dini uygunluk konusunda net ve abartısız bilgilendirme sunuyoruz.',
                    ],
                    [
                        'title' => 'Yerel destek ve ulaşılabilir iletişim',
                        'copy' => 'Yalova genelinden bize ulaşan kişiler için yakın iletişim ve düzenli bilgilendirme sağlıyoruz.',
                    ],
                ],
            ],
            'yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme' => [
                'slug' => 'yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme',
                'path' => '/hizmetler/yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme',
                'title' => 'Ücretsiz Parçalama ve Paketleme Hizmeti',
                'card_label' => 'Parçalama ve paketleme',
                'card_copy' => 'Kesim sonrasında etleri isteğinize uygun şekilde ücretsiz parçalıyor, hijyenik koşullarda özenle paketleyerek teslim ediyoruz.',
                'seo_title' => 'Yalova Adaklık Kurbanlık Ücretsiz Parçalama ve Paketleme | Elgin',
                'seo_description' => 'Yalova’da adaklık ve kurbanlık kesimi sonrasında etleri isteğinize uygun şekilde ücretsiz parçalıyor, hijyenik koşullarda paketleyerek teslim ediyoruz.',
                'image_path' => '/images/yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme.webp',
                'image_alt' => 'Ücretsiz parçalama ve paketleme hizmeti için küçükbaş görseli',
                'hero_kicker' => 'Hizmetlerimiz',
                'hero_title' => 'Ücretsiz Parçalama ve Paketleme Hizmeti',
                'hero_description' => 'Yalova’da adaklık ve kurbanlık kesimi sonrasında etleri isteğinize uygun şekilde ücretsiz parçalıyor, hijyenik koşullarda özenle paketleyerek teslim ediyoruz.',
                'section_eyebrow' => 'Ücretsiz Parçalama ve Paketleme',
                'section_title' => 'Yalova’da Adaklık ve Kurbanlık Etleri İçin Ücretsiz Parçalama ve Paketleme',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak Yalova Çiftlikköy’de gerçekleştirdiğimiz adaklık ve kurbanlık kesimlerinin ardından etleri isteğinize uygun şekilde parçalıyoruz. Parçalama işlemini kesim hizmetimizin bir parçası olarak sunuyor ve bu işlem için ek ücret talep etmiyoruz.',
                    'Parçalanan etleri kapalı ve hijyenik çalışma ortamında düzenli biçimde paketliyor, teslim almaya hazır hâle getiriyoruz. Böylece kesim sonrasında ayrıca kasap veya paketleme hizmeti aramanıza gerek kalmadan etlerinizi düzenli paketler hâlinde teslim alabilirsiniz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Müşteri Memnuniyeti',
                        'title' => 'İsteğinize Uygun Parçalama',
                        'copy' => 'Kesim sonrası etleri talep ettiğiniz şekilde parçalıyor ve paketlemeye hazır hâle getiriyoruz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Süreç',
                        'title' => 'Parçalama ve Paketleme İçin Ek Ücret Yok',
                        'copy' => 'Adaklık ve kurbanlık kesimi sonrasında sunduğumuz parçalama ve paketleme işlemleri için ayrıca ücret talep etmiyoruz.',
                    ],
                    [
                        'icon' => 'clock',
                        'label' => 'Tecrübe',
                        'title' => 'Kesim Sonrasında Düzenli Hazırlık',
                        'copy' => 'Yaklaşık 30 yıllık küçükbaş ve kesim tecrübemizle parçalama, paketleme ve teslim aşamalarını düzenli biçimde tamamlıyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'Hijyen',
                        'title' => 'Kapalı ve Hijyenik Ortamda Paketleme',
                        'copy' => 'Etleri kapalı ve hijyenik çalışma alanında parçalıyor, düzenli paketler hâlinde teslim almaya hazır duruma getiriyoruz.',
                    ],
                ]),
                'quick_points' => [
                    [
                        'title' => 'Parçalama aşamasında netlik',
                        'copy' => 'Teslim öncesi işlemlerin nasıl ilerlediğini baştan anlaşılır biçimde paylaşıyoruz.',
                    ],
                    [
                        'title' => 'Paketleme tarafında düzen',
                        'copy' => 'Hazırlık sürecinin daha temiz ve daha kontrollü ilerlemesine özen gösteriyoruz.',
                    ],
                    [
                        'title' => 'Teslim öncesi kolaylık',
                        'copy' => 'Paketleme desteğiyle teslim tarafının daha pratik hale gelmesini hedefliyoruz.',
                    ],
                ],
                'feature_cards' => [
                    [
                        'title' => 'Teslim tarafını kolaylaştıran düzen',
                        'copy' => 'Parçalama ve paketleme desteğiyle sürecin son bölümünü daha anlaşılır hale getiriyoruz.',
                    ],
                    [
                        'title' => 'Temiz ve kontrollü hazırlık akışı',
                        'copy' => 'Hazırlık aşamasında düzeni koruyarak teslim öncesi sürecin daha rahat ilerlemesini sağlıyoruz.',
                    ],
                    [
                        'title' => 'Yalova’dan hızlı bilgi alma imkanı',
                        'copy' => 'Telefon ve WhatsApp üzerinden paketleme süreciyle ilgili hızlı bilgi alabilirsiniz.',
                    ],
                ],
            ],
            'yalova-adaklik-kurbanlik-kapali-ve-hijyenik-ortamda-kesim' => [
                'slug' => 'yalova-adaklik-kurbanlik-kapali-ve-hijyenik-ortamda-kesim',
                'path' => '/hizmetler/yalova-adaklik-kurbanlik-kapali-ve-hijyenik-ortamda-kesim',
                'title' => 'Kapalı ve Hijyenik Ortamda Kesim Hizmeti',
                'card_label' => 'Hijyenik kesim',
                'card_copy' => 'Adaklık ve kurbanlık kesimlerini İslami usullere uygun, kapalı ve hijyenik ortamda titizlikle gerçekleştiriyoruz.',
                'seo_title' => 'Yalova Adaklık Kurbanlık Kapalı ve Hijyenik Ortamda Kesim | Elgin',
                'seo_description' => 'Yalova adaklık ve kurbanlık süreçlerinde kapalı ve hijyenik ortamda kesim hizmeti, İslami uygunluk hassasiyeti ve kontrollü çalışma düzeni hakkında bilgi veren detay sayfası.',
                'image_path' => '/images/yalova-adaklik-kurbanlik-kapali-ve-hijyenik-ortamda-kesim.webp',
                'image_alt' => 'Kapalı ve hijyenik ortamda kesim hizmeti için küçükbaş görseli',
                'hero_kicker' => 'Hizmetlerimiz',
                'hero_title' => 'Kapalı ve Hijyenik Ortamda Kesim Hizmeti',
                'hero_description' => 'Yalova’da adaklık ve kurbanlık kesimlerini İslami usullere uygun, kapalı ve hijyenik ortamda titizlikle gerçekleştiriyoruz.',
                'section_eyebrow' => 'Kapalı ve Hijyenik Kesim',
                'section_title' => 'Yalova’da İslami Usullere Uygun Kapalı ve Hijyenik Kesim',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak Yalova Çiftlikköy’de adaklık ve kurbanlık kesimlerini dış etkenlere kapalı, hijyenik bir çalışma alanında gerçekleştiriyoruz. Kesim alanını işlem öncesinde hazırlıyor, işlemleri kontrollü ve düzenli biçimde tamamlıyoruz.',
                    'Adak, akika, şükür ve kurban kesimlerinde İslami usulleri ve dini hassasiyetleri gözetiyoruz. Kesimin ardından etleri ücretsiz parçalıyor, hijyenik şekilde paketliyor ve teslim almaya hazır hâle getiriyoruz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Müşteri Memnuniyeti',
                        'title' => 'Kesimden Teslime Düzenli Hizmet',
                        'copy' => 'Seçtiğiniz hayvanın kesim, parçalama, paketleme ve teslim işlemlerini aynı işletmede düzenli biçimde tamamlıyoruz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Süreç',
                        'title' => 'Kesim, Parçalama ve Teslim Aşamaları Baştan Net',
                        'copy' => 'Uygulanacak işlemleri kesim öncesinde netleştiriyor; süreci belirlenen sıraya göre tamamlıyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'İslami Hassasiyet',
                        'title' => 'İslami Usullere Uygun Kesim',
                        'copy' => 'Adak, akika, şükür ve kurban kesimlerini dini hassasiyetleri gözeterek titizlikle gerçekleştiriyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'Hijyen',
                        'title' => 'Kapalı ve Hijyenik Kesim Ortamı',
                        'copy' => 'Kesim alanını kapalı tutuyor, çalışma düzeni ve temizliği koruyarak işlemleri hijyenik ortamda gerçekleştiriyoruz.',
                    ],
                ]),
                'quick_points' => [
                    [
                        'title' => 'Kapalı alanda kontrollü süreç',
                        'copy' => 'Kesim aşamasını daha düzenli ve daha izlenebilir yapıda yürütmeye özen gösteriyoruz.',
                    ],
                    [
                        'title' => 'Hijyen odaklı çalışma anlayışı',
                        'copy' => 'Temiz çalışma ortamı ve düzenli hazırlık süreci ile güven veren bir yapı sunuyoruz.',
                    ],
                    [
                        'title' => 'İslami hassasiyetle açık bilgilendirme',
                        'copy' => 'Dini uygunluk konusunda baştan net bilgi vererek sürecin daha rahat anlaşılmasını sağlıyoruz.',
                    ],
                ],
                'feature_cards' => [
                    [
                        'title' => 'Temiz çalışma düzeni',
                        'copy' => 'Kesim sürecinde hijyen standartlarını görünür tutan bir hizmet anlayışı izliyoruz.',
                    ],
                    [
                        'title' => 'Kontrollü ilerleyen hizmet akışı',
                        'copy' => 'Aşamaları planlı şekilde yöneterek belirsizliği en aza indirmeyi hedefliyoruz.',
                    ],
                    [
                        'title' => 'Yalova’dan kolay iletişim',
                        'copy' => 'Süreç hakkında telefon ve WhatsApp üzerinden hızlı bilgi alabilirsiniz.',
                    ],
                ],
            ],
            'yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim' => [
                'slug' => 'yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim',
                'path' => '/hizmetler/yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim',
                'title' => 'Vekâlet ile Kesim ve Dağıtım Hizmeti',
                'card_label' => 'Vekalet ile hizmet',
                'card_copy' => 'Şehir dışında olsanız da vekâletinizi alıyor, kesim sırasında sizi görüntülü arayarak süreci takip etmenizi sağlıyor; kesim ve dağıtımı adınıza güvenle tamamlıyoruz.',
                'seo_title' => 'Yalova Vekâletle Kesim ve Dağıtım | Elgin',
                'seo_description' => 'Yalova’da adaklık ve kurbanlık için vekâletle kesim, görüntülü takip, ücretsiz parçalama, paketleme ve talebe göre dağıtım hizmeti sunuyoruz.',
                'image_path' => '/images/yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim.webp',
                'image_alt' => 'Vekalet ile kesim ve dağıtım hizmeti için küçükbaş görseli',
                'hero_kicker' => 'Hizmetlerimiz',
                'hero_title' => 'Vekâlet ile Kesim ve Dağıtım Hizmeti',
                'hero_description' => 'Şehir dışında olsanız da vekâletinizi alıyor, kesim sırasında sizi görüntülü arıyor ve talebiniz doğrultusunda dağıtım sürecini adınıza tamamlıyoruz.',
                'section_eyebrow' => 'Vekâlet ile Kesim ve Dağıtım',
                'section_title' => 'Yalova’da Vekâletle Kesim, Görüntülü Takip ve Dağıtım',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak işletmemize gelemeyen veya şehir dışında bulunan kişiler için vekâletle adaklık ve kurbanlık kesimi yapıyoruz. Kesim öncesinde seçilen hayvanı, ücreti, uygulanacak işlemleri ve dağıtım talebini netleştiriyor; vekâleti aldıktan sonra süreci adınıza başlatıyoruz.',
                    'Kesim sırasında sizi görüntülü arayarak süreci doğrudan takip etmenizi sağlıyoruz. Ardından etleri ücretsiz parçalayıp paketliyor; talep edilmesi hâlinde belirlenen yerlere dağıtımı adınıza tamamlıyoruz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Müşteri Memnuniyeti',
                        'title' => 'Şehir Dışından Vekâletle Kesim',
                        'copy' => 'İşletmemize gelemeyen müşterilerimizin vekâletini alıyor, adaklık veya kurbanlık kesimini adlarına gerçekleştiriyoruz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Süreç',
                        'title' => 'Kesim Sırasında Görüntülü Takip',
                        'copy' => 'Kesim sırasında sizi görüntülü arıyor, seçtiğiniz hayvanın kesimini doğrudan takip etmenizi sağlıyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'İslami Hassasiyet',
                        'title' => 'Vekâletle İslami Usullere Uygun Kesim',
                        'copy' => 'Vekâletle yapılan adak, akika, şükür ve kurban kesimlerini dini hassasiyetleri gözeterek gerçekleştiriyoruz.',
                    ],
                    [
                        'icon' => 'location',
                        'label' => 'Dağıtım',
                        'title' => 'Paketleme ve Dağıtımın Tamamlanması',
                        'copy' => 'Kesim sonrası etleri ücretsiz parçalayıp paketliyor, talebinize göre dağıtım sürecini adınıza tamamlıyoruz.',
                    ],
                ]),
                'quick_points' => [
                    [
                        'title' => 'Vekalet adımında net anlatım',
                        'copy' => 'Sürecin nasıl işleyeceğini baştan açık biçimde paylaşıyoruz.',
                    ],
                    [
                        'title' => 'Dağıtım tarafında düzenli bilgi',
                        'copy' => 'Teslim ve dağıtım sürecinin hangi aşamada olduğunu anlaşılır şekilde aktarıyoruz.',
                    ],
                    [
                        'title' => 'Ulaşılması kolay iletişim',
                        'copy' => 'Telefon ve WhatsApp üzerinden süreçle ilgili hızlı bilgi alabilirsiniz.',
                    ],
                ],
                'feature_cards' => [
                    [
                        'title' => 'Başlangıçtan teslim aşamasına net akış',
                        'copy' => 'Vekaletle yürüyen hizmetin her adımını daha rahat takip edebilmeniz için düzenli bilgilendirme sunuyoruz.',
                    ],
                    [
                        'title' => 'Güven veren iletişim yapısı',
                        'copy' => 'Sorulara hızlı dönüş sağlayarak vekalet sürecinde belirsizliği azaltıyoruz.',
                    ],
                    [
                        'title' => 'Yalova merkezli yerel destek',
                        'copy' => 'Yerel işletme avantajıyla daha yakın ve daha anlaşılır bir iletişim kuruyoruz.',
                    ],
                ],
            ],
            'yalova-adaklik-kurbanlik-uygun-fiyat-garantisi' => [
                'slug' => 'yalova-adaklik-kurbanlik-uygun-fiyat-garantisi',
                'path' => '/hizmetler/yalova-adaklik-kurbanlik-uygun-fiyat-garantisi',
                'title' => 'Uygun Fiyat Garantisi',
                'card_label' => 'Uygun fiyat',
                'card_copy' => 'Bakımlı ve sağlıklı adaklık ile kurbanlık seçeneklerini bütçenize uygun fiyatlarla, açık bilgilendirme anlayışıyla sunuyoruz.',
                'seo_title' => 'Yalova Uygun Fiyatlı Adaklık ve Kurbanlık | Elgin',
                'seo_description' => 'Yalova’da adaklık ve kurbanlık için bütçenize uygun küçükbaş seçenekleri sunuyor; kesim sonrası parçalama ve paketlemeyi ücretsiz yapıyoruz.',
                'image_path' => '/images/yalova-adaklik-kurbanlik-uygun-fiyat-garantisi.webp',
                'image_alt' => 'Uygun fiyat garantisi hizmeti için koyun, keçi ve kuzu görseli',
                'hero_kicker' => 'Hizmetlerimiz',
                'hero_title' => 'Uygun Fiyat Garantisi',
                'hero_description' => 'Yalova’da adaklık ve kurbanlık için bakımlı küçükbaş seçeneklerini bütçenize uygun fiyatlarla sunuyor; parçalama ve paketlemeyi ücretsiz yapıyoruz.',
                'section_eyebrow' => 'Uygun Fiyat Garantisi',
                'section_title' => 'Yalova’da Bütçenize Uygun Adaklık ve Kurbanlık Seçenekleri',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak adaklık için koyun, kuzu, koç ve keçi; kurbanlık için koyun, koç ve keçi seçeneklerini farklı bütçelere uygun fiyatlarla sunuyoruz. Yaklaşık 30 yıllık küçükbaş yetiştiriciliği tecrübemizle hayvanlarımızın bakımını kendi işletmemizde sürdürüyoruz.',
                    'Seçtiğiniz hayvanın fiyatını ve uygulanacak işlemleri kesim öncesinde netleştiriyoruz. Kesimi İslami usullere uygun, kapalı ve hijyenik ortamda gerçekleştiriyor; parçalama ve paketleme işlemlerini ek ücret talep etmeden tamamlıyoruz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Bütçeye Uygun Seçim',
                        'title' => 'İhtiyacınıza Uygun Küçükbaş Seçenekleri',
                        'copy' => 'Adaklık ve kurbanlık ihtiyacınıza, tercihlerinize ve bütçenize uygun küçükbaş seçeneklerini işletmemizde değerlendirebilirsiniz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Fiyat',
                        'title' => 'Hayvan ve Hizmet Bedeli Baştan Belli',
                        'copy' => 'Seçtiğiniz hayvanın fiyatını ve uygulanacak hizmetleri kesim öncesinde netleştirerek sonradan oluşabilecek belirsizlikleri önlüyoruz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Ücretsiz Hizmet',
                        'title' => 'Parçalama ve Paketlemeye Ek Ücret Yok',
                        'copy' => 'Kesim sonrasında etleri isteğinize uygun şekilde ücretsiz parçalıyor ve hijyenik koşullarda paketleyerek teslim ediyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'Kalite',
                        'title' => 'Bakımlı ve Sağlıklı Küçükbaşlar',
                        'copy' => 'Koyun, kuzu, koç ve keçilerimizin düzenli bakımını Yalova Çiftlikköy’deki kendi işletmemizde sürdürüyoruz.',
                    ],
                ]),
                'quick_points' => [
                    [
                        'title' => 'Bütçeye uygun seçeneklerde açıklık',
                        'copy' => 'Seçenekleri daha rahat değerlendirebilmeniz için fiyat tarafını anlaşılır tutuyoruz.',
                    ],
                    [
                        'title' => 'Karar vermeyi kolaylaştıran bilgi',
                        'copy' => 'Adaklık ve kurbanlık için size uygun olabilecek başlıkları sade şekilde aktarıyoruz.',
                    ],
                    [
                        'title' => 'Yalova merkezli hızlı dönüş',
                        'copy' => 'Telefon ve WhatsApp üzerinden fiyat ve süreç hakkında hızlı bilgi alabilirsiniz.',
                    ],
                ],
                'feature_cards' => [
                    [
                        'title' => 'Daha anlaşılır fiyat yaklaşımı',
                        'copy' => 'Bütçe planlamasını kolaylaştıran sade ve net bir bilgilendirme sunuyoruz.',
                    ],
                    [
                        'title' => 'Adaklık ve kurbanlıkta uygun seçenek aralığı',
                        'copy' => 'Farklı ihtiyaçlar için değerlendirebileceğiniz seçenekleri açık biçimde paylaşıyoruz.',
                    ],
                    [
                        'title' => 'Yerel iletişimle hızlı bilgi alma',
                        'copy' => 'Yalova’dan bize ulaşan kişiler için hızlı dönüş sağlayan iletişim yapımız bulunuyor.',
                    ],
                ],
            ],
            'yalova-adaklik-kurbanlik-kolay-odeme-imkani' => [
                'slug' => 'yalova-adaklik-kurbanlik-kolay-odeme-imkani',
                'path' => '/hizmetler/yalova-adaklik-kurbanlik-kolay-odeme-imkani',
                'title' => 'Kolay Ödeme İmkânı',
                'card_label' => 'Kolay ödeme',
                'card_copy' => 'Nakit ve EFT/Havale ödeme seçenekleriyle adaklık ve kurbanlık alışverişinizi kolayca tamamlayabilirsiniz.',
                'seo_title' => 'Yalova Adaklık ve Kurbanlık Kolay Ödeme | Elgin',
                'seo_description' => 'Yalova’da adaklık ve kurbanlık alışverişinizi nakit veya EFT/Havale ile tamamlayabilir; ücretsiz parçalama ve paketleme hizmetinden yararlanabilirsiniz.',
                'image_path' => '/images/yalova-adaklik-kurbanlik-kolay-odeme-imkani.webp',
                'image_alt' => 'Kolay ödeme imkânı hizmeti için koyun, keçi ve kuzu görseli',
                'hero_kicker' => 'Hizmetlerimiz',
                'hero_title' => 'Kolay Ödeme İmkânı',
                'hero_description' => 'Yalova’da adaklık ve kurbanlık alışverişinizi nakit veya EFT/Havale seçenekleriyle kolayca tamamlayabilirsiniz.',
                'section_eyebrow' => 'Kolay Ödeme İmkânı',
                'section_title' => 'Yalova’da Nakit ve EFT/Havale ile Kolay Ödeme',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak seçtiğiniz adaklık veya kurbanlık için nakit ve EFT/Havale ödeme seçenekleri sunuyoruz. Hayvanın fiyatını, tercih ettiğiniz ödeme yöntemini ve uygulanacak işlemleri kesim öncesinde birlikte netleştiriyoruz.',
                    'Ödemenizi işletmemizde nakit olarak veya banka üzerinden EFT/Havale ile gerçekleştirebilirsiniz. Kesim sonrasında sunduğumuz parçalama ve paketleme hizmetleri için ayrıca ücret talep etmiyoruz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Ödeme Seçeneği',
                        'title' => 'Nakit Ödeme',
                        'copy' => 'Seçtiğiniz adaklık veya kurbanlığın ödemesini işletmemizde nakit olarak kolayca tamamlayabilirsiniz.',
                    ],
                    [
                        'icon' => 'location',
                        'label' => 'Banka Transferi',
                        'title' => 'EFT/Havale ile Ödeme',
                        'copy' => 'İşletmemize gelmeden veya kesim öncesinde ödemenizi banka hesabımıza EFT/Havale yoluyla yapabilirsiniz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Süreç',
                        'title' => 'Toplam Tutar Kesimden Önce Netleşir',
                        'copy' => 'Seçtiğiniz hayvanın fiyatını, ödeme yöntemini ve hizmet kapsamını kesim işlemi başlamadan önce belirliyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'Ücretsiz Hizmetler',
                        'title' => 'Parçalama ve Paketleme Ücretsiz',
                        'copy' => 'Kesim sonrasındaki parçalama ve paketleme işlemlerini ödeme tutarına ek bir ücret yansıtmadan tamamlıyoruz.',
                    ],
                ]),
                'quick_points' => [
                    [
                        'title' => 'Daha anlaşılır ödeme planlaması',
                        'copy' => 'Ödeme sürecini zorlaştırmadan sade biçimde anlatıyoruz.',
                    ],
                    [
                        'title' => 'Başta netleşen süreç akışı',
                        'copy' => 'Beklentileri erkenden konuşarak sürecin daha rahat ilerlemesini sağlıyoruz.',
                    ],
                    [
                        'title' => 'Hızlı bilgi ve yerel destek',
                        'copy' => 'Telefon ve WhatsApp üzerinden ödeme tarafıyla ilgili sorularınızı kısa sürede yanıtlıyoruz.',
                    ],
                ],
                'feature_cards' => [
                    [
                        'title' => 'Planlamayı kolaylaştıran yaklaşım',
                        'copy' => 'Ödeme konusunda net bilgi vererek karar sürecini daha rahat hale getiriyoruz.',
                    ],
                    [
                        'title' => 'Sade ve anlaşılır iletişim',
                        'copy' => 'Ödeme aşamasında karmaşa oluşturmayan, açık bir konuşma düzeni sunuyoruz.',
                    ],
                    [
                        'title' => 'Yalova’dan hızlı ulaşım imkanı',
                        'copy' => 'Yerel iletişim yapımız sayesinde sorularınıza hızlı dönüş sağlıyoruz.',
                    ],
                ],
            ],
            'yalova-adaklik-kurbanlik-canli-hayvan-alim-satimi' => [
                'slug' => 'yalova-adaklik-kurbanlik-canli-hayvan-alim-satimi',
                'path' => '/hizmetler/yalova-adaklik-kurbanlik-canli-hayvan-alim-satimi',
                'title' => 'Canlı Hayvan Alım Satımı',
                'card_label' => 'Canlı hayvan',
                'card_copy' => 'Koyun, kuzu, koç ve keçi gruplarında sağlıklı küçükbaş hayvan alım satımı hizmeti sunuyoruz.',
                'seo_title' => 'Yalova Canlı Hayvan Alım Satımı | Elgin',
                'seo_description' => 'Yalova Çiftlikköy’de koyun, kuzu, koç ve keçi alım satımı yapıyor; bakımlı küçükbaş seçeneklerini yaklaşık 30 yıllık tecrübemizle sunuyoruz.',
                'image_path' => '/images/yalova-adaklik-kurbanlik-canli-hayvan-alim-satimi.webp',
                'image_alt' => 'Canlı hayvan alım satımı hizmeti için küçükbaş sürüsü',
                'hero_kicker' => 'Hizmetlerimiz',
                'hero_title' => 'Canlı Hayvan Alım Satımı',
                'hero_description' => 'Yalova’da koyun, kuzu, koç ve keçi gruplarında sağlıklı ve bakımlı küçükbaş hayvan alım satımı yapıyoruz.',
                'section_eyebrow' => 'Canlı Hayvan Alım Satımı',
                'section_title' => 'Yalova’da Koyun, Kuzu, Koç ve Keçi Alım Satımı',
                'intro_paragraphs' => [
                    'Elgin Adaklık ve Kurbanlık olarak Yalova’nın Çiftlikköy ilçesinde yaklaşık 30 yıllık küçükbaş yetiştiriciliği tecrübemizle koyun, kuzu, koç ve keçi alım satımı yapıyoruz. Hayvanlarımızın düzenli bakımını kendi işletmemizde sürdürüyoruz.',
                    'Mevcut küçükbaş seçeneklerini işletmemizde yakından inceleyebilir, ihtiyacınıza uygun hayvanı yerinde seçebilirsiniz. Seçtiğiniz hayvanı ve satış fiyatını işlem öncesinde netleştirerek alım satımı belirlenen koşullarda tamamlıyoruz.',
                ],
                'trust_cards' => $this->serviceValueCards([
                    [
                        'icon' => 'heart',
                        'label' => 'Tecrübe',
                        'title' => '30 Yıllık Küçükbaş Yetiştiriciliği',
                        'copy' => 'Yalova Çiftlikköy’de koyun, kuzu, koç ve keçi yetiştiriciliğinde yaklaşık 30 yıllık bilgi ve deneyimimizle hizmet veriyoruz.',
                    ],
                    [
                        'icon' => 'shield',
                        'label' => 'Hayvan Seçenekleri',
                        'title' => 'Koyun, Kuzu, Koç ve Keçi',
                        'copy' => 'Farklı ihtiyaçlara uygun, düzenli bakımı yapılan küçükbaş hayvan seçeneklerini kendi işletmemizde sunuyoruz.',
                    ],
                    [
                        'icon' => 'location',
                        'label' => 'Yerinde Seçim',
                        'title' => 'Hayvanları İşletmemizde İnceleyin',
                        'copy' => 'Mevcut küçükbaş hayvanlarımızı Yalova Çiftlikköy’deki işletmemizde yakından inceleyerek seçiminizi yapabilirsiniz.',
                    ],
                    [
                        'icon' => 'checklist',
                        'label' => 'Şeffaf Alım Satım',
                        'title' => 'Hayvan ve Fiyat Satıştan Önce Netleşir',
                        'copy' => 'Seçtiğiniz küçükbaş hayvanı ve satış fiyatını işlem öncesinde belirleyerek alım satımı kararlaştırılan şekilde tamamlıyoruz.',
                    ],
                ]),
                'quick_points' => [
                    [
                        'title' => 'Küçükbaş grupları hakkında açık bilgi',
                        'copy' => 'Canlı hayvan tarafında karar vermeyi kolaylaştıran temel bilgileri doğrudan aktarıyoruz.',
                    ],
                    [
                        'title' => 'Yerel işletme desteği',
                        'copy' => 'Yalova merkezli yapımızla daha yakın ve daha ulaşılabilir iletişim sunuyoruz.',
                    ],
                    [
                        'title' => 'Hızlı dönüş sağlayan iletişim',
                        'copy' => 'Telefon ve WhatsApp üzerinden canlı hayvan süreci için bilgi alabilirsiniz.',
                    ],
                ],
                'feature_cards' => [
                    [
                        'title' => 'Canlı hayvan sürecinde sade anlatım',
                        'copy' => 'Bilgiye daha hızlı ulaşmanız için süreci gereksiz karmaşadan uzak biçimde açıklıyoruz.',
                    ],
                    [
                        'title' => 'Koyun, keçi, kuzu ve oğlak gruplarında yönlendirme',
                        'copy' => 'İhtiyaca göre değerlendirilebilecek küçükbaş gruplarını daha rahat anlamanızı sağlıyoruz.',
                    ],
                    [
                        'title' => 'Yalova odaklı yerel görünürlük',
                        'copy' => 'Yerel hizmet yapımızla yakın iletişim ve güven veren bilgilendirme sunuyoruz.',
                    ],
                ],
            ],
        ];

        foreach ($services as $slug => &$service) {
            $service['slug'] = $slug;
            $service['url'] = url($service['path']);
            $service['image_url'] = $this->imageUrl($service['image_path']);
        }

        unset($service);

        return $services;
    }

    private function serviceValueCards(array $cards): array
    {
        $styles = [
            [
                'card_classes' => 'border-[#ddd3c7] bg-[linear-gradient(180deg,rgba(255,255,255,0.96),rgba(247,242,234,0.92))]',
                'glow_classes' => 'bg-[#e5c9a6]/25',
                'icon_classes' => 'bg-[#b98353] text-white shadow-[0_12px_28px_rgba(185,131,83,0.28)]',
                'label_classes' => 'text-[#9b6c43]',
            ],
            [
                'card_classes' => 'border-[#d8d6ce] bg-[linear-gradient(180deg,rgba(255,255,255,0.97),rgba(244,244,241,0.94))]',
                'glow_classes' => 'bg-[#d8cfbf]/20',
                'icon_classes' => 'bg-brand-800 text-white shadow-[0_12px_28px_rgba(56,61,56,0.24)]',
                'label_classes' => 'text-brand-500',
            ],
            [
                'card_classes' => 'border-[#ddd3c7] bg-[linear-gradient(180deg,rgba(255,255,255,0.96),rgba(247,242,234,0.92))]',
                'glow_classes' => 'bg-[#e5c9a6]/25',
                'icon_classes' => 'bg-[#b98353] text-white shadow-[0_12px_28px_rgba(185,131,83,0.28)]',
                'label_classes' => 'text-[#9b6c43]',
            ],
            [
                'card_classes' => 'border-[#d7decf] bg-[linear-gradient(180deg,rgba(255,255,255,0.96),rgba(241,246,239,0.92))]',
                'glow_classes' => 'bg-[#b9ccb0]/24',
                'icon_classes' => 'bg-[#738c68] text-white shadow-[0_12px_28px_rgba(115,140,104,0.28)]',
                'label_classes' => 'text-[#6a7f60]',
            ],
        ];

        return array_map(
            static fn (array $card, int $index): array => [...$card, ...$styles[$index % count($styles)]],
            $cards,
            array_keys($cards),
        );
    }

    private function trustCards(string $label, string $title, string $copy): array
    {
        return [
            [
                'icon' => 'clock',
                'label' => '30 Yıllık Tecrübe',
                'title' => 'Yılların verdiği birikimle daha güvenli hizmet akışı',
                'copy' => 'Yaklaşık 30 yıllık saha tecrübemizle süreci daha bilinçli, daha düzenli ve daha güven veren şekilde yürütmeye özen gösteriyoruz.',
                'card_classes' => 'border-[#ddd3c7] bg-[linear-gradient(180deg,rgba(255,255,255,0.96),rgba(247,242,234,0.92))]',
                'glow_classes' => 'bg-[#e5c9a6]/25',
                'icon_classes' => 'bg-[#b98353] text-white shadow-[0_12px_28px_rgba(185,131,83,0.28)]',
                'label_classes' => 'text-[#9b6c43]',
            ],
            [
                'icon' => 'shield',
                'label' => 'İslami Şartlara Uygun Hizmet',
                'title' => 'Dini hassasiyetleri görünür biçimde koruyoruz',
                'copy' => 'Hizmet sürecinde İslami hassasiyetleri ön planda tutuyor, dini uygunluk konusunda açık ve anlaşılır bilgilendirme sağlıyoruz.',
                'card_classes' => 'border-[#d7decf] bg-[linear-gradient(180deg,rgba(255,255,255,0.96),rgba(241,246,239,0.92))]',
                'glow_classes' => 'bg-[#b9ccb0]/24',
                'icon_classes' => 'bg-[#738c68] text-white shadow-[0_12px_28px_rgba(115,140,104,0.28)]',
                'label_classes' => 'text-[#6a7f60]',
            ],
            [
                'icon' => 'location',
                'label' => $label,
                'title' => $title,
                'copy' => $copy,
                'card_classes' => 'border-[#d8d6ce] bg-[linear-gradient(180deg,rgba(255,255,255,0.97),rgba(244,244,241,0.94))] sm:col-span-2 xl:col-span-1',
                'glow_classes' => 'bg-[#d8cfbf]/20',
                'icon_classes' => 'bg-brand-800 text-white shadow-[0_12px_28px_rgba(56,61,56,0.24)]',
                'label_classes' => 'text-brand-500',
            ],
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
            'description' => 'Yalova adaklık ve kurbanlık hizmeti sunan, yaklaşık 30 yıllık tecrübesiyle İslami hassasiyet, vekalet ile kesim ve açık iletişim odaklı çalışan yerel işletme.',
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

    private function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Yalova Elgin Adaklık ve Kurbanlık',
            'url' => url('/'),
            'inLanguage' => 'tr-TR',
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

    private function serviceCollectionSchema(array $services): array
    {
        $items = [];

        foreach ($services as $index => $service) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'url' => $service['url'],
                'name' => $service['title'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => 'Yalova Adaklık ve Kurbanlık Hizmetleri',
            'itemListElement' => $items,
        ];
    }

    private function serviceSchema(array $service): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service['title'],
            'serviceType' => $service['title'],
            'description' => $service['seo_description'],
            'url' => $service['url'],
            'image' => $service['image_url'],
            'inLanguage' => 'tr-TR',
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Yalova'],
            ],
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'Elgin Kurbanlık ve Adaklık',
                'url' => url('/'),
                'telephone' => '+90 541 364 93 79',
            ],
        ];
    }

    private function aboutPageSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'AboutPage',
            'name' => 'Hakkımızda',
            'url' => route('about'),
            'description' => 'Yalova Elgin Adaklık ve Kurbanlık işletmesinin yaklaşık 30 yıllık tecrübesi, İslami hassasiyeti ve yerel hizmet anlayışı.',
            'mainEntity' => [
                '@type' => 'Organization',
                'name' => 'Elgin Kurbanlık ve Adaklık',
                'url' => url('/'),
            ],
        ];
    }

    private function imageUrl(string $path): string
    {
        return asset(ltrim($path, '/'));
    }
}
