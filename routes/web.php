<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SuperAdminUserController;

Route::get('/', [LandingPageController::class, 'home'])->name('home');
Route::get('/reservasi', [LandingPageController::class, 'reservasi'])->name('reservasi');
Route::get('/informasi', [LandingPageController::class, 'informasi'])->name('informasi');
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

// Route untuk Super Admin
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
});


// Route untuk Admin
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
});

// Route untuk User
Route::middleware('user')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
});
