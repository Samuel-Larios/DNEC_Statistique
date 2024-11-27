@extends('bases')

@section('titre', 'Modifier le Personnel || DNEC')

@section('contenu')
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h1 class="text-center mb-4">Modifier le Personnel</h1>

            <div class="mb-4 text-center">
                <a href="{{ route('personnels.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
            </div>

            <form action="{{ route('personnels.update', ['personnel' => $personnel->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Champs pour chaque attribut avec icônes -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nbre_de_femmes" class="form-label"><i class="fas fa-female"></i> Nombre de Femmes :</label>
                        <input type="number" name="nbre_de_femmes" class="form-control" value="{{ old('nbre_de_femmes', $personnel->nbre_de_femmes) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nbre_de_hommes" class="form-label"><i class="fas fa-male"></i> Nombre d'Hommes :</label>
                        <input type="number" name="nbre_de_hommes" class="form-control" value="{{ old('nbre_de_hommes', $personnel->nbre_de_hommes) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nbre_religieux" class="form-label"><i class="fas fa-cross"></i> Nombre de Religieux :</label>
                        <input type="number" name="nbre_religieux" class="form-control" value="{{ old('nbre_religieux', $personnel->nbre_religieux) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nbre_religieuse" class="form-label"><i class="fas fa-praying-hands"></i> Nombre de Religieuses :</label>
                        <input type="number" name="nbre_religieuse" class="form-control" value="{{ old('nbre_religieuse', $personnel->nbre_religieuse) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nbre_pretre" class="form-label"><i class="fas fa-praying-hands"></i> Nombre de Prêtres :</label>
                        <input type="number" name="nbre_pretre" class="form-control" value="{{ old('nbre_pretre', $personnel->nbre_pretre) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nbre_soeur" class="form-label"><i class="fas fa-female"></i> Nombre de Sœurs :</label>
                        <input type="number" name="nbre_soeur" class="form-control" value="{{ old('nbre_soeur', $personnel->nbre_soeur) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nbre_autres_religieux" class="form-label"><i class="fas fa-user-friends"></i> Nombre d'Autres Religieux :</label>
                        <input type="number" name="nbre_autres_religieux" class="form-control" value="{{ old('nbre_autres_religieux', $personnel->nbre_autres_religieux) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nbre_enseignant_f" class="form-label"><i class="fas fa-chalkboard-teacher"></i> Nombre d'Enseignantes (Femmes) :</label>
                        <input type="number" name="nbre_enseignant_f" class="form-control" value="{{ old('nbre_enseignant_f', $personnel->nbre_enseignant_f) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nbre_enseignant_h" class="form-label"><i class="fas fa-chalkboard-teacher"></i> Nombre d'Enseignants (Hommes) :</label>
                        <input type="number" name="nbre_enseignant_h" class="form-control" value="{{ old('nbre_enseignant_h', $personnel->nbre_enseignant_h) }}" required>
                    </div>
                </div>

                <!-- Champs année et école sur une seule ligne -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="annee_id" class="form-label"><i class="fas fa-calendar-alt"></i> Année :</label>
                        <select name="annee_id" class="form-control" required>
                            <option value="" disabled>Sélectionner une année</option>
                            @foreach ($annees as $annee)
                                <option value="{{ $annee->id }}" {{ $annee->id == $personnel->annee_id ? 'selected' : '' }}>
                                    {{ $annee->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
@endsection
