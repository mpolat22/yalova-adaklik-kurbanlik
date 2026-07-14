<?php

namespace Tests\Feature;

use Tests\TestCase;

class TrustCardLayoutTest extends TestCase
{
    public function test_home_and_about_trust_card_descriptions_are_darker_and_close_to_their_headings(): void
    {
        foreach (['home', 'about'] as $routeName) {
            $content = $this->get(route($routeName))->assertOk()->getContent();

            $this->assertStringNotContainsString('class="flex gap-4 sm:min-h-36', $content);
            $this->assertSame(4, substr_count($content, 'class="mt-3 text-sm leading-7 text-brand-700"'));
        }
    }
}