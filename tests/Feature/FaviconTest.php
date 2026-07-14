<?php

namespace Tests\Feature;

use Tests\TestCase;

class FaviconTest extends TestCase
{
    public function test_site_layout_exposes_the_logo_favicon_set(): void
    {
        $content = $this->get(route('home'))->assertOk()->getContent();

        $this->assertStringContainsString('href="' . asset('favicon.ico') . '"', $content);
        $this->assertStringContainsString('href="' . asset('favicon-32x32.png') . '"', $content);
        $this->assertStringContainsString('href="' . asset('apple-touch-icon.png') . '"', $content);
        $this->assertStringContainsString('href="' . asset('site.webmanifest') . '"', $content);
    }

    public function test_favicon_files_have_the_expected_dimensions(): void
    {
        $expectedSizes = [
            'favicon-32x32.png' => [32, 32],
            'apple-touch-icon.png' => [180, 180],
            'android-chrome-192x192.png' => [192, 192],
            'android-chrome-512x512.png' => [512, 512],
        ];

        $this->assertFileExists(public_path('favicon.ico'));

        foreach ($expectedSizes as $file => $expectedSize) {
            $path = public_path($file);
            $this->assertFileExists($path);
            $this->assertSame($expectedSize, array_slice(getimagesize($path), 0, 2));
        }

        $manifest = json_decode(file_get_contents(public_path('site.webmanifest')), true, flags: JSON_THROW_ON_ERROR);
        $this->assertSame('Elgin Adaklık ve Kurbanlık', $manifest['name']);
        $this->assertCount(2, $manifest['icons']);
    }
}