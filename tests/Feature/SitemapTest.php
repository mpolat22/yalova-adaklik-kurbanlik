<?php

namespace Tests\Feature;

use Tests\TestCase;

class SitemapTest extends TestCase
{
    public function test_sitemap_contains_all_fourteen_public_pages(): void
    {
        $content = $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->getContent();

        $this->assertSame(14, substr_count($content, '<loc>'));
        $this->assertStringContainsString(
            route('services.show', ['slug' => 'yalova-acilis-temel-atma-adaklik-kesimi']),
            $content
        );
    }
}
