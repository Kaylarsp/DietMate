<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        // Provide initial paginated data for server-side render
        $menus = FoodMenu::latest()->paginate(10);

        return view('admin.kelola-menu-makanan', compact('menus'));
    }
}