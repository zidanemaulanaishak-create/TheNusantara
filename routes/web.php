<?php

use App\Http\Controllers\Admin\CatatanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\GaleriAdminController;
use App\Http\Controllers\Admin\InformasiAdminController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\PulauAdminController;
use App\Http\Controllers\Admin\TentangAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PulauController;
use Illuminate\Support\Facades\Route;

// Public (pengganti landingpage.php, pulau_detail.php, detailinformasi.php, halamangaleri.php)
Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/pulau/{id}', [PulauController::class, 'show'])->name('pulau.show');
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');

// API siap React (pengganti admin/api_pulau.php)
Route::get('/api/pulau', [PulauController::class, 'apiIndex'])->name('api.pulau');

// Auth (pengganti login.php, proseslogin.php, register.php)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Admin (pengganti admin/admin.php?page=...)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/pulau', [PulauAdminController::class, 'index'])->name('admin.pulau.index');
    Route::get('/pulau/tambah', [PulauAdminController::class, 'create'])->name('admin.pulau.create');
    Route::post('/pulau', [PulauAdminController::class, 'store'])->name('admin.pulau.store');
    Route::get('/pulau/{id}/edit', [PulauAdminController::class, 'edit'])->name('admin.pulau.edit');
    Route::put('/pulau/{id}', [PulauAdminController::class, 'update'])->name('admin.pulau.update');
    Route::get('/pulau/hapus/{id}', [PulauAdminController::class, 'destroy'])->name('admin.pulau.destroy');

    Route::get('/informasi', [InformasiAdminController::class, 'index'])->name('admin.informasi.index');
    Route::get('/informasi/tambah', [InformasiAdminController::class, 'create'])->name('admin.informasi.create');
    Route::post('/informasi', [InformasiAdminController::class, 'store'])->name('admin.informasi.store');
    Route::get('/informasi/{id}/edit', [InformasiAdminController::class, 'edit'])->name('admin.informasi.edit');
    Route::put('/informasi/{id}', [InformasiAdminController::class, 'update'])->name('admin.informasi.update');
    Route::get('/informasi/hapus/{id}', [InformasiAdminController::class, 'destroy'])->name('admin.informasi.destroy');

    Route::get('/galeri', [GaleriAdminController::class, 'index'])->name('admin.galeri.index');
    Route::post('/galeri', [GaleriAdminController::class, 'store'])->name('admin.galeri.store');
    Route::put('/galeri/{id}', [GaleriAdminController::class, 'update'])->name('admin.galeri.update');
    Route::get('/galeri/hapus/{id}', [GaleriAdminController::class, 'destroy'])->name('admin.galeri.destroy');

    Route::get('/faq', [FaqAdminController::class, 'index'])->name('admin.faq.index');
    Route::post('/faq', [FaqAdminController::class, 'store'])->name('admin.faq.store');
    Route::put('/faq/{id}', [FaqAdminController::class, 'update'])->name('admin.faq.update');
    Route::get('/faq/hapus/{id}', [FaqAdminController::class, 'destroy'])->name('admin.faq.destroy');

    Route::get('/laporan', [LaporanAdminController::class, 'index'])->name('admin.laporan.index');
    Route::post('/laporan-status', [LaporanAdminController::class, 'updateStatus'])->name('admin.laporan.status');
    Route::get('/laporan/hapus/{id}', [LaporanAdminController::class, 'destroy'])->name('admin.laporan.destroy');
    Route::post('/notifikasi/baca', [LaporanAdminController::class, 'markNotifRead'])->name('admin.notif.read');

    Route::get('/tentang', [TentangAdminController::class, 'index'])->name('admin.tentang.index');
    Route::get('/tentang/tambah', [TentangAdminController::class, 'create'])->name('admin.tentang.create');
    Route::post('/tentang', [TentangAdminController::class, 'store'])->name('admin.tentang.store');
    Route::get('/tentang/{id}/edit', [TentangAdminController::class, 'edit'])->name('admin.tentang.edit');
    Route::put('/tentang/{id}', [TentangAdminController::class, 'update'])->name('admin.tentang.update');
    Route::get('/tentang/hapus/{id}', [TentangAdminController::class, 'destroy'])->name('admin.tentang.destroy');

    Route::post('/catatan', [CatatanController::class, 'handle'])->name('admin.catatan');
});
