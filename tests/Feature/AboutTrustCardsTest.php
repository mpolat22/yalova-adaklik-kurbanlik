<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutTrustCardsTest extends TestCase
{
    public function test_about_page_uses_the_four_approved_trust_cards(): void
    {
        $content = $this->get(route('about'))->assertOk()->getContent();

        $this->assertStringContainsString('data-about-trust-grid', $content);
        $this->assertSame(4, substr_count($content, 'data-about-trust-card'));
        $this->assertStringContainsString('30 Yıllık Küçükbaş Yetiştiriciliği', $content);
        $this->assertStringContainsString('İslami Usullere Uygun Kesim', $content);
        $this->assertStringContainsString('Ücretsiz Parçalama ve Paketleme', $content);
        $this->assertStringContainsString('Vekâlet ile Kesim ve Dağıtım', $content);
        $this->assertStringContainsString('kesim sırasında sizi görüntülü arıyor', $content);
        $this->assertStringNotContainsString('Yerel Ulaşılabilirlik', $content);
        $this->assertStringNotContainsString('Yılların verdiği birikimle daha güvenli hizmet akışı', $content);
    }
}