@extends('bases')

@section('titre', 'Ajouter une Performance || DNEC')

@section('contenu')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h1 class="text-center mb-4">Ajouter une Performance</h1>

        <form action="{{ route('performances.store') }}" method="POST">
            @csrf

            <!-- Champs pour chaque attribut de la performance -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="classe" class="form-label">Classe :</label>
                    <input type="text" name="classe" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="eleveInscrit" class="form-label">Élèves Inscrits :</label>
                    <input type="number" name="eleveInscrit" class="form-control" required>
                </div>
            </div>

            <!-- Autres champs pour les performances -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbreFille" class="form-label">Nombre de Filles :</label>
                    <input type="number" name="nbreFille" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nbreGarcon" class="form-label">Nombre de Garçons :</label>
                    <input type="number" name="nbreGarcon" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbreMoyenne" class="form-label">Nombre de Moyenne :</label>
                    <input type="number" name="nbreMoyenne" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nbreMfille" class="form-label">Moyenne Filles :</label>
                    <input type="number" name="nbreMfille" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbreMgarcon" class="form-label">Moyenne Garçons :</label>
                    <input type="number" name="nbreMgarcon" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nbreAbandon" class="form-label">Nombre d'Abandons :</label>
                    <input type="number" name="nbreAbandon" class="form-control" required>
                </div>
            </div>

            <!-- Champs année et école -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="annee_id" class="form-label">Année :</label>
                    <select name="annee_id" class="form-control" required>
                        <option value="" disabled selected>Choisir une année</option>
                        @foreach ($annees as $annee)
                            <option value="{{ $annee->id }}">{{ $annee->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ecole_id" class="form-label">École :</label>
                    <input type="text" class="form-control" value="{{ $userEcole->nom ?? 'Aucune école assignée' }}" readonly>
                    <input type="hidden" name="ecole_id" value="{{ $userEcole->id ?? '' }}">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection
