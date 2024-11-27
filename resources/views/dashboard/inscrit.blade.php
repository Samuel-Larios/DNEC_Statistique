@extends('base')

@section('titre', 'Statistique || DNEC')

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <!-- Tableau des inscrits -->
        <div class="col-lg-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Les inscrits</h4>
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
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    {{-- <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr> --}}
                  </thead>
                  <tbody>
                    @foreach($inscrits as $utilisateur)
                        <tr>
                            <td>{{ $utilisateur->name }}</td>
                            {{-- <td>{{ $utilisateur->email }}</td> --}}
                            <td>
                                <a href="{{ route('dashboard.showinscrit', $utilisateur->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <!-- Pagination pour les inscrits -->
              <div class="d-flex justify-content-center">
                {{ $inscrits->links() }}
              </div>
            </div>
          </div>
        </div>

        <!-- Tableau des administrateurs -->
        <div class="col-lg-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Les administrateurs</h4>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    {{-- <tr>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr> --}}
                  </thead>
                  <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td class="py-1">
                                <img src="{{ $admin->photo ? asset('storage/' . $admin->photo) : asset('assets/images/default-avatar.jpg') }}" alt="profile" class="img-fluid">
                            </td>
                            <td>{{ $admin->name }}</td>
                            {{-- <td>{{ $admin->email }}</td> --}}
                            <td>
                                <a href="{{ route('dashboard.showinscrit', $admin->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <!-- Pagination pour les administrateurs -->
              <div class="d-flex justify-content-center">
                {{ $admins->links() }}
              </div>
            </div>
          </div>
        </div>

        <!-- Tableau des utilisateurs avec droit 'user' -->
        <div class="col-lg-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Les utilisateurs</h4>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    {{-- <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr> --}}
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="py-1">
                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/default-avatar.jpg') }}" alt="profile" class="img-fluid">
                            </td>
                            <td>{{ $user->name }}</td>
                            {{-- <td>{{ $user->email }}</td> --}}
                            <td>
                                <a href="{{ route('dashboard.showinscrit', $user->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <!-- Pagination pour les utilisateurs -->
              <div class="d-flex justify-content-center">
                {{ $users->links() }}
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
