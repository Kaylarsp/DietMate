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

// ==========================================
// PUBLIC ROUTES (Bisa diakses siapa saja)
// ==========================================

// Route ke Landing Page (Dihapus salah satu karena duplikat)
Route::get('/', function () {
    return view('landingpage');
})->name('home');

// Kelompokkan semua route yang hanya boleh diakses tamu (belum login)
Route::middleware('guest')->group(function () {
    
    // Tampilkan halaman login
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    // Proses form login
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Halaman register
    Route::get('/register', function () {
        return redirect()->route('profile-register');
    })->name('register');

    // Lupa password
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    // OAuth (Belum dikonfigurasi)
    Route::get('/login/google', function () {
        abort(501, 'Google login belum dikonfigurasi.');
    })->name('login.google');

    Route::get('/login/apple', function () {
        abort(501, 'Apple login belum dikonfigurasi.');
    })->name('login.apple');

    // Profile Register
    Route::controller(UserProfileController::class)->group(function () {
        Route::get('/profile-register', 'index');
        Route::post('/profile-register', 'register')->name('profile-register');
    });
});

// ==========================================
// PROTECTED ROUTES (Wajib Login)
// ==========================================

// Masukkan SEMUA route dashboard, user, dan admin ke dalam middleware 'auth'
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // ------------------------------------------
    // AREA USER
    // ------------------------------------------
    
    // Dashboard User (Dihapus salah satu karena duplikat)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile-dashboard', [UserProfileController::class, 'index'])->name('profile.dashboard');
    Route::post('/profile-dashboard/update', [UserProfileController::class, 'update'])->name('profile.update');

    // Fitur Utama DietMate
    Route::get('/menu', [FoodRecommendationController::class, 'index'])->name('user.menu');
    Route::get('/olahraga', [WorkoutRecommendationController::class, 'index'])->name('user.olahraga');

    // ------------------------------------------
    // AREA ADMIN
    // ------------------------------------------
    
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/kelola-menu-makanan', [AdminMenuController::class, 'index'])->name('admin.menu');
    Route::get('/admin/kelola-diet-plan', [AdminDietPlanController::class, 'index'])->name('admin.diet-plan');
    Route::get('/admin/kelola-olahraga', [AdminWorkoutController::class, 'index'])->name('admin.exercise');
    Route::get('/admin/kelola-akun-user', [AdminUserController::class, 'index'])->name('admin.users.account');
    Route::get('/admin/kelola-profile-user', [AdminUserController::class, 'profile'])->name('admin.users.profile');

});