@extends('backend.layout.app')

@section('customcss')
    <style>
        .ck-content {
            height: 300px !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($user) ? 'Modifier l\'utilisateur' : 'Ajouter un utilisateur' }}</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <form class="forms-sample" action="{{ route('panel.user.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @if (isset($user))
                            @method('PUT') <!-- Utilisé pour les mises à jour -->
                        @endif

                        @if ($user->avatar)
                            <div style="display: flex;justify-content:center">
                                <div style="width: 200px;height:250px;overflow:hidden">
                                    <img src="{{ asset($user->avatar) }}" alt="Profile Image"
                                        style="height: 100%;width:100%;object-fit:cover">
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name ?? '' }}"
                                name="name" placeholder="Nom d'utilisateur" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email ?? '' }}"
                                name="email" placeholder="Email" readonly>
                        </div>

                        <div class="form-group">
                            <label for="is_admin">Rôle</label>
                            <select class="form-control" id="is_admin" name="is_admin">
                                <option value="0" {{ isset($user) && $user->is_admin == 0 ? 'selected' : '' }}>
                                    Administrateur
                                </option>
                                <option value="1" {{ isset($user) && $user->is_admin == 1 ? 'selected' : '' }}>
                                    Utilisateur</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ isset($user) && $user->status == '1' ? 'selected' : '' }}>
                                    Actif
                                </option>
                                <option value="0" {{ isset($user) && $user->status == '0' ? 'selected' : '' }}>
                                    Inactif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Mettre à jour</button>
                        <a href="{{ route('panel.user.index') }}" class="btn btn-light">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), option)
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
