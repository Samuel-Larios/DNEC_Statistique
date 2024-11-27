@extends('base')

@section('titre', 'Ajouter une école || DNEC')

@section('contenu')
    <div class="container my-5">
        <h1 class="display-4 mb-4">Ajouter une école</h1>

        <!-- Affichage des messages de succès ou d'erreur -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire d'ajout d'une école -->
        <form action="{{ route('ecoles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom de l'école</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="form-group mt-3">
                <label for="diocese_id">Diocèse</label>
                <select class="form-control" id="diocese_id" name="diocese_id" required>
                    <option value="">Choisir un diocèse</option>
                    @foreach($dioceses as $diocese)
                        <option value="{{ $diocese->id }}">{{ $diocese->nom }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-4">Ajouter l'école</button>
        </form>
    </div>
@endsection
