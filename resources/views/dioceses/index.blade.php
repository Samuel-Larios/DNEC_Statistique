@extends('base')

@section('titre', 'Dioceses || DNEC')

@section('contenu')
<div class="container">
    <!-- Bouton pour ajouter une année -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('dioceses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus" style="font-size: 0.8em;"></i> Ajouter un dioceses
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Liste des dioceses</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> ID </th>
                    <th> Nom </th>
                    <th> Actions </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($dioceses as $diocese)
                        <tr>
                            <td class="py-1">
                                {{ $diocese->id }}
                            </td>
                            <td>
                                {{ $diocese->nom }}
                            </td>
                            <td>
                                <a href="{{ route('dioceses.edit', $diocese->id) }}" class="btn btn-primary">Modifier</a>
                                <form action="{{ route('dioceses.destroy', $diocese->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce diocèse ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                  @endforeach
                </tbody>
              </table>

            <!-- Ajoutez ceci pour afficher les liens de pagination -->
            <div class="d-flex justify-content-center">
                {{ $dioceses->links() }}
            </div>
            </div>
          </div>
        </div>
      </div>

</div>

@endsection
