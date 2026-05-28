<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class FoodRecommendationController extends Controller
{
    public function index()
    {
        // 1. Ambil data profil user untuk mendapatkan target kalori
        $profile = UserProfile::firstWhere('user_id', Auth::id());

        // 2. Ambil 1 menu aktif secara acak untuk masing-masing kategori
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

        // 3. Hitung total kalori dari menu hari ini
        $totalKaloriMenu = ($sarapan->calories ?? 0) + ($makanSiang->calories ?? 0) + ($makanMalam->calories ?? 0);
        $targetKalori = $profile ? $profile->daily_calorie_target : 2000; // Default 2000 jika belum ada profil

        // Hitung persentase pemenuhan kalori
        $persentaseKalori = $targetKalori > 0 ? round(($totalKaloriMenu / $targetKalori) * 100) : 0;

        return view('user.menu', compact(
            'profile',
            'sarapan',
            'makanSiang',
            'makanMalam',
            'totalKaloriMenu',
            'targetKalori',
            'persentaseKalori'
        ));
    }
}
