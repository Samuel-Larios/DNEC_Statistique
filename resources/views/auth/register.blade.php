<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>S'inscrire || DNEC</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <style>
        .toggle-password {
            background: none;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #6c757d; /* Couleur par défaut */
        }

        .toggle-password:hover {
            color: #007bff; /* Couleur au survol */
        }

        .button-container {
            display: flex;
            justify-content: space-between; /* Espace entre les boutons */
            margin-top: 15px; /* Espace au-dessus des boutons */
        }

        .btn-common {
            flex: 1; /* Rendre les boutons de la même taille */
            margin-right: 10px; /* Espace entre les boutons */
        }

        .btn-common:last-child {
            margin-right: 0; /* Pas de marge à droite pour le dernier bouton */
        }

        .btn-return {
            background-color: #007bff; /* Couleur du bouton de retour */
            color: #fff; /* Couleur du texte */
        }

        .btn-return:hover {
            background-color: #0056b3; /* Couleur au survol */
        }

        .btn-primary {
            background-color: #28a745; /* Couleur du bouton d'inscription */
            color: #fff; /* Couleur du texte */
        }

        .btn-primary:hover {
            background-color: #218838; /* Couleur au survol */
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/logo.svg') }}">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="fw-light">Sign in to continue.</h6>
                            <!-- Formulaire d'inscription -->
                            <div class="container">
                                <h2>Inscription</h2>
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <form action="{{ route('register.post') }}" method="POST">

                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <button type="button" class="toggle-password" id="togglePassword">
                                            <i class="mdi mdi-eye-off"></i>
                                        </button>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="password_confirmation">Confirmez le mot de passe</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                        <button type="button" class="toggle-password" id="togglePasswordConfirmation">
                                            <i class="mdi mdi-eye-off"></i>
                                        </button>
                                    </div>



                                    <div class="form-group">
                                        <label for="ecole">École</label>
                                        <select class="form-control" id="ecole" name="ecole" required>
                                            <option value="">Sélectionnez une école</option>
                                            @foreach($ecoles as $ecole)
                                                <option value="{{ $ecole->id }}" {{ old('ecole') == $ecole->id ? 'selected' : '' }}>
                                                    {{ $ecole->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ecole')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- Champ droit masqué avec valeur par défaut "inscrire" -->
                                    <input type="hidden" name="droit" value="inscrire">

                                    <div class="button-container">
                                        <button type="submit" class="btn btn-primary btn-common">S'inscrire</button>
                                        <a href="{{ route('login') }}" class="btn btn-return btn-common">Retour à la connexion</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <!-- endinject -->
    <script>
        // Script pour afficher/masquer le mot de passe
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const passwordConfirmation = document.getElementById('password_confirmation');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('mdi-eye');
            this.querySelector('i').classList.toggle('mdi-eye-off');
        });

        togglePasswordConfirmation.addEventListener('click', function () {
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);
            this.querySelector('i').classList.toggle('mdi-eye');
            this.querySelector('i').classList.toggle('mdi-eye-off');
        });
    </script>

</body>
</html>
