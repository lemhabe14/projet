<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Utilisateur;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function redirectToKeycloak()
    {
    return Socialite::driver('openidconnect')->redirect();
    }
    public function handleKeycloakCallback(Request $request)
{
    $keycloakUser = Socialite::driver('openidconnect')->user();

    $user = Utilisateur::updateOrCreate(
        ['email' => $keycloakUser->getEmail()],
        [
            'nom' => $keycloakUser->getName() ?? 'Utilisateur',
            'prenom' => '',
            'telephone' => '',
            'adresse' => '',
            'password' => bcrypt(str()->random(32)),
        ]
    );

    Auth::login($user);

    $request->session()->regenerate();

    return redirect('/dashboard');
}

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mote de passe incorect',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}