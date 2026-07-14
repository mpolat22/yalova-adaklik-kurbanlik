<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutHeroTest extends TestCase
{
    public function test_about_hero_uses_the_approved_local_experience_copy(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Yalova Elgin Adaklık ve Kurbanlık Hakkında')
            ->assertSee('data-about-section-eyebrow', false)
            ->assertDontSee('Yalova merkezli yerel işletme')
            ->assertSee('Yaklaşık 30 yıllık tecrübemizle Yalova Çiftlikköy’de küçükbaş yetiştiriyor; adaklık ve kurbanlık süreçlerini İslami usullere uygun şekilde yürütüyoruz.');
    }
}