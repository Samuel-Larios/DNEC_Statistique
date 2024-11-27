@extends('base')

@section('titre', 'Statistique || DNEC')

@section('contenu')

<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('ecoles.create') }}" class="btn btn-primary">
        <i class="fas fa-plus" style="font-size: 0.8em;"> </i> Ajouter une École
    </a>
</div>

<div class="container-fluid">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Écoles</h4>
                <p class="card-description">Liste des écoles inscrites, classée par diocèse</p>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Diocèse</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ecoles as $ecole)
                            <tr>
                                <td>{{ $ecole->id }}</td>
                                <td>{{ $ecole->nom }}</td>
                                <td>{{ $ecole->diocese->nom ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('ecoles.edit', $ecole->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                    <form action="{{ route('ecoles.destroy', $ecole->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette école ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $ecoles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
