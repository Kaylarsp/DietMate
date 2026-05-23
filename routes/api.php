<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodMenuController as FoodMenuApiController;
use App\Http\Controllers\Api\DietPlanController as DietPlanApiController;
use App\Http\Controllers\Api\WorkoutController as WorkoutApiController;
use App\Http\Controllers\Api\UserController as UserApiController;
use App\Http\Controllers\Api\UserProfileController as UserProfileApiController;

Route::prefix('admin')->name('admin.api.')->group(function () {
    Route::get('/food-menus', [FoodMenuApiController::class, 'index'])->name('food-menus.index');
    Route::post('/food-menus', [FoodMenuApiController::class, 'store'])->name('food-menus.store');
    Route::get('/food-menus/{id}', [FoodMenuApiController::class, 'show'])->name('food-menus.show');
    Route::put('/food-menus/{id}', [FoodMenuApiController::class, 'update'])->name('food-menus.update');
    Route::delete('/food-menus/{id}', [FoodMenuApiController::class, 'destroy'])->name('food-menus.destroy');

    Route::get('/diet-plans', [DietPlanApiController::class, 'index'])->name('diet-plans.index');
    Route::post('/diet-plans', [DietPlanApiController::class, 'store'])->name('diet-plans.store');
    Route::get('/diet-plans/{id}', [DietPlanApiController::class, 'show'])->name('diet-plans.show');
    Route::put('/diet-plans/{id}', [DietPlanApiController::class, 'update'])->name('diet-plans.update');
    Route::delete('/diet-plans/{id}', [DietPlanApiController::class, 'destroy'])->name('diet-plans.destroy');

    Route::get('/workouts', [WorkoutApiController::class, 'index'])->name('workouts.index');
    Route::post('/workouts', [WorkoutApiController::class, 'store'])->name('workouts.store');
    Route::get('/workouts/{id}', [WorkoutApiController::class, 'show'])->name('workouts.show');
    Route::put('/workouts/{id}', [WorkoutApiController::class, 'update'])->name('workouts.update');
    Route::delete('/workouts/{id}', [WorkoutApiController::class, 'destroy'])->name('workouts.destroy');

    Route::get('/users', [UserApiController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserApiController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserApiController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserApiController::class, 'destroy'])->name('users.destroy');

    Route::get('/user-profiles', [UserProfileApiController::class, 'index'])->name('user-profiles.index');
    Route::get('/user-profiles/{id}', [UserProfileApiController::class, 'show'])->name('user-profiles.show');
    Route::put('/user-profiles/{id}', [UserProfileApiController::class, 'update'])->name('user-profiles.update');
    Route::delete('/user-profiles/{id}', [UserProfileApiController::class, 'destroy'])->name('user-profiles.destroy');
});
