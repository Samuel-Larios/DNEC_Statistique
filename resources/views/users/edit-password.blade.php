<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le mot de passe</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .toggle-password {
            background: none;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .toggle-password:hover {
            color: #007bff;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .btn-common {
            flex: 1;
            margin-right: 10px;
        }
        .btn-common:last-child {
            margin-right: 0;
        }
        .btn-primary {
            background-color: #28a745;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #007bff;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <h4>Modifier le mot de passe</h4>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('user.update-password', $user->id) }}" method="POST">
                            @csrf
                            <div class="form-group position-relative">
                                <label for="password">Nouveau mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button type="button" class="toggle-password" id="togglePassword">
                                    <i class="mdi mdi-eye-off"></i>
                                </button>
                            </div>
                            <div class="form-group position-relative">
                                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                <button type="button" class="toggle-password" id="togglePasswordConfirmation">
                                    <i class="mdi mdi-eye-off"></i>
                                </button>
                            </div>
                            <div class="button-container">
                                <button type="submit" class="btn btn-primary btn-common">Mettre à jour le mot de passe</button>
                                {{-- <a href="{{ route('dashboard.inscrit') }}" class="btn btn-secondary btn-common">Annuler</a> --}}
                                <a href="javascript:void(0);" class="btn btn-secondary btn-common" onclick="window.history.back();">Annuler</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
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
