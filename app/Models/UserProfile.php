<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = [
        'id',
        'user_id',
        'age',
        'gender',
        'height_cm',
        'weight_kg',
        'activity_level',
        'bmi',
        'daily_calorie_target',
        'diet_goal',
        'has_food_preferences'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodPreferences()
    {
        return $this->hasMany(FoodPreference::class, 'user_profile_id');
    }
}