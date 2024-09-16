@extends('backend.layout.app') <!-- Assurez-vous que ce layout existe -->

@section('content')
    <h1>Liste des utilisateurs</h1>
    <a href="{{ route('panel.user.create') }}" class="btn btn-primary">Créer un utilisateur</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($users) && $users->isNotEmpty())
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->hasRole('superadmin'))
                                Super Administrateur
                            @elseif($user->hasRole('admin'))
                                Administrateur
                            @else
                                Utilisateur
                            @endif
                        </td>
                        <td>
                            @if ($user->hasRole('admin'))
                                <a href="{{ route('panel.user.edit', $user->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> <!-- Icône d'édition -->
                                </a>
                                <form action="{{ route('panel.user.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
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
                    <td colspan="5">Aucun utilisateur trouvé</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
