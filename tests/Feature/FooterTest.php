<?php

namespace Tests\Feature;

use Tests\TestCase;

class FooterTest extends TestCase
{
    public function test_footer_uses_the_brand_logo_seo_copy_and_mobile_carousel(): void
    {
        $content = $this->get(route('home'))->assertOk()->getContent();

        $this->assertGreaterThanOrEqual(2, substr_count($content, 'images/elgin-logo.png'));
        $this->assertStringContainsString('Hızlı Bağlantılar', $content);
        $this->assertStringContainsString("Yalova'nın Çiftlikköy ilçesinde yaklaşık 30 yıllık tecrübemizle", $content);
        $this->assertStringNotContainsString('kolay iletişim sunar', $content);
        $this->assertStringNotContainsString('Footer bölümlerini görmek için yana kaydırın', $content);
        $this->assertStringContainsString('data-footer-carousel', $content);
        $this->assertStringContainsString('overflow-x-auto', $content);
        $this->assertStringContainsString('snap-mandatory', $content);
        $this->assertStringContainsString('lg:grid', $content);
        $this->assertStringContainsString('data-footer-contact-list', $content);
    }

    public function test_new_email_address_is_used_across_site_pages(): void
    {
        foreach ([route('home'), route('gallery'), route('contact')] as $url) {
            $content = $this->get($url)->assertOk()->getContent();

            $this->assertStringContainsString('mailto:yalovadaklik@hotmail.com', $content);
            $this->assertStringContainsString('yalovadaklik@hotmail.com', $content);
            $this->assertStringNotContainsString('serhatelgin77@icloud.com', $content);
        }
    }
}