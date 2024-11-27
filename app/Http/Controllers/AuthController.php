<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur; // Importe le modèle Utilisateur

class AuthController extends Controller
{
    // Afficher la page de connexion
    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

    // // Gérer la connexion de l'utilisateur
    // public function login(Request $request)
    // {
    //     // Valider les informations de connexion
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     // Tentative de connexion
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         // Redirection si connexion réussie
    //         return redirect()->route('dashboard')->with('success', 'Connexion réussie');
    //     }

    //     // Retourner une erreur si échec de la connexion
    //     return back()->withErrors([
    //         'email' => 'Les informations de connexion ne sont pas correctes.',
    //     ]);
    // }

    // // Déconnexion
    // public function logout(Request $request)
    // {
    //     Auth::logout(); // Déconnexion de l'utilisateur
    //     $request->session()->invalidate(); // Invalidation de la session actuelle
    //     $request->session()->regenerateToken(); // Régénération du token CSRF

    //     // Redirection vers le formulaire de connexion avec un message de succès
    //     return redirect()->route('login')->with('success', 'Déconnexion réussie');
    // }


}
