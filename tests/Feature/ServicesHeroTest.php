<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesHeroTest extends TestCase
{
    public function test_services_hero_uses_the_approved_concise_copy(): void
    {
        $this->get(route('services'))
            ->assertOk()
            ->assertSee('Yalova Elgin Adaklık ve Kurbanlık Hizmetlerimiz')
            ->assertSee('Yalova’da adaklık ve kurbanlık ihtiyaçlarınız için küçükbaş satışı, İslami usullere uygun kesim, parçalama, paketleme ve vekâlet hizmetleri sunuyoruz.')
            ->assertDontSee('hizmetlerimizi tek sayfada inceleyin');
    }
}