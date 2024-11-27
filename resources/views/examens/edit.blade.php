@extends('bases')

@section('titre', 'Modifier Examen || DNEC')

@section('contenu')
<div class="container">
    <br><br><br><br>
    <div class="row">
        <h1>Modifier un Examen</h1>

        <form action="{{ route('examens.update', $examen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom de l'examen</label>
                <select name="nom" class="form-control" required>
                    <option value="">Sélectionnez un examen</option>
                    @foreach ($examens as $examenOption)
                        <option value="{{ $examenOption }}" {{ old('nom', $examen->nom) == $examenOption ? 'selected' : '' }}>
                            {{ $examenOption }}
                        </option>
                    @endforeach
                </select>
                @error('nom')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="serie">Série</label>
                <select name="serie" class="form-control" required>
                    <option value="">Sélectionnez une série</option>
                    @foreach ($series as $serie)
                        <option value="{{ $serie }}" {{ old('serie', $examen->serie) == $serie ? 'selected' : '' }}>
                            {{ $serie }}
                        </option>
                    @endforeach
                </select>
                @error('serie')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <select name="annee_id" class="form-control" required>
                <option value="" disabled {{ old('annee_id', $examen->annee_id) ? '' : 'selected' }}>Choisir une année</option>
                @foreach ($annees as $annee)
                    <option value="{{ $annee->id }}" {{ old('annee_id', $examen->annee_id) == $annee->id ? 'selected' : '' }}>{{ $annee->year }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="ecole_id" class="form-label">École :</label>
                <input type="text" class="form-control" value="{{ $userEcole->nom ?? 'Aucune école assignée' }}" readonly>
                <input type="hidden" name="ecole_id" value="{{ $userEcole->id ?? '' }}">
                @error('ecole_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            @foreach([
                'fille' => 'Filles',
                'garcon' => 'Garçons',
                'fille_admis' => 'Filles Admis',
                'garcon_admis' => 'Garçons Admis',
                'fille_passable' => 'Filles Passable',
                'garcon_passable' => 'Garçons Passable',
                'fille_bien' => 'Filles Bien',
                'garcon_bien' => 'Garçons Bien',
                'fille_tbien' => 'Filles Très Bien',
                'garcon_tbien' => 'Garçons Très Bien',
                'fille_honorable' => 'Filles Honorable',
                'garcon_honorable' => 'Garçons Honorable'
            ] as $field => $label)
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}</label>
                    <input type="number" name="{{ $field }}" class="form-control" value="{{ old($field, $examen->$field) }}">
                    @error($field)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
