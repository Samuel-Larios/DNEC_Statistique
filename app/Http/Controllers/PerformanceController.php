<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{

    public function index()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Récupère la première école associée à l'utilisateur
        $userEcole = $user->ecoles()->first();

        // Vérifie si l'utilisateur est associé à une école
        if ($userEcole) {
            // Récupère les performances uniquement pour l'école de l'utilisateur
            $performances = Performance::with('annee', 'ecole')
                            ->where('ecole_id', $userEcole->id) // Filtre par l'école de l'utilisateur
                            ->get();
        } else {
            // Si l'utilisateur n'a pas d'école associée, retourne une collection vide
            $performances = collect();
        }

        // Renvoie la vue avec les performances filtrées
        return view('performances.index', compact('performances'));
    }


    public function create()
    {
        $annees = Year::all();
        $user = Auth::user();
        $userEcole = $user->ecoles()->first();
        return view('performances.create', compact('annees', 'userEcole'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classe' => 'required|string|max:255',
            'eleveInscrit' => 'required|integer',
            'nbreFille' => 'required|integer',
            'nbreGarcon' => 'required|integer',
            'nbreMoyenne' => 'required|integer',
            'nbreMfille' => 'required|integer',
            'nbreMgarcon' => 'required|integer',
            'nbreAbandon' => 'required|integer',
            'annee_id' => 'required|exists:years,id',
            'ecole_id' => 'required|exists:ecoles,id',
        ]);

        Performance::create($request->all());
        return redirect()->route('performances.index')->with('success', 'Performance ajoutée avec succès.');
    }

    // public function show(Performance $performance)
    // {
    //     return view('performances.show', compact('performance'));
    // }
    public function show()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Récupère l'école associée à l'utilisateur (s'il en a une)
        $userEcole = $user->ecoles()->first();

        // Vérifie si l'utilisateur a une école associée
        if ($userEcole) {
            // Récupère les performances uniquement de l'école de l'utilisateur
            $performances = Performance::with('annee', 'ecole')
                            ->where('ecole_id', $userEcole->id) // Filtre par l'école de l'utilisateur
                            ->get();
        } else {
            // Si l'utilisateur n'a pas d'école associée, retourne une collection vide
            $performances = collect();
        }

        // Renvoie la vue avec les performances filtrées
        return view('performances.show', compact('performances'));
    }





    public function edit(Performance $performance)
    {
        $annees = Year::all();
        return view('performances.edit', compact('performance', 'annees'));
    }

    public function update(Request $request, Performance $performance)
    {
        // Validation des données
        $validatedData = $request->validate([
            'classe' => 'required|string|max:255',
            'eleveInscrit' => 'required|integer',
            'nbreFille' => 'required|integer',
            'nbreGarcon' => 'required|integer',
            'nbreMoyenne' => 'required|integer',
            'nbreMfille' => 'required|integer',
            'nbreMgarcon' => 'required|integer',
            'nbreAbandon' => 'required|integer',
            'annee_id' => 'required|exists:years,id',
        ]);

        try {
            // Met à jour le modèle avec les données validées
            $performance->update($validatedData);

            return redirect()->route('performances.index')
                            ->with('success', 'Performance mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour.'])
                            ->withInput();
        }
    }



    public function destroy(Performance $performance)
    {
        $performance->delete();
        return redirect()->route('performances.index')->with('success', 'Performance supprimée avec succès.');
    }
}
