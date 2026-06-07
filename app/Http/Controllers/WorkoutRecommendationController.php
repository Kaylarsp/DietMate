<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;
use App\Models\HealthMetric;
use App\Models\UserProfile;

class WorkoutRecommendationController extends Controller
{
    public function index()
    {
        // Cek apakah user login atau tidak
        $isLoggedIn = Auth::check();
        
        $bmi = null;
        $bmiCategory = null;
        $bmiAdvice = null;
        $profile = null;
        $weeklyCaloriesBurned = 0;
        $todaySteps = 0;
        $activityIncrease = 0;
        
        // Jika user login, ambil data dari database
        if ($isLoggedIn) {
            $user = Auth::user();
            $profile = UserProfile::where('user_id', $user->id)->first();
            
            if ($profile) {
                // Gunakan BMI dari database
                $bmi = $profile->bmi;
                
                // Kalkulasi Insight Kesehatan
                $weeklyCaloriesBurned = HealthMetric::where('user_id', $user->id)
                    ->where('recorded_date', '>=', now()->subDays(7))
                    ->sum('calories_burned');
                
                $lastWeekCalories = HealthMetric::where('user_id', $user->id)
                    ->whereBetween('recorded_date', [now()->subDays(14), now()->subDays(7)])
                    ->sum('calories_burned');
                
                if ($lastWeekCalories > 0) {
                    $activityIncrease = round((($weeklyCaloriesBurned - $lastWeekCalories) / $lastWeekCalories) * 100);
                } elseif ($weeklyCaloriesBurned > 0) {
                    $activityIncrease = 100;
                }
                
                $todayMetric = HealthMetric::where('user_id', $user->id)
                    ->whereDate('recorded_date', today())
                    ->first();
                
                $todaySteps = $todayMetric ? $todayMetric->steps_count : 0;
            }
        }
        
        // Jika tidak login atau tidak punya profile, gunakan nilai default
        if (!$bmi) {
            // Default nilai untuk user yang belum login
            $bmi = 22; // Nilai normal
        }
        
        // Klasifikasi BMI
        if ($bmi < 18.5) {
            $bmiCategory = 'Kurus';
            $bmiAdvice = 'Anda memiliki berat badan kurang. Fokus pada olahraga pembentukan massa otot dan peningkatan nafsu makan.';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            $bmiCategory = 'Normal';
            $bmiAdvice = 'Berat badan Anda ideal. Pertahankan dengan olahraga rutin untuk kesehatan jantung dan kebugaran.';
        } elseif ($bmi >= 25 && $bmi < 30) {
            $bmiCategory = 'Kelebihan Berat Badan';
            $bmiAdvice = 'Anda mengalami kelebihan berat badan. Fokus pada olahraga kardio untuk membakar lemak.';
        } elseif ($bmi >= 30) {
            $bmiCategory = 'Obesitas';
            $bmiAdvice = 'Anda berada dalam kategori obesitas. Mulai dengan olahraga intensitas ringan-sedang secara konsisten.';
        }
        
        // Rekomendasi olahraga berdasarkan BMI
        $workouts = $this->getWorkoutRecommendationsByBMI($bmiCategory);
        
        // Target langkah berdasarkan BMI
        $stepTarget = $this->getStepTargetByBMI($bmiCategory);
        
        // Saran istirahat berdasarkan BMI
        $sleepAdvice = $this->getSleepAdviceByBMI($bmiCategory);
        
        // Header rekomendasi
        $personalizedHeader = $this->getPersonalizedHeader($bmiCategory, $isLoggedIn);
        
        // Di dalam public function index(), sebelum return view
        $workoutDescriptions = [
            'Jogging' => 'Lari santai untuk meningkatkan detak jantung dan membakar lemak secara konsisten.',
            'Strength Training' => 'Latihan beban untuk membentuk otot dan meningkatkan metabolisme basal.',
            'Yoga' => 'Gerakan lembut untuk meningkatkan fleksibilitas dan mengurangi stres.',
            'Swimming' => 'Olahraga low-impact yang bagus untuk persendian dan membakar kalori.',
            'Cycling' => 'Bersepeda untuk kesehatan jantung dan pembakaran lemak yang efektif.',
            'HIIT' => 'Latihan interval intensitas tinggi untuk pembakaran kalori maksimal.',
            'Pilates' => 'Fokus pada kekuatan inti tubuh dan postur yang baik.',
            'Bodyweight' => 'Latihan menggunakan berat badan sendiri, efektif untuk kebugaran umum.'
        ];

        return view('user.olahraga', compact(
            'workouts',
            'weeklyCaloriesBurned',
            'todaySteps',
            'bmi',
            'bmiCategory',
            'bmiAdvice',
            'activityIncrease',
            'stepTarget',
            'sleepAdvice',
            'personalizedHeader',
            'isLoggedIn',
            'profile',
            'workoutDescriptions' // ← Tambahkan ini
        ));    
}
    
