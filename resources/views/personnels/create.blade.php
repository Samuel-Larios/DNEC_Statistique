@extends('bases')

@section('titre', 'Compte du Personnel || DNEC')

@section('contenu')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h1 class="text-center mb-4">Ajouter un Personnel</h1>

        <form action="{{ route('personnels.store') }}" method="POST">
            @csrf
            <!-- Champs pour chaque attribut -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbre_de_femmes" class="form-label"><i class="fas fa-female"></i> Nombre de Femmes :</label>
                    <input type="number" name="nbre_de_femmes" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nbre_de_hommes" class="form-label"><i class="fas fa-male"></i> Nombre d'Hommes :</label>
                    <input type="number" name="nbre_de_hommes" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbre_religieux" class="form-label"><i class="fas fa-cross"></i> Nombre de Religieux :</label>
                    <input type="number" name="nbre_religieux" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nbre_religieuse" class="form-label"><i class="fas fa-praying-hands"></i> Nombre de Religieuses :</label>
                    <input type="number" name="nbre_religieuse" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbre_pretre" class="form-label"><i class="fas fa-praying-hands"></i> Nombre de Prêtres :</label>
                    <input type="number" name="nbre_pretre" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nbre_soeur" class="form-label"><i class="fas fa-female"></i> Nombre de Sœurs :</label>
                    <input type="number" name="nbre_soeur" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbre_autres_religieux" class="form-label"><i class="fas fa-user-friends"></i> Nombre d'Autres Religieux :</label>
                    <input type="number" name="nbre_autres_religieux" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nbre_enseignant_f" class="form-label"><i class="fas fa-chalkboard-teacher"></i> Nombre d'Enseignantes (Femmes) :</label>
                    <input type="number" name="nbre_enseignant_f" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbre_enseignant_h" class="form-label"><i class="fas fa-chalkboard-teacher"></i> Nombre d'Enseignants (Hommes) :</label>
                    <input type="number" name="nbre_enseignant_h" class="form-control" required>
                </div>
            </div>

            <!-- Champs année et école sur une seule ligne -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="annee_id" class="form-label"><i class="fas fa-calendar-alt"></i> Année :</label>
                    <select name="annee_id" class="form-control" required>
                        <option value="" disabled selected>Choisir une année</option>
                        @foreach ($annees as $annee)
                            <option value="{{ $annee->id }}">{{ $annee->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ecole_id" class="form-label"><i class="fas fa-school"></i> École :</label>
                    <input type="text" class="form-control" value="{{ $userEcole->nom ?? 'Aucune école assignée' }}" readonly>
                    <input type="hidden" name="ecole_id" value="{{ $userEcole->id ?? '' }}"> <!-- Champ caché pour l'ID -->
                </div>

            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection
