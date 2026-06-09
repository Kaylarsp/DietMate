<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;
use App\Models\HealthMetric;
use App\Models\UserProfile;
use App\Models\UserDietPlan;

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
        $dietGoal = null;
        $activityLevel = null;
        
        // Jika user login, ambil data dari database
        if ($isLoggedIn) {
            $user = Auth::user();
            $profile = UserProfile::where('user_id', $user->id)->first();
            
            if ($profile) {
                // Gunakan BMI dari database
                $bmi = $profile->bmi;
                $dietGoal = $profile->diet_goal;
                $activityLevel = $profile->activity_level;
                
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
        
        // Klasifikasi BMI (menggunakan Bahasa Indonesia)
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
        
        // Rekomendasi olahraga berdasarkan BMI, Diet Goal, dan Activity Level
        $workouts = $this->getWorkoutRecommendations($bmiCategory, $dietGoal, $activityLevel);
        
        // Target langkah berdasarkan BMI dan Diet Goal
        $stepTarget = $this->getStepTarget($bmiCategory, $dietGoal);
        
        // Saran istirahat berdasarkan BMI dan Diet Goal
        $sleepAdvice = $this->getSleepAdvice($bmiCategory, $dietGoal);
        
        // Header rekomendasi
        $personalizedHeader = $this->getPersonalizedHeader($bmiCategory, $dietGoal, $isLoggedIn);
        
        // Workout descriptions
        $workoutDescriptions = [
            'Jalan Santai' => 'Berjalan kaki dengan kecepatan normal, cocok untuk pemula dan semua usia.',
            'Yoga Pagi' => 'Gerakan yoga untuk fleksibilitas, mengurangi stres, dan meningkatkan keseimbangan.',
            'Peregangan (Stretching)' => 'Gerakan peregangan seluruh tubuh untuk kelenturan otot dan mencegah cedera.',
            'Senam Lansia' => 'Senam ringan yang aman untuk semua usia, meningkatkan mobilitas sendi.',
            'Jogging Ringan' => 'Lari santai untuk meningkatkan detak jantung dan membakar lemak secara konsisten.',
            'Bersepeda Santai' => 'Bersepeda untuk kesehatan jantung dan pembakaran lemak yang efektif.',
            'Renang Gaya Bebas' => 'Olahraga low-impact yang bagus untuk persendian dan membakar kalori.',
            'Senam Aerobik' => 'Senam aerobik berirama untuk meningkatkan detak jantung dan kebugaran kardio.',
            'Lompat Tali' => 'Latihan kardio intensitas sedang, efektif membakar kalori dalam waktu singkat.',
            'HIIT 20 Menit' => 'Latihan interval intensitas tinggi untuk pembakaran kalori maksimal.',
            'Push-Up & Sit-Up' => 'Latihan kalistenik dasar untuk kekuatan otot inti dan upper body.',
            'Plank Challenge' => 'Latihan plank untuk kekuatan core dan stabilitas tubuh.',
            'Zumba' => 'Aerobik dance bergaya Latin yang menyenangkan untuk membakar kalori.',
            'Weight Training Pemula' => 'Latihan beban untuk membentuk otot dan meningkatkan metabolisme basal.',
            'CrossFit' => 'Latihan fungsional intensitas tinggi kombinasi cardio dan beban.',
            'Sprint Interval' => 'Latihan sprint interval untuk pembakaran lemak maksimal.',
            'Boxing / Muay Thai' => 'Latihan tinju untuk kekuatan, cardio, dan koordinasi.',
            'Deadlift & Squat Heavy' => 'Latihan compound berat untuk kekuatan otot seluruh tubuh.',
            'Rock Climbing Indoor' => 'Panjat tebing untuk kekuatan, ketangkasan, dan mental.',
            'Triathlon Training' => 'Kombinasi renang, bersepeda, dan lari untuk endurance maksimal.'
        ];

        return view('user.olahraga', compact(
            'user',
            'profile',
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
            'workoutDescriptions'
        ));    
    }
    
    /**
     * Rekomendasi olahraga berdasarkan BMI, Diet Goal, dan Activity Level
     */
    private function getWorkoutRecommendations($bmiCategory, $dietGoal = null, $activityLevel = null)
    {
        // Ambil semua workout dari database
        $allWorkouts = Workout::all();
        
        if ($allWorkouts->isEmpty()) {
            return collect();
        }
        
        // Mapping intensitas ke Bahasa Indonesia yang benar
        // Database menggunakan: santai, ringan, sedang, berat
        
        // Kasus: User TIDAK LOGIN atau TIDAK PUNYA DATA PROFILE
        if (is_null($dietGoal) || is_null($activityLevel)) {
            return $this->getRecommendationForGuest($allWorkouts, $bmiCategory);
        }
        
        // Kasus: User LOGIN dan PUNYA DATA PROFILE LENGKAP
        return $this->getRecommendationForLoggedInUser($allWorkouts, $bmiCategory, $dietGoal, $activityLevel);
    }
    
    /**
     * Rekomendasi untuk user yang belum login/tidak punya profile
     */
    private function getRecommendationForGuest($allWorkouts, $bmiCategory)
    {
        switch ($bmiCategory) {
            case 'Obesitas':
                // Olahraga intensitas santai/ringan, durasi pendek
                return $allWorkouts->filter(function($workout) {
                    $intensity = strtolower($workout->intensity);
                    return in_array($intensity, ['santai', 'ringan']) 
                        && $workout->duration_minutes <= 30;
                })->take(4);
                
            case 'Kelebihan Berat Badan':
                // Olahraga intensitas ringan-sedang, fokus pembakaran kalori
                return $allWorkouts->filter(function($workout) {
                    $intensity = strtolower($workout->intensity);
                    return in_array($intensity, ['ringan', 'sedang']);
                })->sortByDesc('cals_burned_per_min')->take(4);
                
            case 'Normal':
                // Mix semua intensitas
                return $allWorkouts->filter(function($workout) {
                    $intensity = strtolower($workout->intensity);
                    return true;
                })->take(4);
                
            case 'Kurus':
                // Fokus strength training dan intensitas sedang
                $strengthWorkouts = ['Weight Training Pemula', 'Push-Up & Sit-Up', 'Plank Challenge', 'Yoga Pagi'];
                return $allWorkouts->filter(function($workout) use ($strengthWorkouts) {
                    return in_array($workout->name, $strengthWorkouts) 
                        || in_array(strtolower($workout->intensity), ['sedang', 'ringan']);
                })->take(4);
                
            default:
                return $allWorkouts->take(4);
        }
    }
    
    /**
     * Rekomendasi untuk user yang sudah login dan memiliki profile lengkap
     */
    private function getRecommendationForLoggedInUser($allWorkouts, $bmiCategory, $dietGoal, $activityLevel)
    {
        // Mapping activity_level ke level intensitas yang direkomendasikan
        $activityMapping = [
            'sedentary' => ['santai', 'ringan'],      // Jarang gerak -> mulai dari yang ringan
            'lightly_active' => ['ringan', 'sedang'],  // Cukup aktif -> tingkatkan ke sedang
            'moderately_active' => ['sedang'],         // Aktif -> fokus intensitas sedang
            'very_active' => ['sedang', 'berat'],      // Sangat aktif -> bisa intensitas berat
            'extra_active' => ['berat']                // Extra aktif -> fokus intensitas berat
        ];
        
        $recommendedIntensities = $activityMapping[$activityLevel] ?? ['ringan', 'sedang'];
        
        // Filter berdasarkan diet_goal dan intensitas yang sesuai dengan activity level
        $filteredWorkouts = $allWorkouts->filter(function($workout) use ($dietGoal, $recommendedIntensities, $bmiCategory) {
            $intensity = strtolower($workout->intensity);
            
            // Filter intensitas berdasarkan activity level
            if (!in_array($intensity, $recommendedIntensities)) {
                return false;
            }
            
            // Filter tambahan berdasarkan diet_goal
            if ($dietGoal === 'weight_loss') {
                // Untuk weight loss: fokus kardio dan pembakaran kalori tinggi
                $cardioWorkouts = ['Jogging Ringan', 'Bersepeda Santai', 'Renang Gaya Bebas', 'Senam Aerobik', 
                                   'Lompat Tali', 'HIIT 20 Menit', 'Zumba', 'Sprint Interval'];
                return in_array($workout->name, $cardioWorkouts) || $workout->cals_burned_per_min >= 6;
                
            } elseif ($dietGoal === 'weight_gain') {
                // Untuk weight gain: fokus strength training
                $strengthWorkouts = ['Weight Training Pemula', 'Push-Up & Sit-Up', 'Plank Challenge', 
                                     'Deadlift & Squat Heavy', 'CrossFit', 'Rock Climbing Indoor'];
                return in_array($workout->name, $strengthWorkouts);
                
            } else { // maintain
                // Untuk maintain: mix cardio dan strength
                return true;
            }
        });
        
        // Jika hasil filter terlalu sedikit, ambil dari rekomendasi guest sebagai fallback
        if ($filteredWorkouts->count() < 3) {
            $fallbackWorkouts = $this->getRecommendationForGuest($allWorkouts, $bmiCategory);
            return $fallbackWorkouts;
        }
        
        // Sort berdasarkan efektivitas (kalori per menit untuk weight loss, atau durasi untuk strength)
        if ($dietGoal === 'weight_loss') {
            $filteredWorkouts = $filteredWorkouts->sortByDesc('cals_burned_per_min');
        } elseif ($dietGoal === 'weight_gain') {
            // Untuk weight gain, prioritaskan durasi lebih panjang
            $filteredWorkouts = $filteredWorkouts->sortByDesc('duration_minutes');
        }
        
        return $filteredWorkouts->take(4);
    }
    
    /**
     * Target langkah berdasarkan BMI dan Diet Goal
     */
    private function getStepTarget($bmiCategory, $dietGoal = null)
    {
        // Default berdasarkan BMI
        $baseTarget = 8000;
        
        switch ($bmiCategory) {
            case 'Obesitas':
                $baseTarget = 6000;
                break;
            case 'Kelebihan Berat Badan':
                $baseTarget = 8000;
                break;
            case 'Normal':
                $baseTarget = 10000;
                break;
            case 'Kurus':
                $baseTarget = 7000;
                break;
        }
        
        // Adjust berdasarkan diet goal
        if ($dietGoal === 'weight_loss') {
            $baseTarget = min(12000, $baseTarget + 2000);
        } elseif ($dietGoal === 'weight_gain') {
            $baseTarget = max(5000, $baseTarget - 2000);
        }
        
        return $baseTarget;
    }
    
    /**
     * Saran istirahat berdasarkan BMI dan Diet Goal
     */
    private function getSleepAdvice($bmiCategory, $dietGoal = null)
    {
        if ($dietGoal === 'weight_gain') {
            return 'Istirahat 8-9 Jam + tidur siang 20-30 menit (penting untuk pemulihan otot)';
        }
        
        switch ($bmiCategory) {
            case 'Obesitas':
                return 'Istirahat 8-9 Jam (kualitas tidur penting untuk metabolisme dan penurunan berat badan)';
            case 'Kelebihan Berat Badan':
                return 'Istirahat 7-8 Jam (tidur cukup membantu mengatur hormon lapar)';
            case 'Normal':
                return 'Istirahat 7-8 Jam (jaga konsistensi waktu tidur)';
            case 'Kurus':
                return 'Istirahat 8 Jam + tidur siang 20 menit (bantu pemulihan dan pembentukan otot)';
            default:
                return 'Istirahat 7-8 Jam setiap malam';
        }
    }
    
    /**
     * Header personalisasi berdasarkan data user
     */
    private function getPersonalizedHeader($bmiCategory, $dietGoal, $isLoggedIn)
    {
        if (!$isLoggedIn) {
            return "Temukan rekomendasi olahraga terbaik untuk kesehatan Anda. Login untuk mendapatkan rekomendasi yang lebih personal!";
        }
        
        if ($dietGoal === 'weight_loss') {
            $baseText = "Berdasarkan target penurunan berat badan Anda, kami merekomendasikan olahraga berikut untuk memaksimalkan pembakaran kalori";
        } elseif ($dietGoal === 'weight_gain') {
            $baseText = "Berdasarkan target kenaikan berat badan Anda, kami merekomendasikan olahraga berikut untuk membentuk massa otot";
        } else {
            $baseText = "Berdasarkan target mempertahankan berat badan Anda, kami merekomendasikan olahraga berikut untuk menjaga kebugaran";
        }
        
        switch ($bmiCategory) {
            case 'Obesitas':
                return $baseText . " dan kesehatan kardiovaskular secara bertahap.";
            case 'Kelebihan Berat Badan':
                return $baseText . " dan meningkatkan metabolisme tubuh.";
            case 'Normal':
                return $baseText . " dan kesehatan jantung Anda.";
            case 'Kurus':
                return $baseText . " dan meningkatkan kekuatan tubuh secara menyeluruh.";
            default:
                return "Rekomendasi olahraga personal untuk mencapai target kebugaran Anda.";
        }
    }
}
