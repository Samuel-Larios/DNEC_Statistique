<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ecole;
use App\Models\Diocese;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\RoleChangedNotification;

class DashboardController extends Controller
{
    // Afficher la vue du tableau de bord.
    public function index()
    {
        // Compte le nombre d'utilisateurs avec le droit 'inscrire'
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupérer la liste des utilisateurs inscrits
        $inscrits = User::where('droit', 'inscrire')->get();

        // Passez les variables à la vue
        return view('dashboard.dashboard.index', compact('countInscrits', 'inscrits'));
    }



    // Compte le nombre d'utilisateurs ayant le droit 'inscrire'
    public function compterInscrits()
    {
        // Vous pouvez conserver cette méthode ou la supprimer si elle n'est pas nécessaire
        $countInscrits = User::where('droit', 'inscrire')->count(); // Compte les utilisateurs avec le droit 'inscrire'
        $inscrits = User::where('droit', 'inscrire')->get(); // Récupérer la liste des utilisateurs inscrits

        return view('dashboard.index', compact('countInscrits', 'inscrits')); // Passez les variables à la vue
    }

    public function inscrit()
    {
        // Récupérer la liste des utilisateurs inscrits (droit 'inscrire') avec pagination (10 par page)
        $inscrits = User::where('droit', 'inscrire')->paginate(10);

        // Compter le nombre total d'inscrits (sans pagination)
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupérer la liste des utilisateurs administrateurs (droit 'admin') avec pagination (10 par page)
        $admins = User::where('droit', 'admin')->paginate(10);

        // Compter le nombre total d'administrateurs (sans pagination)
        $countAdmins = User::where('droit', 'admin')->count();

        // Récupérer la liste des utilisateurs avec le droit 'user' avec pagination (10 par page)
        $users = User::where('droit', 'user')->paginate(10);

        // Compter le nombre total d'utilisateurs avec le droit 'user'
        $countUsers = User::where('droit', 'user')->count();

        // Passez les variables à la vue
        return view('dashboard.inscrit', compact('inscrits', 'countInscrits', 'admins', 'countAdmins', 'users', 'countUsers'));
    }



    public function show($id)
    {
        // Récupère l'utilisateur par son ID sans filtrer par droit
        $utilisateur = User::findOrFail($id);

        // Renvoie les détails de l'utilisateur vers la vue appropriée
        return view('dashboard.showinscrit', compact('utilisateur'));
    }

