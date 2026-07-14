<?php

namespace Tests\Feature;

use Tests\TestCase;

class GalleryHeroTest extends TestCase
{
    public function test_gallery_hero_uses_the_approved_local_copy(): void
    {
        $this->get(route('gallery'))
            ->assertOk()
            ->assertSee('Yalova Elgin Adaklık ve Kurbanlık Galerisi')
            ->assertSee('Yalova Çiftlikköy’deki işletmemize, küçükbaş hayvanlarımıza ve adaklık ile kurbanlık hizmetlerimize ait fotoğraf ve videoları inceleyebilirsiniz.')
            ->assertDontSee('çiftlik görselleri ve videolarını burada inceleyebilirsiniz');
    }
}