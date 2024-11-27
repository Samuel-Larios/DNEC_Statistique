@extends('base')

@section('titre', 'Statistique || DNEC')

@section('contenu')
<div class="container my-5">
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-center mb-0">Ajouter une Année</h1>

            </div>

            <form action="{{ route('years.store') }}" method="POST" class="shadow p-4 rounded bg-light">
                @csrf
                <div class="form-group mb-3">
                    <label for="year" class="form-label">Année</label>
                    <input type="number" name="year" id="year" class="form-control" required placeholder="Entrez l'année">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('years.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
