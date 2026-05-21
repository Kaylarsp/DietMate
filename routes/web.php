<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController; 

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

Route::get('/profile', function () {
    return view('user.profile');
});

Route::get('/menu', function () {
    return view('user.menu');
});

Route::get('/olahraga', function () {
    return view('user.olahraga');
}); 
