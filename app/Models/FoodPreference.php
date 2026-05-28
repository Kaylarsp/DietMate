<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPreference extends Model
{
    use HasFactory;

    // Sesuaikan dengan nama tabel di database
    protected $table = 'food_preferences';

    protected $fillable = [
        'user_profile_id',
        'preference_name',
        'type' // enum yang ada di tabel Anda (misal: 'diet', 'allergy')
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}