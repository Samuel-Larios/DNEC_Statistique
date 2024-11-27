@extends('base')

@section('titre', 'Créer un Diocèse || DNEC')

@section('contenu')
<div class="container">
    <h1>Créer un Nouveau Diocèse</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dioceses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du Diocèse</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom du diocèse" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Créer</button>
        <a href="{{ route('dioceses.view') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection
