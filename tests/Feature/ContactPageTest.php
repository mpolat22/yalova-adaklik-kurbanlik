<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactPageTest extends TestCase
{
    public function test_contact_page_uses_the_short_hero_copy_without_the_legacy_contact_cards(): void
    {
        $content = $this->get(route('contact'))->assertOk()->getContent();
        $heroTitle = "Yalova'da Adaklık ve Kurbanlık İçin Bize Ulaşın";

        $this->assertStringContainsString(e($heroTitle), $content);
        $this->assertStringContainsString('Yalova Çiftlikköy’de adaklık, kurbanlık, akika ve şükür kurbanı ihtiyaçlarınız için telefon veya WhatsApp üzerinden bize ulaşabilirsiniz.', $content);
        $this->assertStringNotContainsString('sosyal medya ve konum bilgilerimiz üzerinden bize doğrudan ulaşabilirsiniz', $content);
        $this->assertStringNotContainsString('class="shell grid gap-6 md:grid-cols-2"', $content);
        $this->assertStringNotContainsString('WhatsApp üzerinden yazın', $content);
        $this->assertStringNotContainsString('Google Haritalar üzerinde görüntüleyin', $content);
        $this->assertStringContainsString('Telefon, WhatsApp ve Konum Bilgilerimiz', $content);
        $this->assertStringContainsString('Adaklık ve kurbanlık hakkında bilgi almak için Serhat Elgin veya Sercan Elgin’e telefonla ulaşabilir;', $content);
        $this->assertSame(1, substr_count($content, e($heroTitle)));
        $this->assertStringNotContainsString("Çiftlikköy Yalova'daki işletmemizde", $content);
    }
}