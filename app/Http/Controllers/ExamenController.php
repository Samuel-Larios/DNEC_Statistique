<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Examen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamenController extends Controller
{

    // public function acceuil()
    // {
    //     $examens = Examen::with('year')->get();
    //     $annees = Year::all();
    //     return view('examens.index', compact('annees', 'examens'));
    // }
    public function index()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Récupère la première école associée à l'utilisateur
        $userEcole = $user->ecoles()->first();

        // Vérifie si l'utilisateur est associé à une école
        if ($userEcole) {
            // Récupère les examens uniquement pour l'école de l'utilisateur
            $examens = Examen::with('year')
                        ->where('ecole_id', $userEcole->id) // Filtre par l'école de l'utilisateur
                        ->get();
        } else {
            // Si l'utilisateur n'a pas d'école associée, retourne une collection vide
            $examens = collect();
        }

        // Récupère toutes les années pour le filtre
        $annees = Year::all();

        // Renvoie la vue avec les examens filtrés et les années
        return view('examens.index', compact('annees', 'examens'));
    }



    public function create()
    {
        // Récupérer toutes les années depuis la base de données
        $annees = Year::all();

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Récupérer l'école associée à l'utilisateur
        $userEcole = $user->ecoles()->first();

        // Définir les options d'examens
        $examens = [
            'Baccalauréat',
            'Certificat d\'Aptitude professionnelle',
            'Brevet d\'Etude Supérieur'
        ];

        // Définir les séries selon l'examen
            $series = ['MC', 'ML', 'Série A', 'Série B', 'Série C', 'Série D', 'Série G', 'Série E', 'Série F']; // Séries pour les autres examens



        // Passer les données à la vue
        return view('examens.create', compact('annees', 'userEcole', 'examens', 'series'));
    }


    public function store(Request $request)
    {
        // Valider les données d'entrée
        $request->validate([
            'nom' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
            'annee_id' => 'required|exists:years,id',
            'ecole_id' => 'required|exists:ecoles,id',
            'fille' => 'required|integer|min:0',
            'garcon' => 'required|integer|min:0',
            'fille_admis' => 'required|integer|min:0',
            'garcon_admis' => 'required|integer|min:0',
            'fille_passable' => 'required|integer|min:0',
            'garcon_passable' => 'required|integer|min:0',
            'fille_bien' => 'required|integer|min:0',
            'garcon_bien' => 'required|integer|min:0',
            'fille_tbien' => 'required|integer|min:0',
            'garcon_tbien' => 'required|integer|min:0',
            'fille_honorable' => 'required|integer|min:0',
            'garcon_honorable' => 'required|integer|min:0',
        ]);

        // Calculer les valeurs totales
        $total_inscrit = $request->fille + $request->garcon;
        $total_admis = $request->fille_admis + $request->garcon_admis;
        $total_passable = $request->fille_passable + $request->garcon_passable;
        $total_bien = $request->fille_bien + $request->garcon_bien;
        $total_tbien = $request->fille_tbien + $request->garcon_tbien;
        $total_honorable = $request->fille_honorable + $request->garcon_honorable;

        // Créer un nouvel examen avec les données du formulaire et les valeurs calculées
        Examen::create([
            'nom' => $request->nom,
            'serie' => $request->serie,
            'annee_id' => $request->annee_id,
            'ecole_id' => $request->ecole_id,
            'total_inscrit' => $total_inscrit,
            'fille' => $request->fille,
            'garcon' => $request->garcon,
            'total_admis' => $total_admis,
            'fille_admis' => $request->fille_admis,
            'garcon_admis' => $request->garcon_admis,
            'total_passable' => $total_passable,
            'fille_passable' => $request->fille_passable,
            'garcon_passable' => $request->garcon_passable,
            'total_bien' => $total_bien,
            'fille_bien' => $request->fille_bien,
            'garcon_bien' => $request->garcon_bien,
            'total_tbien' => $total_tbien,
            'fille_tbien' => $request->fille_tbien,
            'garcon_tbien' => $request->garcon_tbien,
            'total_honorable' => $total_honorable,
            'fille_honorable' => $request->fille_honorable,
            'garcon_honorable' => $request->garcon_honorable,
        ]);

        return redirect()->route('examens.index')->with('success', 'Examen créé avec succès.');
    }



    public function show(Examen $examen)
    {
        return view('examens.show', compact('examen'));
    }

    // Méthode pour afficher le formulaire de modification
    public function edit($id)
    {
        // Récupérer toutes les années depuis la base de données
        $annees = Year::all();

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Récupérer l'école associée à l'utilisateur
        $userEcole = $user->ecoles()->first();

        // Récupérer l'examen à modifier
        $examen = Examen::findOrFail($id);

        // Définir les options d'examens
        $examens = [
            'Baccalauréat',
            'Certificat d\'Aptitude professionnelle',
            'Brevet d\'Etude Supérieur'
        ];

        // Définir les séries selon l'examen
        $series = ['MC', 'ML', 'Série A', 'Série B', 'Série C', 'Série D', 'Série G', 'Série E', 'Série F'];

        // Passer les données à la vue
        return view('examens.edit', compact('annees', 'userEcole', 'examens', 'series', 'examen'));
    }


    // Méthode pour mettre à jour l'examen
    public function update(Request $request, $id)
    {
        // Valider les données envoyées
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
            'annee_id' => 'required|exists:years,id', // Utiliser le nom correct de la table
            'ecole_id' => 'required|exists:ecoles,id',
            'fille' => 'nullable|integer',
            'garcon' => 'nullable|integer',
            'fille_admis' => 'nullable|integer',
            'garcon_admis' => 'nullable|integer',
            'fille_passable' => 'nullable|integer',
            'garcon_passable' => 'nullable|integer',
            'fille_bien' => 'nullable|integer',
            'garcon_bien' => 'nullable|integer',
            'fille_tbien' => 'nullable|integer',
            'garcon_tbien' => 'nullable|integer',
            'fille_honorable' => 'nullable|integer',
            'garcon_honorable' => 'nullable|integer',
        ]);

        // Récupérer l'examen à modifier
        $examen = Examen::findOrFail($id);

        // Mettre à jour les données de l'examen
        $examen->update($validated);

        // Rediriger vers une page de succès ou vers l'examen modifié
        return redirect()->route('examens.index')->with('success', 'Examen mis à jour avec succès.');
    }



    public function destroy(Examen $examen)
    {
        $examen->delete();
        return redirect()->route('examens.index')->with('success', 'Examen supprimé avec succès.');
    }
}
