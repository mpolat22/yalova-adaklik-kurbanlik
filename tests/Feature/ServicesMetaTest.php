<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesMetaTest extends TestCase
{
    public function test_services_page_uses_the_approved_yalova_focused_meta_description(): void
    {
        $content = $this->get(route('services'))->assertOk()->getContent();
        $description = 'Yalova’da adaklık, kurbanlık, akika ve şükür kurbanı için küçükbaş satışı, İslami usullere uygun kesim, ücretsiz parçalama, paketleme ve vekâlet hizmetleri.';

        $this->assertStringContainsString('<meta name="description" content="' . $description . '">', $content);
        $this->assertStringContainsString('<meta property="og:description" content="' . $description . '">', $content);
        $this->assertStringContainsString('<meta name="twitter:description" content="' . $description . '">', $content);
        $this->assertStringNotContainsString('diğer hizmet başlıklarını tek sayfada inceleyin', $content);
    }
}