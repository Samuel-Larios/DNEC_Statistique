@extends('bases')

@section('titre', 'Modifier la Performance || DNEC')

@section('contenu')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h1 class="text-center mb-4">Modifier la Performance</h1>

        <!-- Affichage des erreurs générales -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('performances.update', $performance) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="classe" class="form-label">Classe :</label>
                    <input type="text" name="classe" class="form-control" value="{{ old('classe', $performance->classe) }}" required>
                    @error('classe')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="eleveInscrit" class="form-label">Élèves Inscrits :</label>
                    <input type="number" name="eleveInscrit" class="form-control" value="{{ old('eleveInscrit', $performance->eleveInscrit) }}" required>
                    @error('eleveInscrit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbreFille" class="form-label">Nombre de Filles :</label>
                    <input type="number" name="nbreFille" class="form-control" value="{{ old('nbreFille', $performance->nbreFille) }}" required>
                    @error('nbreFille')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nbreGarcon" class="form-label">Nombre de Garçons :</label>
                    <input type="number" name="nbreGarcon" class="form-control" value="{{ old('nbreGarcon', $performance->nbreGarcon) }}" required>
                    @error('nbreGarcon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbreMoyenne" class="form-label">Nombre de Moyennes :</label>
                    <input type="number" name="nbreMoyenne" class="form-control" value="{{ old('nbreMoyenne', $performance->nbreMoyenne) }}" required>
                    @error('nbreMoyenne')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nbreMfille" class="form-label">Nombre de Moyennes Filles :</label>
                    <input type="number" name="nbreMfille" class="form-control" value="{{ old('nbreMfille', $performance->nbreMfille) }}" required>
                    @error('nbreMfille')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nbreMgarcon" class="form-label">Nombre de Moyennes Garçons :</label>
                    <input type="number" name="nbreMgarcon" class="form-control" value="{{ old('nbreMgarcon', $performance->nbreMgarcon) }}" required>
                    @error('nbreMgarcon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nbreAbandon" class="form-label">Nombre d'Abandons :</label>
                    <input type="number" name="nbreAbandon" class="form-control" value="{{ old('nbreAbandon', $performance->nbreAbandon) }}" required>
                    @error('nbreAbandon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="annee_id" class="form-label">Année :</label>
                    <select name="annee_id" class="form-control" required>
                        <option value="">Sélectionnez une année</option>
                        @foreach($annees as $annee)
                            <option value="{{ $annee->id }}" {{ old('annee_id', $performance->annee_id) == $annee->id ? 'selected' : '' }}>
                                {{ $annee->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('annee_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Enregistrer</button>
                <a href="{{ route('performances.index') }}" class="btn btn-secondary btn-lg ms-3"><i class="fas fa-arrow-left"></i> Retour</a>
            </div>
        </form>
    </div>
</div>
@endsection
