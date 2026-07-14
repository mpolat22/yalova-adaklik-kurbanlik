<?php

namespace Tests\Feature;

use Tests\TestCase;

class GalleryIntroTest extends TestCase
{
    public function test_gallery_intro_uses_the_approved_copy_and_contextual_internal_links(): void
    {
        $content = $this->get(route('gallery'))->assertOk()->getContent();

        $this->assertStringContainsString('Yalova Adaklık ve Kurbanlık Galerisi', $content);
        $this->assertStringContainsString('Galerimizde Yalova Çiftlikköy’deki işletmemizi, yetiştirdiğimiz koyun, kuzu, koç ve keçileri;', $content);
        $this->assertSame(3, substr_count($content, 'data-gallery-intro-link'));
        $this->assertStringContainsString('href="' . route('adaklik') . '"', $content);
        $this->assertStringContainsString('href="' . route('kurbanlik') . '"', $content);
        $this->assertStringContainsString('href="' . route('services') . '"', $content);
        $this->assertStringNotContainsString("Yalova'dan güncel görseller ve videolar", $content);
        $this->assertStringNotContainsString('paylaşıma uygun videoları', $content);
    }
}