<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\FoodMenu;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data User yang sedang login & Profilenya
        $user = Auth::user();
        $profile = UserProfile::firstWhere('user_id', $user->id);

        // 2. Logika Penentuan Kategori BMI
        $bmi = $profile->bmi ?? 0;
        $bmiCategory = 'Belum Ada Data';
        $bmiBadge = 'bg-secondary-subtle text-secondary';

        if ($bmi > 0) {
            if ($bmi < 18.5) {
                $bmiCategory = 'Underweight';
                $bmiBadge = 'bg-warning-subtle text-warning';
            } elseif ($bmi < 25) {
                $bmiCategory = 'Sehat (Normal)';
                $bmiBadge = 'bg-success-subtle text-success';
            } elseif ($bmi < 30) {
                $bmiCategory = 'Overweight';
                $bmiBadge = 'bg-warning-subtle text-warning';
            } else {
                $bmiCategory = 'Obese';
                $bmiBadge = 'bg-danger-subtle text-danger';
            }
        }

        // 3. Mapping Text Target Diet
        $dietGoalLabel = match ($profile->diet_goal ?? '') {
            'loss' => "Turunkan<br>Berat Badan",
            'maintain' => "Jaga<br>Berat Badan",
            'gain' => "Naikkan<br>Berat Badan",
            default => "Belum<br>Diatur"
        };

        // 4. Ambil cuplikan menu untuk "Rencana Menu Harian" di Dashboard
        $sarapan = FoodMenu::query()
            ->where('category', 'sarapan')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->first();

        $makanSiang = FoodMenu::query()
            ->where('category', 'siang')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->first();

        $makanMalam = FoodMenu::query()
            ->where('category', 'malam')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->first();
            
        return view('user.dashboard', compact(
            'user',
            'profile',
            'bmiCategory',
            'bmiBadge',
            'dietGoalLabel',
            'sarapan',
            'makanSiang',
            'makanMalam'
        ));
    }
}
