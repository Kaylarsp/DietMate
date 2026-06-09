<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; // Tambahkan ini
use Carbon\Carbon; // Tambahkan ini

class FoodRecommendationController extends Controller
{
    public function index()
    {
        // 1. Ambil data profil user untuk mendapatkan target kalori
        $profile = UserProfile::firstWhere('user_id', Auth::id());

        $userId = Auth::id();
        $today = Carbon::today()->toDateString(); // Menghasilkan format YYYY-MM-DD
        
        // Buat nama key cache yang unik untuk tiap user dan tiap hari
        $cacheKey = "menu_harian_user_{$userId}_tanggal_{$today}";

        // 2. Gunakan Cache::remember
        // Jika cache masih ada, ambil dari cache. 
        // Jika tidak ada (baru pertama kali buka hari ini), query ke DB lalu simpan di cache sampai akhir hari ini (23:59:59)
        $menus = Cache::remember($cacheKey, Carbon::now()->endOfDay(), function () {
            return [
                'sarapan' => FoodMenu::query()
                    ->where('category', 'sarapan')
                    ->where('is_active', 1)
                    ->inRandomOrder()
                    ->first(),

                'makanSiang' => FoodMenu::query()
                    ->where('category', 'siang')
                    ->where('is_active', 1)
                    ->inRandomOrder()
                    ->first(),

                'makanMalam' => FoodMenu::query()
                    ->where('category', 'malam')
                    ->where('is_active', 1)
                    ->inRandomOrder()
                    ->first(),
            ];
        });

        // Ekstrak data dari array cache
        $sarapan = $menus['sarapan'];
        $makanSiang = $menus['makanSiang'];
        $makanMalam = $menus['makanMalam'];

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