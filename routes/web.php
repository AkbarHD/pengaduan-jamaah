<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaduanAdminController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/tentang', [HomeController::class, 'about'])->name('tentang');
Route::get('/panduan-pencegahan', [HomeController::class, 'panduan'])->name('panduan');
Route::get('/cek-status', [HomeController::class, 'cekStatus'])->name('cek-status');

Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/panduan-pencegahan/{slug}', [HomeController::class, 'panduanDetail'])->name('panduan.detail');
Route::get('/panduan-pencegahan/{slug}/download', [HomeController::class, 'panduanDownload'])->name('panduan.download');
Route::get('/pengaduan/sukses/{nomor}', [PengaduanController::class, 'sukses'])->name('pengaduan.sukses');
Route::post('/cek-status/check', [PengaduanController::class, 'cekStatus'])->name('cek-status.check');

Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [HomeController::class, 'beritaDetail'])->name('berita.detail');

// Guest only — kalau sudah login, otomatis dilempar ke dashboard
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('berita', BeritaController::class)
    ->except(['show'])
    ->parameters(['berita' => 'berita']);

        Route::get('artikel/{artikel}/download', [ArtikelController::class, 'downloadPdf'])->name('artikel.download');
        Route::resource('artikel', ArtikelController::class)->except(['show']);

        Route::get('pengaduan', [PengaduanAdminController::class, 'index'])->name('pengaduan.index');
        Route::get('pengaduan/{pengaduan}', [PengaduanAdminController::class, 'show'])->name('pengaduan.show');
        Route::put('pengaduan/{pengaduan}/status', [PengaduanAdminController::class, 'updateStatus'])->name('pengaduan.update-status');
        Route::post('pengaduan/{pengaduan}/forward-kjri', [PengaduanAdminController::class, 'forwardKjri'])->name('pengaduan.forward-kjri');
    });
});
