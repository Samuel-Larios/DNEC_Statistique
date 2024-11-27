@extends('bases')

@section('titre', 'Enregistrement du personnel || DNEC')

@section('contenu')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Liste des Personnels</h1>

        <div class="text-end mb-3">
            <a href="{{ route('personnels.create') }}" class="btn btn-primary"><i class="fas fa-plus" style="font-size: 0.8em;"></i> Ajouter un Personnel</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Nombre de Femmes</th>
                    <th class="text-center">Nombre d'Hommes</th>
                    <th class="text-center">Année</th>
                    <th class="text-center">École</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($personnels as $personnel)
                    <tr>
                        <td class="text-center">{{ $personnel->nbre_de_femmes }}</td>
                        <td class="text-center">{{ $personnel->nbre_de_hommes }}</td>
                        <td class="text-center">{{ $personnel->annee->year }}</td> <!-- Affiche l'année -->
                        <td class="text-center">{{ $personnel->ecole->nom }}</td> <!-- Affiche le nom de l'école -->
                        <td class="text-center gap-2">
                            <a href="{{ route('personnels.show', $personnel) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('personnels.edit', ['personnel' => $personnel->id]) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('personnels.destroy', $personnel) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce personnel ?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun personnel trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $personnels->links() }}
        </div>
    </div>
@endsection
