<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;
use App\Models\HealthMetric;

class WorkoutRecommendationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile; // Asumsi ada relasi hasOne di model User

        // 1. Ambil rekomendasi olahraga (bisa di-limit atau disesuaikan dengan activity_level)
        // Di sini kita ambil semua data dari tabel 'workouts'
        $workouts = Workout::all();

        // 2. Kalkulasi Insight Kesehatan dari tabel 'health_metrics'
        // Menghitung total kalori terbakar 7 hari terakhir
        $weeklyCaloriesBurned = HealthMetric::query()->where('user_id', $user->id)
            ->where('recorded_date', '>=', now()->subDays(7))
            ->sum('calories_burned');

        $todayMetric = HealthMetric::query()->where('user_id', $user->id)
            ->whereDate('recorded_date', today())
            ->first();

        $todaySteps = $todayMetric ? $todayMetric->steps_count : 0;

        return view('user.olahraga', compact(
            'user',
            'profile',
            'workouts',
            'weeklyCaloriesBurned',
            'todaySteps'
        ));
    }
}
