<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workout_id',
        'recorded_date',
        'is_completed'
    ];

    protected $casts = [
        'recorded_date' => 'date',
        'is_completed' => 'boolean',
    ];

    // Relasi balik ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi balik ke tabel workouts
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}