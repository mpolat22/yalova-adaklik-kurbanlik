<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeroConsistencyTest extends TestCase
{
    public function test_public_pages_share_the_same_framed_hero_component(): void
    {
        $urls = [
            route('home'),
            route('about'),
            route('services'),
            route('gallery'),
            route('contact'),
            route('adaklik'),
            route('kurbanlik'),
            route('services.show', ['slug' => 'yalova-adaklik-kurbanlik-kolay-odeme-imkani']),
        ];

        foreach ($urls as $url) {
            $response = $this->get($url)->assertOk();

            $response->assertSee('hero-stage--framed', false);
            $response->assertSee('hero-overlay--airy', false);
            $response->assertDontSee('hero-kicker', false);
        }
    }

    public function test_generic_page_heroes_use_the_new_bright_daytime_image(): void
    {
        foreach ([route('home'), route('about'), route('services'), route('gallery'), route('contact')] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('images/yalova-adaklik-kurbanlik-hero-ferah.webp', false);
        }
    }
}