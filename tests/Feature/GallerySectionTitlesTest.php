<?php

namespace Tests\Feature;

use Tests\TestCase;

class GallerySectionTitlesTest extends TestCase
{
    public function test_gallery_photo_and_video_sections_use_the_approved_business_wording(): void
    {
        $content = $this->get(route('gallery'))->assertOk()->getContent();

        $this->assertStringContainsString('İşletmemizden Güncel Fotoğraflar', $content);
        $this->assertStringContainsString('İşletmemizden Kısa Videolar', $content);
        $this->assertStringNotContainsString('Çiftliğimizden fotoğraf kareleri', $content);
        $this->assertStringNotContainsString('Çiftliğimizden kısa videolar', $content);
    }
}