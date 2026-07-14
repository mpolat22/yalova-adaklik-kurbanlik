<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class GalleryVideoPosterTest extends TestCase
{
    public function test_each_gallery_video_has_a_real_local_poster(): void
    {
        $videoFiles = collect(File::files(public_path('videos/gallery')))
            ->filter(fn ($file): bool => strtolower($file->getExtension()) === 'mp4')
            ->values();

        $response = $this->get(route('gallery'))->assertOk();
        $content = $response->getContent();

        $this->assertNotEmpty($videoFiles);
        $this->assertSame($videoFiles->count(), substr_count($content, ' poster="'));

        foreach ($videoFiles as $videoFile) {
            $posterName = $videoFile->getFilenameWithoutExtension() . '.webp';
            $posterPath = public_path('images/gallery/video-posters/' . $posterName);

            $this->assertFileExists($posterPath);
            $response->assertSee(asset('images/gallery/video-posters/' . $posterName), false);
        }

        $response
            ->assertSee('preload="metadata"', false)
            ->assertSee('bg-brand-900', false)
            ->assertDontSee('bg-brand-950', false);
    }
}
