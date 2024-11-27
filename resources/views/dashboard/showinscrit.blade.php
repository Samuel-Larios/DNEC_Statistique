<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $utilisateur->name }} ||DNEC</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <style>
        .user-details {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            margin: 40px auto;
        }
        .user-details h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 20px;
        }
        .user-details img {
            border-radius: 50%;
            margin-bottom: 20px;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .user-details p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }
        .user-details .btn-group, .actions .btn-group {
            margin-top: 20px;
        }
        .user-details .btn, .actions .btn {
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .btn-user {
            background-color: #007bff;
            color: white;
        }
        .btn-admin {
            background-color: #28a745;
            color: white;
        }
        .btn i {
            margin-right: 5px;
        }
        .actions {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            margin: 20px auto;
        }
        .btn-edit-info {
            background-color: #17a2b8;
            color: white;
        }
        .btn-edit-password {
            background-color: #ffc107;
            color: white;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="container">
                <div class="user-details">
                    <h1>Détails de l'utilisateur</h1>
                    <img src="{{ $utilisateur->photo ? asset('storage/' . $utilisateur->photo) : asset('assets/images/default-avatar.jpg') }}" alt="profile">
                    <p><strong>Nom:</strong> {{ $utilisateur->name }}</p>
                    <p><strong>Email:</strong> {{ $utilisateur->email }}</p>

                    <div class="btn-group">
                        <!-- Bouton de suppression avec confirmation -->
                        <button class="btn btn-delete" onclick="confirmDelete({{ $utilisateur->id }})">
                            <i class="mdi mdi-delete"></i> Supprimer
                        </button>

                        <!-- Bouton pour modifier le droit en 'user' -->
                        <button class="btn btn-user" onclick="changeRoleToUser({{ $utilisateur->id }})">
                            <i class="mdi mdi-account"></i> Utilisateur
                        </button>

                        <!-- Bouton pour modifier le droit en 'admin' -->
                        <button class="btn btn-admin" onclick="changeRoleToAdmin({{ $utilisateur->id }}, 'admin')">
                            <i class="mdi mdi-account-key"></i> Admin
                        </button>
                    </div>
                </div>

                <div class="actions">
                    <div class="btn-group">
                        <button class="btn btn-edit-info" onclick="window.location.href='{{ route('user.edit-info', $utilisateur->id) }}'">
                            <i class="mdi mdi-pencil"></i> Modifier les informations
                        </button>
                        <button class="btn btn-edit-password" onclick="window.location.href='{{ route('user.edit-password', $utilisateur->id) }}'">
                            <i class="mdi mdi-lock-reset"></i> Modifier le mot de passe
                        </button>
                        <a href="{{ route('dashboard.inscrit') }}" class="btn btn-back">
                            <i class="mdi mdi-arrow-left"></i> Revenir
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <!-- endinject -->

    <!-- JavaScript pour gérer les confirmations et les requêtes -->
    <script>
        function confirmDelete(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                window.location.href = '/delete-user/' + userId;
            }
        }

        function changeRoleToAdmin(userId, role) {
            if (confirm('Êtes-vous sûr de vouloir changer le droit en ' + role + ' ?')) {
                window.location.href = '/change-role/' + userId + '/' + role;
            }
        }
    </script>

    <script>
        function changeRoleToAdmin(userId) {
            if (confirm('Êtes-vous sûr de vouloir changer le droit en utilisateur ?')) {
                window.location.href = '/change-role-user/' + userId;
            }
        }
    </script>


    <script>
        function changeRoleToUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir changer le droit en utilisateur ?')) {
                window.location.href = '/change-role-user/' + userId;
            }
        }
    </script>
</body>
</html>
