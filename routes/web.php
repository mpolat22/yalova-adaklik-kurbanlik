<?php

use App\Http\Controllers\GalleryPageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/hizmetler', [PageController::class, 'services'])->name('services');
Route::get('/yalova-adaklik', [PageController::class, 'adaklik'])->name('adaklik');
Route::get('/yalova-kurbanlik', [PageController::class, 'kurbanlik'])->name('kurbanlik');
Route::get('/hizmetler/{slug}', [PageController::class, 'service'])->name('services.show');
Route::get('/hakkimizda', [PageController::class, 'about'])->name('about');
Route::get('/galeri', GalleryPageController::class)->name('gallery');
Route::get('/iletisim', [PageController::class, 'contact'])->name('contact');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
