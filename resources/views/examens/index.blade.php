@extends('bases')

@section('titre', 'Modifier École || DNEC')

@section('contenu')
<div class="container">
    <h1 class="my-4 text-center">Liste des Examens</h1>

    <!-- Messages de succès et d'erreur -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('examens.create') }}" class="btn btn-primary">
            <i class="fas fa-plus" style="font-size: 0.8em;"></i> Ajouter un examen
        </a>
    </div>

    <div class="table-responsive">
        <!-- Première Partie : Statistiques Générales -->
        <h3 class="text-center">Statistiques Générales</h3>
        <table class="table table-bordered table-hover mb-4">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th class="text-center">Année</th>
                    <th class="text-center">Total <br> Inscrits</th>
                    <th class="text-center">Total <br> Admis</th>
                    <th class="text-center">Total <br> Passable</th>
                    <th class="text-center">Total <br> Bien</th>
                    <th class="text-center">Total <br> Très Bien</th>
                    <th class="text-center">Total <br> Honorable</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examens as $examen)
                    <tr>
                        <td>{{ $examen->nom }}</td>
                        <td class="text-center">{{ $examen->year->year }}</td>
                        <td class="text-center">{{ $examen->total_inscrit }}</td>
                        <td class="text-center">{{ $examen->total_admis }}</td>
                        <td class="text-center">{{ $examen->total_passable }}</td>
                        <td class="text-center">{{ $examen->total_bien }}</td>
                        <td class="text-center">{{ $examen->total_tbien }}</td>
                        <td class="text-center">{{ $examen->total_honorable }}</td>
                        <td class="text-center">
                            <a href="{{ route('examens.edit', $examen) }}" class="btn btn-sm btn-warning" title="Modifier">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('examens.destroy', $examen) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet examen ?');">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Deuxième Partie : Résultats détaillés -->
        <h3 class="text-center">Résultats Détaillés</h3>
        <style>
            /* Réduction maximale de la taille de la police et du padding pour une table compacte */
            .table-condensed th, .table-condensed td {
                padding: 2px; /* Réduction du padding */
                font-size: 0.7rem; /* Taille de police plus petite */
            }
        </style>

        <table class="table table-bordered table-dark table-striped table-sm table-condensed" style="margin-bottom: 100px;">
            <thead class="table-light">
                <tr>
                    <th style="width: 7%;">Nom</th>
                    <th class="text-center" style="width: 6%;">Année</th>
                    <th class="text-center" style="width: 6%;">Admis (F)</th>
                    <th class="text-center" style="width: 6%;">Admis (G)</th>
                    <th class="text-center" style="width: 6%;">Passable (F)</th>
                    <th class="text-center" style="width: 6%;">Passable (G)</th>
                    <th class="text-center" style="width: 6%;">Bien (F)</th>
                    <th class="text-center" style="width: 6%;">Bien (G)</th>
                    <th class="text-center" style="width: 6%;">Très<br>Bien (F)</th>
                    <th class="text-center" style="width: 6%;">Très<br>Bien (G)</th>
                    <th class="text-center" style="width: 6%;">Honorable (F)</th>
                    <th class="text-center" style="width: 6%;">Honorable (G)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examens as $examen)
                    <tr>
                        <td>{{ $examen->nom }}</td>
                        <td class="text-center">{{ $examen->year->year }}</td>
                        <td class="text-center">{{ $examen->fille_admis }}</td>
                        <td class="text-center">{{ $examen->garcon_admis }}</td>
                        <td class="text-center">{{ $examen->fille_passable }}</td>
                        <td class="text-center">{{ $examen->garcon_passable }}</td>
                        <td class="text-center">{{ $examen->fille_bien }}</td>
                        <td class="text-center">{{ $examen->garcon_bien }}</td>
                        <td class="text-center">{{ $examen->fille_tbien }}</td>
                        <td class="text-center">{{ $examen->garcon_tbien }}</td>
                        <td class="text-center">{{ $examen->fille_honorable }}</td>
                        <td class="text-center">{{ $examen->garcon_honorable }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
