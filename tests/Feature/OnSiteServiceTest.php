<?php

namespace Tests\Feature;

use Tests\TestCase;

class OnSiteServiceTest extends TestCase
{
    public function test_on_site_service_uses_the_approved_content_and_seo(): void
    {
        $path = '/hizmetler/yalova-acilis-temel-atma-adaklik-kesimi';
        $content = $this->get($path)->assertOk()->getContent();

        $this->assertStringContainsString('<title>Yalova Açılış ve Temel Atma Adaklık Kesimi | Elgin</title>', $content);
        $this->assertStringContainsString('<link rel="canonical" href="' . url($path) . '">', $content);
        $this->assertStringContainsString('Açılış ve Temel Atma İçin Yerinde Kesim', $content);
        $this->assertStringContainsString('Yalova’da Açılış ve Temel Atma Organizasyonlarına Özel Hizmet', $content);
        $this->assertStringContainsString('Kendi Aracımızla Adrese Ulaşım', $content);
        $this->assertStringContainsString('İslami Usullere Uygun Yerinde Kesim', $content);
        $this->assertStringContainsString('Yüzme, Parçalama ve Paketleme', $content);
        $this->assertStringContainsString('Organizasyon Öncesinde Belirlenen Hizmet Akışı', $content);
        $this->assertStringContainsString('images/yalova-acilis-temel-atma-adaklik-kesimi.webp', $content);
        $this->assertSame(8, substr_count($content, 'data-carousel-card'));
    }

    public function test_on_site_service_image_has_the_expected_dimensions(): void
    {
        $imagePath = public_path('images/yalova-acilis-temel-atma-adaklik-kesimi.webp');

        $this->assertFileExists($imagePath);

        [$width, $height] = getimagesize($imagePath);

        $this->assertSame(941, $width);
        $this->assertSame(1672, $height);
    }
}
