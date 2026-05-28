<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\FoodPreference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $profile = UserProfile::with('foodPreferences')->firstWhere('user_id', Auth::id());
            
            $defaultPreferences = [
                'Vegetarian', 'Vegan', 'Alergi Seafood', 'Gluten Free', 'Tidak Suka Pedas', 'Keto'
            ];
            
            $userPrefs = $profile ? $profile->foodPreferences->pluck('preference_name')->toArray() : [];

            return view('user.profile-dashboard', compact('profile', 'defaultPreferences', 'userPrefs'));
        }

        return view('user.profile-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'age' => 'required',
            'gender' => 'required',
            'height_cm' => 'required',
            'weight_kg' => 'required',
            'activity_level' => 'required',
            'diet_goal' => 'required'
        ]);

        $heightMeter = $request->height_cm / 100;
        $bmi = $request->weight_kg / ($heightMeter * $heightMeter);

        if ($request->gender == 'male') {
            $bmr = 88.36 + (13.4 * $request->weight_kg) + (4.8 * $request->height_cm) - (5.7 * $request->age);
        } else {
            $bmr = 447.6 + (9.2 * $request->weight_kg) + (3.1 * $request->height_cm) - (4.3 * $request->age);
        }

        $activityMultiplier = match ($request->activity_level) {
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            default => 1.2
        };

        $dailyCalories = $bmr * $activityMultiplier;

        if ($request->diet_goal == 'loss') {
            $dailyCalories -= 300;
        } elseif ($request->diet_goal == 'gain') {
            $dailyCalories += 300;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'age' => $request->age,
            'gender' => $request->gender,
            'height_cm' => $request->height_cm,
            'weight_kg' => $request->weight_kg,
            'activity_level' => $request->activity_level,
            'bmi' => round($bmi, 1),
            'daily_calorie_target' => round($dailyCalories),
            'diet_goal' => $request->diet_goal
        ]);

        Auth::login($user);

        return redirect('/profile-dashboard');
    }

    public function update(Request $request)
    {
        $request->validate([
            'age' => 'required|numeric',
            'gender' => 'required',
            'height_cm' => 'required|numeric',
            'weight_kg' => 'required|numeric',
            'activity_level' => 'required',
            'diet_goal' => 'required'
        ]);

        $profile = UserProfile::firstWhere('user_id', Auth::id());

        $heightMeter = $request->height_cm / 100;
        $bmi = $request->weight_kg / ($heightMeter * $heightMeter);

        $bmr = ($request->gender == 'male') 
            ? 88.36 + (13.4 * $request->weight_kg) + (4.8 * $request->height_cm) - (5.7 * $request->age)
            : 447.6 + (9.2 * $request->weight_kg) + (3.1 * $request->height_cm) - (4.3 * $request->age);

        $activityMultiplier = match ($request->activity_level) {
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            default => 1.2
        };

        $dailyCalories = $bmr * $activityMultiplier;
        if ($request->diet_goal == 'loss') $dailyCalories -= 300;
        elseif ($request->diet_goal == 'gain') $dailyCalories += 300;

        $profile->foodPreferences()->delete();
        $hasPreferences = false;

        if ($request->has('preferences')) {
            $hasPreferences = true;
            foreach ($request->preferences as $pref) {
                $profile->foodPreferences()->create([
                    'preference_name' => $pref,
                    'type' => 'preference' 
                ]);
            }
        }

        if ($request->filled('new_allergy')) {
            $hasPreferences = true;
            $allergies = explode(',', $request->new_allergy);
            foreach ($allergies as $allergy) {
                if(trim($allergy) !== '') {
                    $profile->foodPreferences()->create([
                        'preference_name' => trim($allergy),
                        'type' => 'allergy'
                    ]);
                }
            }
        }

        $profile->update([
            'age' => $request->age,
            'gender' => $request->gender,
            'height_cm' => $request->height_cm,
            'weight_kg' => $request->weight_kg,
            'activity_level' => $request->activity_level,
            'bmi' => round($bmi, 1),
            'daily_calorie_target' => round($dailyCalories),
            'diet_goal' => $request->diet_goal,
            'has_food_preferences' => $hasPreferences 
        ]);

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    }
}