    private function getWorkoutRecommendationsByBMI($bmiCategory)
    {
        // Ambil semua workout dari database
        $allWorkouts = Workout::all();
        
        if ($allWorkouts->isEmpty()) {
            return collect();
        }
        
        switch ($bmiCategory) {
            case 'Obesitas':
                return $allWorkouts->filter(function($workout) {
                    return in_array(strtolower($workout->intensity), ['ringan', 'sedang']) 
                        && $workout->duration_minutes <= 30;
                })->take(4);
                
            case 'Kelebihan Berat Badan':
                return $allWorkouts->filter(function($workout) {
                    return in_array(strtolower($workout->intensity), ['sedang', 'tinggi']);
                })->sortByDesc('cals_burned_per_min')->take(4);
                
            case 'Normal':
                return $allWorkouts->take(4);
                
            case 'Kurus':
                $strengthWorkouts = ['Strength Training', 'Bodyweight', 'Pilates', 'Yoga'];
                return $allWorkouts->filter(function($workout) use ($strengthWorkouts) {
                    return in_array($workout->name, $strengthWorkouts) 
                        || strtolower($workout->intensity) == 'sedang';
                })->take(4);
                
            default:
                return $allWorkouts->take(4);
        }
    }
    
    private function getStepTargetByBMI($bmiCategory)
    {
        switch ($bmiCategory) {
            case 'Obesitas':
                return 6000;
            case 'Kelebihan Berat Badan':
                return 8000;
            case 'Normal':
                return 10000;
            case 'Kurus':
                return 7000;
            default:
                return 8000;
        }
    }
    
    private function getSleepAdviceByBMI($bmiCategory)
    {
        switch ($bmiCategory) {
            case 'Obesitas':
                return 'Istirahat 8-9 Jam (kualitas tidur penting untuk metabolisme)';
            case 'Kelebihan Berat Badan':
                return 'Istirahat 7-8 Jam';
            case 'Normal':
                return 'Istirahat 7-8 Jam';
            case 'Kurus':
                return 'Istirahat 8 Jam + tidur siang 20 menit';
            default:
                return 'Istirahat 7 Jam';
        }
    }
    
    private function getPersonalizedHeader($bmiCategory, $isLoggedIn)
    {
        if (!$isLoggedIn) {
            return "Temukan rekomendasi olahraga terbaik untuk kesehatan Anda. Login untuk mendapatkan rekomendasi yang lebih personal!";
        }
        
        $baseText = "Berdasarkan profil kesehatan dan target diet Anda, kami menyarankan aktivitas berikut untuk mengoptimalkan ";
        
        switch ($bmiCategory) {
            case 'Obesitas':
                return $baseText . "penurunan berat badan dan kesehatan kardiovaskular secara bertahap.";
            case 'Kelebihan Berat Badan':
                return $baseText . "pembakaran lemak maksimal dan peningkatan metabolisme.";
            case 'Normal':
                return $baseText . "kebugaran tubuh dan menjaga berat badan ideal.";
            case 'Kurus':
                return $baseText . "pembentukan massa otot dan peningkatan kebugaran secara menyeluruh.";
            default:
                return "Rekomendasi olahraga personal untuk mencapai target kebugaran Anda.";
        }
    }
    private function getWorkoutDescription($workoutName, $bmiCategory)
    {
        $descriptions = [
            'Jogging' => 'Lari santai untuk meningkatkan detak jantung dan membakar lemak secara konsisten.',
            'Strength Training' => 'Latihan beban untuk membentuk otot dan meningkatkan metabolisme basal.',
            'Yoga' => 'Gerakan lembut untuk meningkatkan fleksibilitas dan mengurangi stres.',
            'Swimming' => 'Olahraga low-impact yang bagus untuk persendian dan membakar kalori.',
            'Cycling' => 'Bersepeda untuk kesehatan jantung dan pembakaran lemak yang efektif.',
            'HIIT' => 'Latihan interval intensitas tinggi untuk pembakaran kalori maksimal.',
            'Pilates' => 'Fokus pada kekuatan inti tubuh dan postur yang baik.',
            'Bodyweight' => 'Latihan menggunakan berat badan sendiri, efektif untuk kebugaran umum.'
        ];
        
        if ($bmiCategory == 'Obesitas') {
            return ($descriptions[$workoutName] ?? 'Latihan yang disesuaikan untuk memulai perjalanan kebugaran Anda dengan aman.') . ' Cocok untuk pemula.';
        } elseif ($bmiCategory == 'Kurus') {
            return ($descriptions[$workoutName] ?? 'Latihan pembentukan otot untuk mencapai berat badan ideal.') . ' Fokus pada pembentukan massa otot.';
        } elseif ($bmiCategory == 'Kelebihan Berat Badan') {
            return ($descriptions[$workoutName] ?? 'Latihan yang efektif untuk pembakaran lemak.') . ' Optimal untuk membakar kalori.';
        }
        
        return $descriptions[$workoutName] ?? 'Latihan yang bagus untuk menjaga kebugaran tubuh.';
    }
}