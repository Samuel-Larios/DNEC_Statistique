@extends('base')

@section('titre', 'Dioceses || DNEC')

@section('contenu')
<div class="container">
    <h1>Modifier Diocèse</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dioceses.update', $diocese->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du Diocèse</label>
            <input type="text" name="nom" class="form-control" value="{{ $diocese->nom }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('dioceses.view') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
