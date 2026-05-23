<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DietPlan;
use App\Models\FoodMenu;
use App\Models\Workout;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Summary card data
        $totalUsers      = User::count();
        $totalDietPlans  = DietPlan::count();
        $totalFoodMenus  = FoodMenu::count();
        $totalWorkouts   = Workout::count();

        // Percentage changes (placeholder logic - compare with last month/week)
        $usersGrowth   = $this->getGrowthPercentage(User::class);
        $dietPlanGrowth = $this->getGrowthPercentage(DietPlan::class);

        // Recent users with profiles for the table
        $recentUsers = User::with('profile')
            ->where('role', 'user')
            ->latest()
            ->take(3)
            ->get();

        // Activity data
        $latestUser = User::where('role', 'user')->latest()->first();

        // Most recommended diet plan
        $mostRecommendedDiet = DietPlan::where('is_active', true)
            ->inRandomOrder()
            ->first();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDietPlans',
            'totalFoodMenus',
            'totalWorkouts',
            'usersGrowth',
            'dietPlanGrowth',
            'recentUsers',
            'latestUser',
            'mostRecommendedDiet'
        ));
    }

    /**
     * Get a simplistic growth percentage based on records created this month vs last month.
     */
    private function getGrowthPercentage(string $modelClass): string
    {
        $now       = now();
        $thisMonth = $modelClass::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonth = $modelClass::whereMonth('created_at', $now->subMonth()->month)
            ->whereYear('created_at', $now->year)
            ->count();

        if ($lastMonth === 0) {
            return '+0%';
        }

        $growth = round((($thisMonth - $lastMonth) / $lastMonth) * 100);
        return ($growth >= 0 ? '+' : '') . $growth . '%';
    }
}