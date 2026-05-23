<?php

namespace App\Http\Controllers;

use App\Models\DietPlan;
use Illuminate\Http\Request;

class AdminDietPlanController extends Controller
{
    public function index()
    {
        $plans = DietPlan::latest()->paginate(10);

        return view('admin.kelola-diet-plan', compact('plans'));
    }
}