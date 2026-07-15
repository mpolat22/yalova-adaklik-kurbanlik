<?php

namespace Tests\Feature;

use Tests\TestCase;

class MetaDescriptionsTest extends TestCase
{
    public function test_all_public_pages_use_the_approved_unique_meta_descriptions(): void
    {
        $pages = [
            '/' => 'Yalova’da adaklık ve kurbanlık için küçükbaş satışı, İslami usullere uygun kesim, ücretsiz parçalama ve paketleme hizmetlerini yaklaşık 30 yıllık tecrübeyle sunuyoruz.',
            '/hakkimizda' => 'Elgin Adaklık ve Kurbanlık’ın Yalova’da yaklaşık 30 yıllık küçükbaş yetiştiriciliği tecrübesini, hayvan bakım anlayışını ve hizmetlerini tanıyın.',
            '/hizmetler' => 'Yalova’da adaklık ve kurbanlık için küçükbaş satışından İslami kesime, ücretsiz parçalama ve paketlemeden vekâletle dağıtıma kadar hizmetlerimizi inceleyin.',
            '/yalova-adaklik' => 'Yalova’da adak, akika ve şükür kurbanı için koyun, kuzu, koç ve keçi seçenekleri sunuyoruz; kesimden paketli teslime kadar süreci tamamlıyoruz.',
            '/yalova-kurbanlik' => 'Yalova’da Kurban Bayramı için koyun, koç ve keçi seçeneklerini inceleyin; İslami kesim, ücretsiz parçalama ve paketleme hizmetlerinden yararlanın.',
            '/hizmetler/yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme' => 'Yalova’da adaklık ve kurbanlık kesimi sonrası etleri isteğinize uygun ücretsiz parçalıyor, hijyenik koşullarda paketleyerek teslim ediyoruz.',
            '/hizmetler/yalova-adaklik-kurbanlik-kapali-ve-hijyenik-ortamda-kesim' => 'Yalova’da adaklık ve kurbanlık kesimlerini kapalı ve hijyenik alanımızda, İslami usulleri gözeterek titizlikle gerçekleştiriyoruz.',
            '/hizmetler/yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim' => 'Yalova’da adaklık ve kurbanlık için vekâlet alıyoruz, kesim sırasında görüntülü arama yapıyoruz ve talep hâlinde dağıtımı üstleniyoruz.',
            '/hizmetler/yalova-adaklik-kurbanlik-uygun-fiyat-garantisi' => 'Yalova’da bütçenize uygun adaklık ve kurbanlık seçenekleri sunuyoruz; parçalama ve paketleme işlemleri için ek ücret almıyoruz.',
            '/hizmetler/yalova-adaklik-kurbanlik-kolay-odeme-imkani' => 'Yalova’da adaklık ve kurbanlık alışverişinizi nakit veya EFT/Havale seçeneklerinden size uygun olanla kolayca tamamlayabilirsiniz.',
            '/hizmetler/yalova-adaklik-kurbanlik-canli-hayvan-alim-satimi' => 'Yalova’da koyun, kuzu, koç ve keçi gruplarında yaklaşık 30 yıllık yetiştiricilik tecrübemizle canlı hayvan alım satımı yapıyoruz.',
            '/galeri' => 'Yalova’daki adaklık ve kurbanlık hizmetlerimizi, küçükbaş hayvanlarımızı ve işletme ortamımızı güncel fotoğraf ve kısa videolarla inceleyin.',
            '/iletisim' => 'Yalova’da adaklık, kurbanlık, akika ve şükür kurbanı için telefon veya WhatsApp’tan bize ulaşın; adres ve konumumuzu görüntüleyin.',
        ];

        foreach ($pages as $path => $description) {
            $content = $this->get($path)->assertOk()->getContent();

            $this->assertStringContainsString(
                '<meta name="description" content="' . $description . '">',
                $content,
                "Unexpected meta description for {$path}"
            );
            $this->assertSame(1, substr_count($content, '<meta name="description"'));
        }

        $this->assertCount(count(array_unique($pages)), $pages);
    }
}
