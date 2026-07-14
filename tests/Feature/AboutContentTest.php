<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutContentTest extends TestCase
{
    public function test_about_content_uses_the_approved_copy_and_contextual_internal_links(): void
    {
        $content = $this->get(route('about'))->assertOk()->getContent();

        $this->assertStringContainsString('Yalova’da İslami Usullere Uygun Adaklık ve Kurbanlık Hizmeti', $content);
        $this->assertStringContainsString('Elgin Adaklık ve Kurbanlık olarak Yalova’nın Çiftlikköy ilçesinde koyun, kuzu, koç ve keçi yetiştiriyoruz.', $content);
        $this->assertStringContainsString('kesim sırasında görüntülü aramayla süreci takip etmelerini sağlıyoruz', $content);
        $this->assertSame(5, substr_count($content, 'data-about-content-link'));
        $this->assertStringContainsString('href="' . route('adaklik') . '"', $content);
        $this->assertStringContainsString('href="' . route('kurbanlik') . '"', $content);
        $this->assertStringContainsString('href="' . route('contact') . '"', $content);
        $this->assertStringNotContainsString('Biz bu işi yalnızca satış olarak görmüyoruz.', $content);
    }
}