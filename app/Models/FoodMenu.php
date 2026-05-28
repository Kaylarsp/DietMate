<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table = 'food_menus';

    protected $fillable = [
        'name', 'category', 'calories', 'protein_g', 
        'carbs_g', 'fat_g', 'description', 'image_url', 'is_active'
    ];
}