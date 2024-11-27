@extends('bases')

@section('titre', 'Détails du Personnel || DNEC')

@section('contenu')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Détails du Personnel</h1>

        <div class="mb-4 text-center">
            <a href="{{ route('personnels.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informations du Personnel</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-hover table-striped">
                    <tr>
                        <th><i class="fas fa-female"></i> Nombre de Femmes</th>
                        <td>{{ $personnel->nbre_de_femmes }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-male"></i> Nombre d'Hommes</th>
                        <td>{{ $personnel->nbre_de_hommes }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-cross"></i> Nombre de Religieux</th>
                        <td>{{ $personnel->nbre_religieux }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-cross"></i> Nombre de Religieuses</th>
                        <td>{{ $personnel->nbre_religieuse }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-praying-hands"></i> Nombre de Prêtres</th>
                        <td>{{ $personnel->nbre_pretre }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-female"></i> Nombre de Sœurs</th>
                        <td>{{ $personnel->nbre_soeur }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-user-friends"></i> Nombre d'Autres Religieux</th>
                        <td>{{ $personnel->nbre_autres_religieux }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-chalkboard-teacher"></i> Nombre d'Enseignantes (Femmes)</th>
                        <td>{{ $personnel->nbre_enseignant_f }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-chalkboard-teacher"></i> Nombre d'Enseignants (Hommes)</th>
                        <td>{{ $personnel->nbre_enseignant_h }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-calendar-alt"></i> Année</th>
                        <td>{{ $personnel->annee->year ?? 'Année non définie' }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-school"></i> École</th>
                        <td>{{ $personnel->ecole->nom ?? 'École non définie' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
