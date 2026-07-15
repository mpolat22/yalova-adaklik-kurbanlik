<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $pages = [
            route('home'),
            route('about'),
            route('services'),
            route('adaklik'),
            route('kurbanlik'),
            route('services.show', 'yalova-adaklik-kurbanlik-ucretsiz-parcalama-ve-paketleme'),
            route('services.show', 'yalova-adaklik-kurbanlik-kapali-ve-hijyenik-ortamda-kesim'),
            route('services.show', 'yalova-adaklik-kurbanlik-vekalet-ile-kesim-ve-dagitim'),
            route('services.show', 'yalova-adaklik-kurbanlik-uygun-fiyat-garantisi'),
            route('services.show', 'yalova-adaklik-kurbanlik-kolay-odeme-imkani'),
            route('services.show', 'yalova-adaklik-kurbanlik-canli-hayvan-alim-satimi'),
            route('services.show', 'yalova-acilis-temel-atma-adaklik-kesimi'),
            route('gallery'),
            route('contact'),
        ];

        return response()
            ->view('sitemap', ['pages' => $pages])
            ->header('Content-Type', 'application/xml');
    }
}
