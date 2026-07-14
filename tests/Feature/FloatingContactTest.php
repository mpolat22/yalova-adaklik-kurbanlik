<?php

namespace Tests\Feature;

use Tests\TestCase;

class FloatingContactTest extends TestCase
{
    public function test_floating_contact_is_rendered_on_main_pages(): void
    {
        $paths = [
            '/',
            '/hakkimizda',
            '/hizmetler',
            '/galeri',
            '/iletisim',
            '/yalova-adaklik',
            '/yalova-kurbanlik',
        ];

        foreach ($paths as $path) {
            $this->get($path)
                ->assertOk()
                ->assertSee('data-floating-contact', false)
                ->assertSee('WhatsApp İletişim')
                ->assertSee('Hemen Ara')
                ->assertSee('https://wa.me/905413649379', false)
                ->assertSee('tel:+905413649379', false);
        }
    }

    public function test_floating_contact_starts_open_without_a_toggle_button(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('class="floating-contact is-open"', false)
            ->assertSee('id="floating-contact-actions"', false)
            ->assertDontSee('data-floating-contact-toggle', false);
    }
}
