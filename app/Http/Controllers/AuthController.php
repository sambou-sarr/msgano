<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegister()
    {
        return view('auth.register');
    }
 


    // Traiter l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
           'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Afficher le formulaire de connexion
    public function showLogin()
    {
        return view('auth.login');
    }

    // Traiter la connexion
    public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Vérifie d'abord si un utilisateur avec ce username existe
    $user = \App\Models\User::where('username', $credentials['username'])->first();

    if (!$user) {
        return back()->withErrors([
            'username' => 'Aucun compte trouvé avec ce nom d’utilisateur. Veuillez vous inscrire.',
        ]);
    }

    // Tente la connexion
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'));
    }

    return back()->withErrors([
        'username' => 'Mot de passe incorrect.',
    ]);
}


    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
