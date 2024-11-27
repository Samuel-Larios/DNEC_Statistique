<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    // Affiche la liste des années
    public function index()
    {
        // Compte le nombre d'utilisateurs avec le droit 'inscrire'
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupère les années, ordonnées par ordre décroissant avec pagination
        $years = Year::orderBy('created_at', 'desc')->paginate(12);

        return view('years.index', compact('countInscrits', 'years'));
    }


    // Affiche le formulaire de création
    public function create()
    {
        // Compte le nombre d'utilisateurs avec le droit 'inscrire'
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Passer le compteur à la vue 'years.create'
        return view('years.create', ['countInscrits' => $countInscrits]);
    }


    // Enregistre une nouvelle année
    public function store(Request $request)
    {
        // Compte le nombre d'utilisateurs avec le droit 'inscrire'
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupérer la liste des utilisateurs inscrits
        $inscrits = User::where('droit', 'inscrire')->get();

        $request->validate([
            'year' => 'required|integer|unique:years,year',
        ]);

        Year::create($request->only('year'));

        return redirect()->route('years.index')->with('success', 'Année ajoutée avec succès !');
    }

    // Affiche le formulaire de modification pour une année spécifique
    public function edit(Year $year)
    {
        // Compte le nombre d'utilisateurs avec le droit 'inscrire'
        $countInscrits = User::where('droit', 'inscrire')->count();

        // Récupérer la liste des utilisateurs inscrits
        $inscrits = User::where('droit', 'inscrire')->get();

        return view('years.edit', compact('countInscrits', 'year'));
    }

    // Met à jour une année existante
    public function update(Request $request, Year $year)
    {
        $request->validate([
            'year' => 'required|integer|unique:years,year,' . $year->id,
        ]);

        $year->update($request->only('year'));

        return redirect()->route('years.index')->with('success', 'Année mise à jour avec succès !');
    }

    // Supprime une année
    public function destroy(Year $year)
    {
        $year->delete();

        return redirect()->route('years.index')->with('success', 'Année supprimée avec succès !');
    }
}
