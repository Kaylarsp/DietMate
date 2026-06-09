<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Dapatkan data user yang sedang login
            $user = Auth::user();

            // Cek role user dan arahkan ke dashboard yang sesuai
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika user biasa, arahkan ke dashboard user
            return redirect()->intended('/dashboard'); 
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}