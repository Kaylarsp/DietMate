<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        // kalau sudah login
        if (Auth::check()) {

            $profile = UserProfile::firstWhere('user_id', Auth::id());
            return view('user.profile-dashboard', compact('profile'));
        }

        // kalau belum login
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

        // BMI
        $heightMeter = $request->height_cm / 100;

        $bmi = $request->weight_kg / ($heightMeter * $heightMeter);

        // BMR
        if ($request->gender == 'male') {

            $bmr = 88.36
                + (13.4 * $request->weight_kg)
                + (4.8 * $request->height_cm)
                - (5.7 * $request->age);
        } else {

            $bmr = 447.6
                + (9.2 * $request->weight_kg)
                + (3.1 * $request->height_cm)
                - (4.3 * $request->age);
        }

        // activity multiplier
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

        // create user
        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        // create profile
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

        // auto login
        Auth::login($user);

        return redirect('/profile-dashboard');
    }
}
