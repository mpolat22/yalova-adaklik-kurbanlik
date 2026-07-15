<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServiceCardCtaTest extends TestCase
{
    public function test_service_cards_use_a_service_specific_call_to_action(): void
    {
        $pages = [
            [route('home'), 9],
            [route('services'), 9],
            [route('kurbanlik'), 8],
        ];

        foreach ($pages as [$url, $expectedCount]) {
            $content = $this->get($url)->assertOk()->getContent();

            $this->assertSame($expectedCount, substr_count($content, 'Hizmetimizi İnceleyin'));
            $this->assertStringNotContainsString('Devamını Oku', $content);
        }
    }
}