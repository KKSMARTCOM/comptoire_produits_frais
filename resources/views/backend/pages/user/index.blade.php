@extends('backend.layout.app') <!-- Assurez-vous que ce layout existe -->

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des utilisateurs</h4>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                        <p class="card-description">
                            <a href="{{ route('panel.user.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
                        </p>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th>Avatar</th>
                                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($users) && $users->isNotEmpty())
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->hasRole('superadmin'))
                                                    Super Administrateur
                                                @elseif($user->hasRole('admin'))
                                                    Administrateur
                                                @elseif($user->hasRole('utilisateur'))
                                                    Utilisateur
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->status == '1')
                                                    <div class="badge badge-success">Actif</div>
                                                @else
                                                    <div class="badge badge-danger">Inactif</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->avatar)
                                                    <img src="{{ asset($user->avatar) }}" alt="Avatar" width="50">
                                                @else
                                                    <img src="{{ asset('images/profiles/default.png') }}"
                                                        alt="Default Avatar" width="50">
                                                @endif
                                            </td>

                                            <td>
                                                @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                                                    <a href="{{ route('panel.user.edit', $user->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-edit"></i> <!-- Icône d'édition -->
                                                    </a>
                                                    <form action="{{ route('panel.user.destroy', $user->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i> <!-- Icône de suppression -->
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Aucun utilisateur trouvé</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @if ($users)
                            <div class="mt-3 d-flex justify-content-end">
                                {{ $users->links('pagination::custom') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endsection
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
