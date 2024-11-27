@extends('base')

@section('titre', 'Années || DNEC')

@section('contenu')
<div class="container my-4">

    <!-- Bouton pour ajouter une année -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('years.create') }}" class="btn btn-primary">
            <i class="fas fa-plus" style="font-size: 0.8em;"> </i> Ajouter une Année
        </a>
    </div>

    <!-- Affichage du message de succès -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Table des années -->
    <div class="d-flex justify-content-center">
        <div class="table-responsive col-md-8">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Année</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($years as $year)
                        <tr>
                            <td>{{ $year->id }}</td>
                            <td>{{ $year->year }}</td>
                            <td>
                                <!-- Bouton de modification -->
                                <a href="{{ route('years.edit', $year) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>

                                <!-- Formulaire pour supprimer une année -->
                                <form action="{{ route('years.destroy', $year) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette année ?')">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $years->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
