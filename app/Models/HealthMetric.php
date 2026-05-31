<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight_kg',
        'bmi',
        'calories_burned',
        'steps_count',
        'water_intake',
        'recorded_date'
    ];

    protected $casts = [
        'recorded_date' => 'date',
    ];

    // Relasi balik ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}