<?php

namespace Tests\Feature;

use Tests\TestCase;

class GoogleAnalyticsTagTest extends TestCase
{
    public function test_google_tag_is_loaded_once_on_every_public_page(): void
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
            $content = $this->get($path)->assertOk()->getContent();

            $this->assertSame(
                1,
                substr_count($content, 'https://www.googletagmanager.com/gtag/js?id=G-7LPT3RVJDW'),
                "Google tag should be loaded once on {$path}."
            );
            $this->assertStringContainsString("gtag('config', 'G-7LPT3RVJDW');", $content);
            $this->assertLessThan(
                strpos($content, '<meta charset="utf-8">'),
                strpos($content, '<!-- Google tag (gtag.js) -->')
            );
        }
    }
}
