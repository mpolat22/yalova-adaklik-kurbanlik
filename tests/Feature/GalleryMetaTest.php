<?php

namespace Tests\Feature;

use Tests\TestCase;

class GalleryMetaTest extends TestCase
{
    public function test_gallery_meta_and_collection_schema_use_the_approved_copy(): void
    {
        $content = $this->get(route('gallery'))->assertOk()->getContent();
        $description = 'Yalova’daki adaklık ve kurbanlık hizmetlerimizi, küçükbaş hayvanlarımızı ve işletme ortamımızı güncel fotoğraf ve kısa videolarla inceleyin.';

        $this->assertStringContainsString('<meta name="description" content="' . $description . '">', $content);
        $this->assertStringContainsString('<meta property="og:description" content="' . $description . '">', $content);
        $this->assertStringContainsString('<meta name="twitter:description" content="' . $description . '">', $content);
        $this->assertStringContainsString('"@type":"CollectionPage"', $content);
        $this->assertGreaterThanOrEqual(4, substr_count($content, $description));
        $this->assertStringNotContainsString('çiftlik görselleri ve videolarını inceleyin', $content);
        $this->assertStringNotContainsString('galerimizde yer alan güncel görseller ve videolar', $content);
    }
}