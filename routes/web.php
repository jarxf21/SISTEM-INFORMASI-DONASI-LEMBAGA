<?php

use App\Http\Controllers\Halo\test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PublicDonasiController;
use App\Http\Controllers\PublicCampaignController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\HomepagedonasiController;
use App\Http\Controllers\KategoriHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RiwayatCampaignController;
use App\Http\Controllers\CampaignController;

Route::get('/coba', function () {
    return view('welcome');
});

Route::get('/beranda', function () {
    return view('homepage');
});
Route::get('/kegiatan', function () {
    return view('kegiatan.kegiatan');
});
Route::get('/donasi', function () {
    return view('donasi.donasi');
});
Route::get('/program', function () {
    return view('program');
});
Route::get('/campaign', function () {
    return view('campaign.campaign');
});

Route::get('/campaign/riwayat_campaign/{campaign:slug}', [CampaignController::class, 'history'])
    ->name('campaign.riwayat_campaign');

Route::get('/campaign/{campaign:slug}', [CampaignController::class, 'show'])
    ->name('campaign.show');

// Route::get('/riwayat_campaign', function () {
//     return view('campaign.riwayat');
// });
// Ubah route ini:
Route::get('/riwayat_campaign', [RiwayatCampaignController::class, 'index'])->name('campaign.riwayat');
Route::get('/kontak', function () {
    return view('kontak');
});


// Route::get('/galeri_kegiatan', [UploadController::class, 'index']);
Route::get('/donasi', [PublicDonasiController::class, 'index'])->name('donasi.index');
// Route::get('/beranda', [HeroSectionController::class, 'index']);
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/{kategoriSlug}', [KegiatanController::class, 'filterByKategori'])->name('kegiatan.byKategori');
// Route::get('/beranda', [HomepageDonasiController::class, 'index'])->name('homepage');
Route::get('/kegiatan/detail/{slug}', [KegiatanController::class, 'detail'])->name('kegiatan.detail');
Route::get('/kegiatan/page-{page}', [KegiatanController::class, 'index']);
Route::get('/campaign', [PublicCampaignController::class, 'index'])->name('campaign.index');

// routes/web.php
Route::get('/campaign', [PublicCampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/filter', [PublicCampaignController::class, 'filter'])->name('campaign.filter');
Route::get('/campaign/{id}', [PublicCampaignController::class, 'show'])->name('campaign.show');
Route::get('/donasi/{campaign_id}', [PublicDonasiController::class, 'form'])->name('donasi.form');
Route::get('/beranda', [HomeController::class, 'index'])->name('homepage');

//riwayat RiwayatCampaignController
// Route::get('/riwayat_campaign', [RiwayatCampaignController::class, 'index'])->name('campaign.index');





