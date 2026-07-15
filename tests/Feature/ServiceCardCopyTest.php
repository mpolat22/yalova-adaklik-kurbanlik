<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServiceCardCopyTest extends TestCase
{
    public function test_all_nine_approved_service_summaries_are_shown_on_service_cards(): void
    {
        $approvedCopies = [
            'Adak, akika ve şükür kurbanı için sağlıklı koyun, kuzu, koç ve keçi seçenekleri sunuyor; Yalova’da süreci İslami hassasiyet ve özenle yürütüyoruz.',
            'Yalova’da kurban ibadetinizi gönül rahatlığıyla yerine getirebilmeniz için bakımlı ve sağlıklı küçükbaş kurbanlık seçenekleri sunuyoruz.',
            'Kesim sonrasında etleri isteğinize uygun şekilde ücretsiz parçalıyor, hijyenik koşullarda özenle paketleyerek teslim ediyoruz.',
            'Adaklık ve kurbanlık kesimlerini İslami usullere uygun, kapalı ve hijyenik ortamda titizlikle gerçekleştiriyoruz.',
            'Şehir dışında olsanız da vekâletinizi alıyor, kesim sırasında sizi görüntülü arayarak süreci takip etmenizi sağlıyor; kesim ve dağıtımı adınıza güvenle tamamlıyoruz.',
            'Bakımlı ve sağlıklı adaklık ile kurbanlık seçeneklerini bütçenize uygun fiyatlarla, açık bilgilendirme anlayışıyla sunuyoruz.',
            'Nakit ve EFT/Havale ödeme seçenekleriyle adaklık ve kurbanlık alışverişinizi kolayca tamamlayabilirsiniz.',
            'Koyun, kuzu, koç ve keçi gruplarında sağlıklı küçükbaş hayvan alım satımı hizmeti sunuyoruz.',
            'Yalova’da açılış, temel atma ve benzeri organizasyonlar için seçtiğiniz küçükbaşı kendi aracımızla getiriyor; talebe göre kesim, yüzme, parçalama ve paketleme işlemlerini yerinde tamamlıyoruz.',
        ];

        foreach ([route('home'), route('services')] as $url) {
            $content = $this->get($url)->assertOk()->getContent();

            foreach ($approvedCopies as $copy) {
                $this->assertStringContainsString($copy, $content);
            }
        }
    }
}