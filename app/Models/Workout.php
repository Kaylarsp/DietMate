<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration_minutes',
        'intensity',
        'description',
        'cals_burned_per_min'
    ];

    // Relasi ke tabel workout_recommendations (1 to Many)
    public function recommendations()
    {
        return $this->hasMany(WorkoutRecommendation::class);
    }
}