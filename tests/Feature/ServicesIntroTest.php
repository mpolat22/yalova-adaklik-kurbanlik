<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesIntroTest extends TestCase
{
    public function test_services_intro_uses_the_approved_local_seo_copy(): void
    {
        $content = $this->get(route('services'))->assertOk()->getContent();

        $this->assertStringContainsString('Yalova Adaklık ve Kurbanlık Hizmetlerimiz', $content);
        $this->assertStringContainsString('Yalova ve Çiftlikköy’de adaklık, kurbanlık, akika ve şükür kurbanı ihtiyaçlarınız için koyun, kuzu, koç ve keçi seçenekleri sunuyoruz.', $content);
        $this->assertStringContainsString('ücretsiz parçalama ve paketlemeden vekâletle kesim ve dağıtıma kadar', $content);
        $this->assertStringNotContainsString('adak kurban bağışı', $content);
        $this->assertStringNotContainsString('sunduğumuz temel hizmetler', $content);
    }
}