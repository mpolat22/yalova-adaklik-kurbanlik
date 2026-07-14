<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeGalleryTest extends TestCase
{
    public function test_home_page_shows_an_eight_image_gallery_preview_and_internal_link(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSeeInOrder([
                'Hizmetlerimiz',
                'Galeri',
                'Yalova Adaklık ve Kurbanlık',
                'Galerimiz',
                'Tüm Galeriyi Gör',
            ])
            ->assertSee(route('gallery'), false)
            ->assertDontSee('<video', false);

        $content = $response->getContent();

        $this->assertSame(8, substr_count($content, 'data-home-gallery-item'));
        $this->assertSame(1, substr_count($content, 'data-gallery-lightbox-root'));
        $this->assertStringContainsString('aria-keyshortcuts="ArrowLeft"', $content);
        $this->assertStringContainsString('aria-keyshortcuts="ArrowRight"', $content);
        $this->assertStringContainsString('aria-keyshortcuts="Escape"', $content);
    }

    public function test_gallery_script_supports_keyboard_navigation_and_closing(): void
    {
        $script = file_get_contents(resource_path('js/app.js'));

        $this->assertStringContainsString("event.key === 'ArrowLeft'", $script);
        $this->assertStringContainsString("event.key === 'ArrowRight'", $script);
        $this->assertStringContainsString("event.key === 'Escape'", $script);
        $this->assertStringContainsString('setupGallery();', $script);
    }
}