    // Suppression de l'utilisateur
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return Redirect::route('dashboard.inscrit')->with('success', 'Utilisateur supprimé avec succès.');
        }
        return Redirect::back()->with('error', 'Utilisateur non trouvé.');
    }



    public function changeRoleToUser($id)
    {
        $user = User::find($id);
        if ($user) {
            // Forcer le droit à 'user'
            $user->droit = 'user';
            $user->save();

            // Envoyer une notification à l'utilisateur
            $user->notify(new RoleChangedNotification('Utilisateur'));

            // Rediriger avec un message de succès
            return redirect()->route('dashboard.inscrit')
                            ->with('success', 'Le droit de l\'inscrit ' . $user->name . ' a été modifié en utilisateur avec succès.');
        }

        // Rediriger avec un message d'erreur si l'utilisateur n'est pas trouvé
        return redirect()->route('dashboard.inscrit')
                        ->with('error', 'L\'utilisateur avec l\'ID ' . $id . ' n\'a pas été trouvé.');
    }

    public function changeRoleToAdmin($id)
    {
        $user = User::find($id);
        if ($user) {
            // Forcer le droit à 'user'
            $user->droit = 'admin';
            $user->save();

            // Rediriger vers la page "inscrit" avec un message de succès incluant le nom de l'utilisateur
            return redirect()->route('dashboard.inscrit')
                            ->with('success', 'Le droit de l\'inscrit ' . $user->name . ' a été modifié en administrateur avec succès.');
        }

        // Rediriger vers la page "inscrit" avec un message d'erreur si l'utilisateur n'est pas trouvé
        return redirect()->route('dashboard.inscrit')
                        ->with('error', 'L\'utilisateur avec l\'ID ' . $id . ' n\'a pas été trouvé.');
    }

    // Afficher la page de modification du mot de passe
    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit-password', compact('user'));
    }

    // Modifier le mot de passe d'un utilisateur
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirection selon le droit de l'utilisateur
        if ($user->droit === 'admin') {
            return redirect()->route('dashboard.inscrit')->with('success', 'Mot de passe mis à jour avec succès');
        } elseif ($user->droit === 'user') {
            return redirect()->route('utilisateurs')->with('success', 'Mot de passe mis à jour avec succès');
        } else {
            return redirect()->route('utilisateurs')->with('success', 'Mot de passe mis à jour avec succès');
        }
    }


    // Afficher la page de modification des information d'un utlisateur
    public function editInfo($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit-info', compact('user'));
    }

    // Modification des information d'un utilisateur
    public function updateInfo(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Redirection selon le droit de l'utilisateur
        if ($user->droit === 'admin') {
            return redirect()->route('dashboard.inscrit')->with('success', 'Informations mises à jour avec succès');
        } elseif ($user->droit === 'user') {
            return redirect()->route('utilisateurs')->with('success', 'Informations mises à jour avec succès');
        } else {
            return redirect()->route('utilisateurs')->with('success', 'Informations mises à jour avec succès');
        }
    }


    // Affichage des diocesses
    public function viewDioceses()
    {
        // Vous pouvez conserver cette méthode ou la supprimer si elle n'est pas nécessaire
        $countInscrits = User::where('droit', 'inscrire')->count(); // Compte les utilisateurs avec le droit 'inscrire'
        $inscrits = User::where('droit', 'inscrire')->get(); // Récupérer la liste des utilisateurs inscrits

        // $dioceses = Diocese::all();
        $dioceses = Diocese::orderBy('created_at', 'desc')->paginate(10);
        return view('dioceses.index', compact('countInscrits', 'dioceses'));
    }

    // Méthode pour afficher le formulaire de création
    public function create()
    {
        return view('dioceses.create');
    }

    // Méthode pour enregistrer un nouveau diocèse
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Diocese::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('dioceses.view')->with('success', 'Diocèse créé avec succès.');
    }

    public function edit($id)
    {
        // Compte le nombre d'utilisateurs avec le droit 'inscrire'
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupérer la liste des utilisateurs inscrits
        $inscrits = User::where('droit', 'inscrire')->get();

        $diocese = Diocese::findOrFail($id);
        return view('dioceses.edit', compact('countInscrits', 'diocese'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $diocese = Diocese::findOrFail($id);
        $diocese->nom = $request->nom;
        $diocese->save();

        return redirect()->route('dioceses.view')->with('success', 'Diocèse mis à jour avec succès.');
    }

    public function destroyDiceses($id)
    {
        $diocese = Diocese::findOrFail($id);
        $diocese->delete();

        return redirect()->route('dioceses.view')->with('success', 'Diocèse supprimé avec succès.');
    }


    public function viewEcoles()
    {
        // Compte le nombre d'utilisateurs avec le droit 'inscrire'
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupérer la liste des utilisateurs inscrits
        $inscrits = User::where('droit', 'inscrire')->get();

        // Récupérer les écoles triées par ordre décroissant de la date de création
        $ecoles = Ecole::with('diocese')
                       ->orderBy('created_at', 'desc')  // Tri par date de création (desc pour décroissant)
                       ->paginate(10); // Changez 10 par le nombre d'éléments par page que vous souhaitez

        return view('ecoles.index', compact('countInscrits', 'ecoles'));
    }


    // Méthode pour afficher le formulaire d'ajout d'une école
    public function createEcole()
    {
        // Récupère tous les diocèses pour les afficher dans la liste déroulante
        $dioceses = Diocese::all();
        return view('ecoles.create', compact('dioceses'));
    }

    // Méthode pour enregistrer une nouvelle école
    public function storeEcole(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'diocese_id' => 'required|exists:dioceses,id', // Valide que le diocèse existe
        ]);

        // Création de la nouvelle école
        Ecole::create([
            'nom' => $request->input('nom'),
            'diocese_id' => $request->input('diocese_id'),
        ]);

        // Redirection avec un message de succès
        return redirect()->route('ecoles.view')->with('success', 'École ajoutée avec succès.');
    }


    public function editEcole(Ecole $ecole)
    {
        $dioceses = Diocese::all(); // Récupérer tous les diocèses disponibles

        return view('ecoles.edit', compact('ecole', 'dioceses')); // Passer l'école à la vue
    }

    public function updateEcole(Request $request, Ecole $ecole)
    {
        // Validation des champs du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'diocese_id' => 'required|exists:dioceses,id', // Assurez-vous que le diocèse existe
        ]);

        // Mise à jour de l'école
        $ecole->update([
            'nom' => $request->nom,
            'diocese_id' => $request->diocese_id,
        ]);

        // Redirection après la mise à jour avec un message de succès
        return redirect()->route('ecoles.view')->with('success', 'L\'école a été modifiée avec succès.');
    }



    public function destroyEcole(Ecole $ecole)
    {
        // Suppression de l'école directement
        $ecole->delete();
        return redirect()->route('ecoles.view')->with('success', 'École supprimée avec succès.');
    }






}
