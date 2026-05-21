<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController; 
Route::get('/', function () {
    return view('welcome');

    
});

Route::get('/', function () {
    return view('landingpage');
});





/*
|--------------------------------------------------------------------------
| Web Routes - Auth Login
|--------------------------------------------------------------------------
| Tambahkan route-route berikut ke dalam file web.php Anda.
| Sesuaikan nama Controller jika berbeda.
*/

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
    // Ganti dengan controller register Anda
    return view('auth.register');
})->middleware('guest')->name('register');

// Lupa password (agar link "Lupa Password" tidak error)
Route::get('/forgot-password', function () {
    // Ganti dengan controller forgot password Anda
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Social login — sesuaikan dengan package yang Anda pakai (misal: Laravel Socialite)
Route::get('/login/google', function () {
    // Contoh: return Socialite::driver('google')->redirect();
    abort(501, 'Google login belum dikonfigurasi.');
})->middleware('guest')->name('login.google');

Route::get('/login/apple', function () {
    // Contoh: return Socialite::driver('apple')->redirect();
    abort(501, 'Apple login belum dikonfigurasi.');
})->middleware('guest')->name('login.apple');