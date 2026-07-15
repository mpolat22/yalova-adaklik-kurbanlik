<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeFaqTest extends TestCase
{
    public function test_home_page_shows_seven_closed_seo_faq_items_between_gallery_and_contact(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSeeInOrder([
                'Yalova Adaklık ve Kurbanlık',
                'Galerimiz',
                'Sıkça Sorulan Sorular',
                'Yalova Adaklık ve Kurbanlık Hakkında Merak Edilenler',
                'Yalova’da adaklık ve kurbanlık seçimi nasıl yapılır?',
                'Ödemelerde nakit ve EFT/Havale kabul ediyoruz.',
                'İletişim',
            ]);

        $content = $response->getContent();

        $this->assertSame(7, substr_count($content, 'data-home-faq-item'));
        $this->assertSame(0, preg_match('/<details[^>]*data-home-faq-item[^>]*\sopen(?:\s|>)/', $content));
        $this->assertStringContainsString('name="home-faq"', $content);
    }

    public function test_home_page_faq_schema_matches_visible_payment_information(): void
    {
        $content = $this->get(route('home'))->assertOk()->getContent();

        $this->assertStringContainsString('"@type":"FAQPage"', $content);
        $this->assertStringContainsString('Ödemelerde nakit ve EFT/Havale kabul ediyoruz.', $content);
        $this->assertSame(7, substr_count($content, '"@type":"Question"'));
        $this->assertSame(7, substr_count($content, '"@type":"Answer"'));
        $this->assertStringContainsString('Açılış veya temel atma alanında kesim yapıyor musunuz?', $content);
    }
}
