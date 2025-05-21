<?php

use App\Http\Controllers\AdminFacilityController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SuperAdminReservationController;
use App\Http\Controllers\SuperAdminUserController;
use App\Http\Controllers\UserReservationController;

Route::get('/', [LandingPageController::class, 'home'])->name('home');
Route::get('/reservasi', [LandingPageController::class, 'reservasi'])->name('reservasi');
Route::get('/jadwal-reservasi', [LandingPageController::class, 'jadwalReservasi'])->name('jadwal.reservasi');

Route::get('/reservasi/{id}', [LandingPageController::class, 'reservasiShow'])->name('landing.reservasi.show');
Route::get('/informasi', [LandingPageController::class, 'informasi'])->name('informasi');
Route::get('informasi/article/{slug}', [LandingPageController::class, 'showArticle'])->name('article.show');

Route::get('/faq', [LandingPageController::class, 'faq'])->name('faq');

// Route auth All
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route Guest
Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ROUTE UNTUK SUPER ADMIN
Route::middleware('superAdmin')->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'speradminDashboard'])->name('dashboard');
    // Route untuk Admin Management
    Route::prefix('admin-management')->name('admin-management.')->group(function () {
        Route::get('/', [SuperAdminUserController::class, 'index'])->name('index');
        Route::get('/create', [SuperAdminUserController::class, 'create'])->name('create');
        Route::post('/', [SuperAdminUserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SuperAdminUserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SuperAdminUserController::class, 'update'])->name('update');
    });

    // Route untuk Artikel
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{slug}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::put('/{slug}', [ArticleController::class, 'update'])->name('update');
        Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
        Route::delete('/{slug}', [ArticleController::class, 'destroy'])->name('destroy');
    });

    // Route untuk pengajuan areservasi
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::get('/', [SuperAdminReservationController::class, 'index'])->name('index');
        Route::get('/Approved', [SuperAdminReservationController::class, 'indexApproved'])->name('indexapproved');
        Route::get('/Verified', [SuperAdminReservationController::class, 'indexVerified'])->name('indexVerified');
        Route::get('/{id}', [SuperAdminReservationController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [SuperAdminReservationController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [SuperAdminReservationController::class, 'reject'])->name('reject');
    });
});


// ROUTE UNTUK ADMIN
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // Route untuk Fasilitas
    Route::prefix('facilities')->name('facilities.')->group(function () {
        Route::get('/', [AdminFacilityController::class, 'index'])->name('index');
        Route::get('/create', [AdminFacilityController::class, 'create'])->name('create');
        Route::post('/', [AdminFacilityController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminFacilityController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminFacilityController::class, 'update'])->name('update');
        Route::get('/{id}', [AdminFacilityController::class, 'show'])->name('show');
        Route::delete('/{id}', [AdminFacilityController::class, 'destroy'])->name('destroy');
    });

    // Route untuk Pengajuan reservasi
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::get('/', [AdminReservationController::class, 'index'])->name('index');
        Route::get('/pending', [AdminReservationController::class, 'indexPending'])->name('indexPending');
        Route::get('/verified', [AdminReservationController::class, 'indexVerified'])->name('indexVerified');
        Route::get('/{id}', [AdminReservationController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [AdminReservationController::class, 'verify'])->name('verify');
        Route::post('/{id}/reject', [AdminReservationController::class, 'reject'])->name('reject');
    });
});

// Route untuk User
Route::middleware('user')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');

    Route::get('reservasi', [UserReservationController::class, 'index'])->name('reservasi.index');
    Route::get('reservasi/create', [UserReservationController::class, 'create'])->name('reservasi.create');
    Route::post('reservasi', [UserReservationController::class, 'store'])->name('reservasi.store');
    Route::get('reservasi/{id}', [UserReservationController::class, 'show'])->name('reservasi.show');
});
