@extends('bases')

@section('titre', 'Modifier École || DNEC')

@section('contenu')
<div class="container">
    <br><br><br><br>
    <div class="row">
        <h1>Ajouter un Examen</h1>

        <form action="{{ route('examens.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nom">Nom de l'examen</label>
                <select name="nom" class="form-control" required>
                    <option value="">Sélectionnez un examen</option>
                    @foreach ($examens as $examen)
                        <option value="{{ $examen }}" {{ old('nom') == $examen ? 'selected' : '' }}>
                            {{ $examen }}
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
                        <option value="{{ $serie }}" {{ old('serie') == $serie ? 'selected' : '' }}>
                            {{ $serie }}
                        </option>
                    @endforeach
                </select>
                @error('serie')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="annee_id" class="form-label">Année :</label>
                <select name="annee_id" class="form-control" required>
                    <option value="" disabled {{ old('annee_id') ? '' : 'selected' }}>Choisir une année</option>
                    @foreach ($annees as $annee)
                        <option value="{{ $annee->id }}" {{ old('annee_id') == $annee->id ? 'selected' : '' }}>{{ $annee->year }}</option>
                    @endforeach
                </select>
                @error('annee_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="ecole_id" class="form-label">École :</label>
                <input type="text" class="form-control" value="{{ $userEcole->nom ?? 'Aucune école assignée' }}" readonly>
                <input type="hidden" name="ecole_id" value="{{ $userEcole->id ?? '' }}">
                @error('ecole_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            @foreach([
                // 'total_inscrit' => 'Total Inscrits',
                'fille' => 'Filles',
                'garcon' => 'Garçons',
                // 'total_admis' => 'Total Admis',
                'fille_admis' => 'Filles Admis',
                'garcon_admis' => 'Garçons Admis',
                // 'total_passable' => 'Total Passable',
                'fille_passable' => 'Filles Passable',
                'garcon_passable' => 'Garçons Passable',
                // 'total_bien' => 'Total Bien',
                'fille_bien' => 'Filles Bien',
                'garcon_bien' => 'Garçons Bien',
                // 'total_tbien' => 'Total Très Bien',
                'fille_tbien' => 'Filles Très Bien',
                'garcon_tbien' => 'Garçons Très Bien',
                // 'total_honorable' => 'Total Honorable',
                'fille_honorable' => 'Filles Honorable',
                'garcon_honorable' => 'Garçons Honorable'
            ] as $field => $label)
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}</label>
                    <input type="number" name="{{ $field }}" class="form-control" value="{{ old($field, 0) }}" required>
                    @error($field)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Créer</button>
        </form>
    </div>
</div>
@endsection
