<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
