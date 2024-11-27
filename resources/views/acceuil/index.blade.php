@extends('bases')

@section('titre', 'Statistique || DNEC')

@section('contenu')
<div class="container">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10" style="margin-bottom: 100px;">
                <div class="card mt-5 shadow border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="mb-0">Informations de l'utilisateur connecté</h2>
                    </div>
                    <div class="card-body p-4 text-center">
                        <!-- Photo de profil de l'utilisateur -->
                        <div class="mb-3">
                            <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/default-avatar.jpg') }}"
                                 alt="Photo de profil"
                                 class="rounded-circle border border-primary shadow"
                                 width="150" height="150">
                        </div>

                        <!-- Formulaire de mise à jour de la photo -->
                        <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="photo" accept="image/*" class="d-none" id="photoUpload">
                            <label for="photoUpload" class="btn btn-secondary" style="margin-top: 10px;">Choisir une nouvelle photo</label>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">
                                <i class="fa fa-check"></i> Enregistrer
                            </button>
                        </form>

                        <!-- Informations de l'utilisateur -->
                        <ul class="list-group list-group-flush w-75 mt-4 mx-auto">
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Nom :</strong>
                                <span>{{ Auth::user()->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Email :</strong>
                                <span>{{ Auth::user()->email }}</span>
                            </li>
                            {{-- <li class="list-group-item d-flex justify-content-between">
                                <strong>Droit :</strong>
                                <span>{{ Auth::user()->droit }}</span>
                            </li> --}}
                        </ul>

                        <!-- Actions pour l'utilisateur -->
                        <div class="card-footer bg-light mt-4">
                            <button type="button" class="btn btn-primary me-2" onclick="window.location.href='{{ route('user.edit-info', Auth::user()->id) }}'">
                                <i class="mdi mdi-pencil"></i> Modifier les informations
                            </button>
                            <button type="button" class="btn btn-warning" onclick="window.location.href='{{ route('user.edit-password', Auth::user()->id) }}'">
                                <i class="mdi mdi-lock-reset"></i> Modifier le mot de passe
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Déclenche la soumission du formulaire lors de la sélection d'un fichier
    document.getElementById("photoUpload").addEventListener("change", function() {
        this.closest("form").submit();
    });
</script>
@endsection
