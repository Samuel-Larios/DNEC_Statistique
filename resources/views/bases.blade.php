<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('titre')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
 <body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile border-bottom">
                    <a href="#" class="nav-link flex-column">
                        <div class="nav-profile-image my-4">
                            <!-- Vérifiez si l'utilisateur a une photo, sinon utilisez un avatar par défaut -->
                            <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/default-avatar.jpg') }}" alt="profile" class="img-fluid">
                        </div>

                        {{-- <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                            <!-- Affichez le nom de l'utilisateur -->
                            <span class="fw-semibold mb-1 mt-2 text-center">{{ auth()->user()->name }}</span>
                            <!-- Bouton pour uploader ou modifier la photo -->
                            <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" class="fw-semibold mb-1 mt-2 text-center">
                                @csrf
                                <input type="file" name="photo" accept="image/*" class="d-none" id="photoUpload">
                                <label for="photoUpload" class="btn btn-secondary btn-sm mt-2" style="width: auto;">Modifier la photo</label>
                                <button type="submit" class="btn btn-primary" style="height: 30px; display: inline-flex; align-items: center; margin-top:7px;">
                                    <i class="fa fa-check"></i><!-- Icône de validation -->
                                </button>
                            </form>
                        </div> --}}
                    </a>
                </li>

                <li class="nav-item pt-3 {{ request()->routeIs('utilisateurs') && request()->path() == 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link d-block" href="{{ route('utilisateurs') }}">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title small fw-light pt-1">{{ Auth::user()->name }}</span>
                    </a>
                    {{-- <form class="d-flex align-items-center mt-2" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control border-0" placeholder="Search">
                        </div>
                    </form> --}}
                </li>

                <li class="nav-item {{ request()->routeIs('utilisateurs') && request()->path() == 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('utilisateurs') }}">
                        <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('personnels*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('personnels.index') }}">
                        <i class="mdi mdi-chart-areaspline menu-icon"></i>
                        <span class="menu-title">Statistique</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('performances*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('performances.index') }}">
                        <i class="mdi mdi-poll menu-icon"></i>
                        <span class="menu-title">Performances</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('examens*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('examens.index') }}">
                        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                        <span class="menu-title">Examens</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('acceuil*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('acceuil') }}">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Profil</span>
                    </a>
                </li>



            </ul>

        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_navbar.html -->
          <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
              <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-chevron-double-left"></span>
              </button>
              <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="{{ route('utilisateurs') }}"><img src="../../../assets/images/logo-mini.svg" alt="logo" /></a>
              </div>
              <ul class="navbar-nav">



                <li class="nav-item ms-3">
                    <a class="nav-link text-white fw-bold" href="{{ route('utilisateurs') }}">
                        <i class="bi bi-house-door me-2"></i> DNEC
                    </a>
                </li>

              </ul>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-logout d-none d-md-block me-3">
                    <a class="nav-link" href="#">
                        @if(session('last_login_time'))
                            Heure de connexion: {{ \Carbon\Carbon::parse(session('last_login_time'))->format('H:i') }}
                        @else
                            Statut non disponible
                        @endif
                    </a>
                </li>


                <li class="nav-item nav-profile dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/default-avatar.jpg') }}"
                             alt="profile"
                             class="img-fluid rounded-circle"
                             style="width: 40px; height: 40px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <!-- Lien vers la page de profil utilisateur -->
                        <a class="dropdown-item" href="{{ route('acceuil') }}">
                            <i class="mdi mdi-account-circle"></i> Mon Profil
                        </a>

                        <!-- Lien pour la déconnexion -->
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout"></i> Déconnexion
                        </a>

                        <!-- Formulaire de déconnexion (invisible) -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>


              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </nav>

        <div class="container" style="margin-top: 90px;">
            @yield('contenu')
        </div>

        </div>
        <!-- page-body-wrapper ends -->
      </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js" type="text/javascript') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/proBanner.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
 </body>
</html>
