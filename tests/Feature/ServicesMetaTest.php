<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesMetaTest extends TestCase
{
    public function test_services_page_uses_the_approved_yalova_focused_meta_description(): void
    {
        $content = $this->get(route('services'))->assertOk()->getContent();
        $description = 'Yalova’da adaklık ve kurbanlık için küçükbaş satışından İslami kesime, ücretsiz parçalama ve paketlemeden vekâletle dağıtıma kadar hizmetlerimizi inceleyin.';

        $this->assertStringContainsString('<meta name="description" content="' . $description . '">', $content);
        $this->assertStringContainsString('<meta property="og:description" content="' . $description . '">', $content);
        $this->assertStringContainsString('<meta name="twitter:description" content="' . $description . '">', $content);
        $this->assertStringNotContainsString('diğer hizmet başlıklarını tek sayfada inceleyin', $content);
    }
}