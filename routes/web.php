<?php

use App\Http\Controllers\AdminFacilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SuperAdminUserController;
use App\Http\Controllers\UserReservationController;

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

    Route::get('facilities', [AdminFacilityController::class, 'index'])->name('facilities.index');
    Route::get('facilities/create', [AdminFacilityController::class, 'create'])->name('facilities.create');
    Route::post('facilities', [AdminFacilityController::class, 'store'])->name('facilities.store');
    Route::get('facilities/{id}/edit', [AdminFacilityController::class, 'edit'])->name('facilities.edit');
    Route::put('facilities/{id}', [AdminFacilityController::class, 'update'])->name('facilities.update');
    Route::get('facilities/{id}', [AdminFacilityController::class, 'show'])->name('facilities.show');
    Route::delete('facilities/{id}', [AdminFacilityController::class, 'destroy'])->name('facilities.destroy');
});

// Route untuk User
Route::middleware('user')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
    
    Route::get('reservasi/create', [UserReservationController::class, 'create'])->name('reservasi.create');
    Route::post('reservasi', [UserReservationController::class, 'store'])->name('reservasi.store');
    Route::get('reservasi/history', [UserReservationController::class, 'history'])->name('reservasi.history');
    Route::get('reservasi/{id}', [UserReservationController::class, 'show'])->name('reservasi.show');
});