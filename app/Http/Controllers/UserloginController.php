<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserloginController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=> ['required','email'],
            'password'=> ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Sécurise la session

            // Teste le rôle ici :
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');  // Vers dashboard admin
            } else {
                return redirect()->route('profile');          // Vers dashboard user classique
            }
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion ne correspondent pas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
