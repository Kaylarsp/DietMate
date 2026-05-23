<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class AdminWorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::latest()->paginate(10);

        return view('admin.kelola-olahraga', compact('workouts'));
    }
}