<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.kelola-akun-user', compact('users'));
    }

    public function profile()
    {
        return view('admin.kelola-profile-user');
    }
}