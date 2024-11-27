@extends('base')

@section('titre', 'Modifier École || DNEC')

@section('contenu')

<h1>Modifier l'école</h1>

<form action="{{ route('ecoles.update', $ecole->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Utilisez PUT pour la mise à jour -->

    <div class="form-group">
        <label for="nom">Nom de l'école</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $ecole->nom) }}" required>
    </div>

    <div class="form-group">
        <label for="diocese_id">Diocèse</label>
        <select name="diocese_id" id="diocese_id" class="form-control" required>
            @foreach($dioceses as $diocese)
                <option value="{{ $diocese->id }}" {{ $diocese->id == $ecole->diocese_id ? 'selected' : '' }}>
                    {{ $diocese->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>

@endsection
