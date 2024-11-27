<!DOCTYPE html>
<html lang="fr">
<head>
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
        <!-- Sidebar -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile border-bottom">
                    <a href="#" class="nav-link flex-column">
                        <div class="nav-profile-image">
                            <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/default-avatar.jpg') }}" alt="profile" class="img-fluid">
                        </div>
                        <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                            <span class="fw-semibold mb-1 mt-2 text-center">{{ auth()->user()->name }}</span>
                        </div>
                    </a>
                </li>

                <!-- Navigation Links -->
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link d-block" href="{{ route('dashboard.dashboard') }}">
                        <div class="small fw-light pt-1">Administrateur DNEC</div>
                    </a>
                    <form class="d-flex align-items-center" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 mdi mdi-magnify"></span>
                            </div>
                            <input type="text" class="form-control border-0" placeholder="Search">
                        </div>
                    </form>
                </li>

                <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard.dashboard') }}">
                        <i class="mdi mdi-view-dashboard menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('years*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('years.index') }}">
                        <i class="mdi mdi-calendar-range menu-icon"></i>
                        <span class="menu-title">Années</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dashboard/inscrit*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard.inscrit') }}">
                        <i class="mdi mdi-checkbox-marked-circle menu-icon"></i>
                        <span class="menu-title">Validation</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('dioceses*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dioceses.view') }}">
                        <i class="mdi mdi-map-outline menu-icon"></i>
                        <span class="menu-title">Diocèses</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('ecoles*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ecoles.view') }}">
                        <i class="mdi mdi-school menu-icon"></i>
                        <span class="menu-title">Écoles</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('acceuils*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('acceuils') }}">
                        <i class="mdi mdi-account-circle menu-icon"></i>
                        <span class="menu-title">Profil</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Navbar -->
        <div class="container-fluid page-body-wrapper">
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-chevron-double-left"></span>
                    </button>
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard.dashboard') }}">
                            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
                        </a>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item ms-3">
                            <a class="nav-link text-white fw-bold" href="{{ route('dashboard.dashboard') }}">
                                <i class="bi bi-house-door me-2"></i> DNEC
                            </a>
                        </li>
                        <li class="nav-item dropdown" id="inscriptionNotification" style="display: none;">
                            <a class="nav-link" id="inscriptionDropdown" href="{{ route('dashboard.inscrit') }}" aria-expanded="false">
                                <i class="mdi mdi-account-plus"></i>
                                <span class="badge bg-danger" id="notificationCount">{{ $countInscrits ?? 0 }}</span>
                            </a>
                        </li>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let userCount = {{ $countInscrits ?? 0 }};
                                let userIsAdmin = true;
                                if (userCount > 0 && userIsAdmin) {
                                    document.getElementById('inscriptionNotification').style.display = 'block';
                                    document.getElementById('notificationCount').textContent = userCount;
                                }
                            });
                        </script>
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
                                <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/default-avatar.jpg') }}" alt="profile" class="img-fluid rounded-circle" style="width: 40px; height: 40px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('acceuils') }}">
                                    <i class="mdi mdi-account-circle"></i> Mon Profil
                                </a>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout"></i> Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container" style="margin-top: 90px;">
                @yield('contenu')
            </div>

        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>
</html>
