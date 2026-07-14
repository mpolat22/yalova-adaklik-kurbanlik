<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactCtaTitleTest extends TestCase
{
    public function test_shared_contact_section_uses_the_consistent_title_case_heading(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee("Yalova'da Adaklık ve Kurbanlık İçin Bize Ulaşın")
            ->assertDontSee("Yalova'da adaklık ve kurbanlık için bize ulaşın");
    }
}