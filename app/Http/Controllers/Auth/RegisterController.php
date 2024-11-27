<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Ecole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    // Afficher le formulaire d'enregistrement
    public function showRegistrationForm()
    {
        // Fetch all schools from the database
        $ecoles = Ecole::all();

        // Pass $ecoles to the view
        return view('auth.register', compact('ecoles'));
    }


    // Traiter l'enregistrement de l'utilisateur
    // public function register(Request $request)
    // {
    //     // Validation manuelle avec Validator
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:utilisateurs', // Vérifier l'unicité dans la table 'utilisateurs'
    //         'password' => 'required|string|min:8|confirmed',
    //         'droit' => 'required|string|in:valide,inscrire',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     // Création de l'utilisateur après validation
    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'droit' => $request->droit,
    //     ]);

    //     return redirect()->route('register')->with('success', 'Votre inscription a été soumise pour validation.');
    // }

    public function register(Request $request)
{
    // Validation manuelle avec Validator
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users', // Change 'utilisateurs' to 'users' if the table name is 'users'
        'password' => 'required|string|min:8|confirmed',
        'droit' => 'required|string|in:valide,inscrire',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Création de l'utilisateur après validation
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'droit' => $request->droit,
    ]);

    // Now we also need to save the relation to the ecole_user table
    $user = User::where('email', $request->email)->first();
    $user->ecoles()->attach($request->ecole); // Assuming you have set up the relationship

    return redirect()->route('register')->with('success', 'Votre inscription a été soumise pour validation.');
}





    public function updatePhoto(Request $request)
    {
        // Validation de l'input
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Taille maximale 2MB
        ]);

        $user = Auth::user(); // Récupère l'utilisateur connecté

        // Vérifie si l'utilisateur est authentifié
        if (!$user) {
            return redirect()->back()->withErrors(['auth' => 'Vous devez être connecté pour modifier votre photo de profil.']);
        }

        // Si un fichier est uploadé, traite-le
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo) {
                Storage::delete($user->photo); // Suppression de l'ancienne photo
            }

            // Stocker la nouvelle photo dans le répertoire 'profiles'
            $path = $request->file('photo')->store('profiles', 'public'); // 'public' pour qu'elle soit accessible via un lien

            // Met à jour le champ photo de l'utilisateur
            $user->photo = $path;

            // Sauvegarde l'utilisateur
            if ($user->save()) {
                return redirect()->back()->with('success', 'Photo de profil mise à jour avec succès.');
            } else {
                return redirect()->back()->withErrors(['save' => 'Une erreur est survenue lors de la sauvegarde de la photo.']);
            }
        }

        return redirect()->back()->with('success', 'Aucune nouvelle photo n\'a été téléchargée.');
    }


}
