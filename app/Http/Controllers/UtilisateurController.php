<?php

namespace App\Http\Controllers;

use id;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Year;
use App\Models\Ecole;
use App\Models\Examen;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UtilisateurController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
    {
        // Valider les informations de connexion
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Essayer de connecter l'utilisateur
        if (Auth::attempt($request->only('email', 'password'))) {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();

            // Enregistrer l'heure de connexion dans la session
            session(['last_login_time' => Carbon::now()->toDateTimeString()]);

            // Vérifier le rôle de l'utilisateur
            if ($user->droit === 'admin') {
                return redirect()->route('dashboard.dashboard')->with('success', 'Connexion réussie');
            } elseif ($user->droit === 'inscrire') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Votre compte n\'est pas encore validé.',
                ]);
            } else {
                // Si aucun des cas ci-dessus, rediriger vers 'utilisateurs'
                return redirect()->route('utilisateurs')->with('success', 'Connexion réussie');
            }
        }

        // Si les informations de connexion ne sont pas correctes
        return back()->withErrors([
            'email' => 'Les informations de connexion ne sont pas correctes.',
        ]);
    }



    // Gérer la déconnexion
    public function logout(Request $request)
    {
        Auth::guard()->logout(); // Déconnecter l'utilisateur
        $request->session()->invalidate(); // Invalider la session
        $request->session()->regenerateToken(); // Régénérer le token CSRF

        return redirect()->route('login')->with('success', 'Déconnexion réussie');
    }

    // Afficher la vue du tableau de bord.
    public function acceuil()
    {
        $user = Auth::user();
        $utilisateur = Auth::user();
        $ecoles = Ecole::all();
        $user = Auth::user(); // Récupérer l'utilisateur connecté

        if ($user) {
            $userEcole = $user->ecoles()->first(); // Récupérer la première école de l'utilisateur connecté
        } else {
            $userEcole = null; // Gérer le cas où l'utilisateur n'est pas authentifié
        }
        return view('acceuil.index', compact('user', 'utilisateur' , 'userEcole'));
    }

    // Afficher la vue du tableau de bord.
    public function acceuils()
    {
        // Récupérer la liste des utilisateurs inscrits (droit 'inscrire') avec pagination (10 par page)
        $inscrits = User::where('droit', 'inscrire')->paginate(10);

        // Compter le nombre total d'inscrits (sans pagination)
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupérer la liste des utilisateurs administrateurs (droit 'admin') avec pagination (10 par page)
        $admins = User::where('droit', 'admin')->paginate(10);

        // Compter le nombre total d'administrateurs (sans pagination)
        $countAdmins = User::where('droit', 'admin')->count();

        $user = Auth::user();
        $utilisateur = Auth::user();
        $ecoles = Ecole::all();
        $user = Auth::user(); // Récupérer l'utilisateur connecté

        if ($user) {
            $userEcole = $user->ecoles()->first(); // Récupérer la première école de l'utilisateur connecté
        } else {
            $userEcole = null; // Gérer le cas où l'utilisateur n'est pas authentifié
        }
        return view('acceuils.index', compact('user', 'utilisateur' , 'userEcole' , 'countInscrits', 'countAdmins'));
    }


    public function index()
    {
        // Retrieve the logged-in user
        $user = Auth::user();
        $utilisateur = $user;
        $ecoles = Ecole::all();

        // Check if the user is associated with a school
        $userEcole = $user ? $user->ecoles()->first() : null;

        // Retrieve exams for the user's school for the last 5 years if a school is associated
        if ($userEcole) {
            $examData = Examen::with(['year' => function ($query) {
                    $query->orderBy('year', 'desc')->take(5); // Limit to the last 5 years
                }])
                ->where('ecole_id', $userEcole->id) // Filter by the user's school
                ->get()
                ->groupBy('nom')
                ->map(function($examens, $nom) {
                    return [
                        'nom' => $nom,
                        'labels' => $examens->pluck('year.year')->toArray(), // Years for chart labels
                        'data' => $examens->pluck('total_admis')->toArray() // Data for total admitted count
                    ];
                })->values();
        } else {
            // If the user is not associated with a school, return an empty collection
            $examData = collect();
        }

        // Check if examData is empty and set a message if necessary
        $message = $examData->isEmpty() ? "Aucune donnée trouvée" : null;

        // Return the view with the filtered exam data and message
        return view('utilisateurs.index', compact('user', 'utilisateur', 'userEcole', 'examData', 'message'));
    }





    // public function viewPersonnels()
    public function viewPersonnels()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Récupère la première école à laquelle l'utilisateur appartient
        $userEcole = $user->ecoles()->first();

        // Vérifie si l'utilisateur a une école associée
        if ($userEcole) {
            // Récupère les personnels associés à l'école de l'utilisateur, ordonnés par date de création décroissante, avec pagination
            $personnels = Personnel::with('annee', 'ecole')
                            ->where('ecole_id', $userEcole->id) // Filtre par l'école de l'utilisateur
                            ->orderBy('created_at', 'desc') // Tri par date d'enregistrement décroissante
                            ->paginate(12); // Pagination de 12 par page
        } else {
            // Gérer le cas où l'utilisateur n'appartient à aucune école
            $personnels = collect(); // Une collection vide
        }

        return view('personnels.index', compact('personnels'));
    }


    public function createPersonnels()
    {
        $annees = Year::all();
        $ecoles = Ecole::all();
        $user = Auth::user(); // Récupérer l'utilisateur connecté

        if ($user) {
            $userEcole = $user->ecoles()->first(); // Récupérer la première école de l'utilisateur connecté
        } else {
            $userEcole = null; // Gérer le cas où l'utilisateur n'est pas authentifié
        }

        return view('personnels.create', compact('annees', 'ecoles', 'userEcole'));
    }

    // public function store(Request $request)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nbre_de_femmes' => 'required|integer',
            'nbre_de_hommes' => 'required|integer',
            'nbre_religieux' => 'required|integer',
            'nbre_religieuse' => 'required|integer',
            'nbre_pretre' => 'required|integer',
            'nbre_soeur' => 'required|integer',
            'nbre_autres_religieux' => 'required|integer',
            'nbre_enseignant_f' => 'required|integer',
            'nbre_enseignant_h' => 'required|integer',
            'annee_id' => 'required|exists:years,id',
            'ecole_id' => 'required|exists:ecoles,id',
        ]);

        // Ajouter l'ID de l'utilisateur actuellement connecté
        $validatedData['user_id'] = Auth::id();

        Personnel::create($validatedData);

        return redirect()->route('personnels.index')->with('success', 'Personnel ajouté avec succès.');
    }


    public function showPersonnels($id)
    {
        $personnel = Personnel::with('annee', 'ecole')->findOrFail($id);
        return view('personnels.show', compact('personnel'));
    }


    public function editPersonnels(Personnel $personnel)
    {
        $annees = Year::all();
        $ecoles = Ecole::all();
        return view('personnels.edit', compact('personnel', 'annees', 'ecoles'));
    }


    public function updatePersonnels(Request $request, Personnel $personnel)
    {
        $validatedData = $request->validate([
            'nbre_de_femmes' => 'required|integer',
            'nbre_de_hommes' => 'required|integer',
            'nbre_religieux' => 'required|integer',
            'nbre_religieuse' => 'required|integer',
            'nbre_pretre' => 'required|integer',
            'nbre_soeur' => 'required|integer',
            'nbre_autres_religieux' => 'required|integer',
            'nbre_enseignant_f' => 'required|integer',
            'nbre_enseignant_h' => 'required|integer',
            'annee_id' => 'required|exists:years,id',
        ]);

        $personnel->update($validatedData);

        return redirect()->route('personnels.index')->with('success', 'Personnel mis à jour avec succès.');
    }

    public function destroy(Personnel $personnel)
    {
        $personnel->delete();

        return redirect()->route('personnels.index')->with('success', 'Personnel supprimé avec succès.');
    }


}
