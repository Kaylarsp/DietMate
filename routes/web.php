<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminDietPlanController;
use App\Http\Controllers\AdminWorkoutController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\FoodRecommendationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkoutRecommendationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('landingpage');
});

// Tampilkan halaman login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// Proses form login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Halaman register (agar link "Daftar Sekarang" tidak error)
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

// Lupa password (agar link "Lupa Password" tidak error)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/login/google', function () {
    abort(501, 'Google login belum dikonfigurasi.');
})->middleware('guest')->name('login.google');

Route::get('/login/apple', function () {
    abort(501, 'Apple login belum dikonfigurasi.');
})->middleware('guest')->name('login.apple');

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile-dashboard', [UserProfileController::class, 'index'])->name('profile.dashboard');
    Route::post('/profile-dashboard/update', [UserProfileController::class, 'update'])->name('profile.update');
});

Route::controller(UserProfileController::class)->group(function () {

    Route::get('/profile-register', 'index');

    Route::post('/profile-register', 'register')
        ->name('profile-register');

});

Route::get('/menu', [FoodRecommendationController::class, 'index'])->name('user.menu');

Route::get('/olahraga', [WorkoutRecommendationController::class, 'index'])->name('user.olahraga');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Admin Kelola Menu Makanan
Route::get('/admin/kelola-menu-makanan', [AdminMenuController::class, 'index'])->name('admin.menu');

// Admin Kelola Diet Plan
Route::get('/admin/kelola-diet-plan', [AdminDietPlanController::class, 'index'])->name('admin.diet-plan');

// Admin Kelola Olahraga
Route::get('/admin/kelola-olahraga', [AdminWorkoutController::class, 'index'])->name('admin.exercise');

// Admin Kelola User
Route::get('/admin/kelola-akun-user', [AdminUserController::class, 'index'])->name('admin.users.account');
Route::get('/admin/kelola-profile-user', [AdminUserController::class, 'profile'])->name('admin.users.profile');
