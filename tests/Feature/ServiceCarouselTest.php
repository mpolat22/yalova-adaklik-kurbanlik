<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServiceCarouselTest extends TestCase
{
    public function test_home_page_shows_all_eight_services_after_about_section(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSeeInOrder([
                'Hakkımızda',
                'data-home-about-heading',
                "Yalova'da Güvenilir Adaklık ve Kurbanlık Hizmeti",
                'data-home-about-grid',
                'Hizmetlerimiz',
                'Yalova’da Adaklık ve Kurbanlık Hizmetlerimiz',
                'Yalova ve Çiftlikköy’de adaklık, kurbanlık, akika ve şükür kurbanı ihtiyaçlarınız',
            ]);

        $content = $response->getContent();

        $this->assertSame(8, substr_count($content, 'data-carousel-card'));
        $this->assertSame(5, substr_count($content, 'class="section-badge"'));
        $this->assertSame(6, substr_count($content, 'bg-[linear-gradient(135deg,#fbf6ef_0%,#f3efe6_42%,#eef2ea_100%)]'));
    }

    public function test_service_detail_page_keeps_showing_the_other_seven_services(): void
    {
        $response = $this->get(route('kurbanlik'));

        $response->assertOk()
            ->assertSee('Diğer hizmetlerimiz');

        $this->assertSame(7, substr_count($response->getContent(), 'data-carousel-card'));
    }

    public function test_service_carousel_arrows_stay_available_on_mobile(): void
    {
        $view = file_get_contents(resource_path('views/partials/service-carousel.blade.php'));
        $script = file_get_contents(resource_path('js/app.js'));

        $this->assertStringContainsString('data-carousel-prev', $view);
        $this->assertStringContainsString('data-carousel-next', $view);
        $this->assertStringContainsString('inline-flex h-11', $view);
        $this->assertStringNotContainsString('xl:inline-flex', $view);
        $this->assertStringNotContainsString("window.innerWidth < 1280", $script);
    }}