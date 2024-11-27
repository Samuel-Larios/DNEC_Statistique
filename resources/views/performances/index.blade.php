@extends('bases')

@section('titre', 'Liste des Performances || DNEC')

@section('contenu')
<div class="container mt-5">
    <h1 class="text-center mb-4">Liste des Performances</h1>

    <div class="text-end mb-3">
        <a href="{{ route('performances.create') }}" class="btn btn-primary"><i class="fas fa-plus" style="font-size: 0.8em;"></i>            Ajouter une Performance</a>
        @if(session('success'))
            <div class="alert alert-success w-50 text-center">{{ session('success') }}</div>
        @endif
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Classe</th>
                <th class="text-center">Élèves Inscrits</th>
                <th class="text-center">Filles</th>
                <th class="text-center">Garçons</th>
                <th class="text-center">Moyenne</th>
                <th class="text-center">Moyenne Filles</th>
                <th class="text-center">Moyenne Garçons</th>
                <th class="text-center">Abandons</th>
                <th class="text-center">Année</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($performances as $performance)
                <tr>
                    <td class="text-center">{{ $performance->classe }}</td>
                    <td class="text-center">{{ $performance->eleveInscrit }}</td>
                    <td class="text-center">{{ $performance->nbreFille }}</td>
                    <td class="text-center">{{ $performance->nbreGarcon }}</td>
                    <td class="text-center">{{ $performance->nbreMoyenne }}</td>
                    <td class="text-center">{{ $performance->nbreMfille }}</td>
                    <td class="text-center">{{ $performance->nbreMgarcon }}</td>
                    <td class="text-center">{{ $performance->nbreAbandon }}</td>
                    <td class="text-center">{{ $performance->annee->year }}</td>
                    <td class="text-center gap-2">
                        <a href="{{ route('performances.edit', $performance) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('performances.destroy', $performance) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette performance ?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Aucune performance enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
