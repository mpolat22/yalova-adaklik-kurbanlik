<?php

namespace Tests\Feature;

use Tests\TestCase;

class GalleryLightboxTest extends TestCase
{
    public function test_gallery_images_open_in_the_shared_in_site_lightbox(): void
    {
        $content = $this->get(route('gallery'))->assertOk()->getContent();
        $itemCount = substr_count($content, 'data-gallery-page-item');

        $this->assertGreaterThan(0, $itemCount);
        $this->assertSame($itemCount, substr_count($content, 'data-gallery-src='));
        $this->assertSame(1, substr_count($content, 'data-gallery-lightbox-root'));
        $this->assertStringContainsString('aria-keyshortcuts="ArrowLeft"', $content);
        $this->assertStringContainsString('aria-keyshortcuts="ArrowRight"', $content);
        $this->assertStringContainsString('aria-keyshortcuts="Escape"', $content);
        $this->assertStringNotContainsString('target="_blank" rel="noopener" class="block overflow-hidden"', $content);
    }

    public function test_home_and_gallery_pages_use_the_same_gallery_controller(): void
    {
        $script = file_get_contents(resource_path('js/app.js'));

        $this->assertStringContainsString("document.querySelectorAll('[data-gallery-root]')", $script);
        $this->assertStringContainsString("gallery.querySelectorAll('[data-gallery-item]')", $script);
        $this->assertStringContainsString("event.key === 'ArrowLeft'", $script);
        $this->assertStringContainsString("event.key === 'ArrowRight'", $script);
        $this->assertStringContainsString("event.key === 'Escape'", $script);
        $this->assertStringContainsString('setupGallery();', $script);
        $this->assertStringNotContainsString('setupHomeGallery();', $script);
    }
}