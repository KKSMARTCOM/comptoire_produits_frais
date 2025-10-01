@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ajouter un utilisateur</h4>

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

                    <form class="forms-sample" action="{{ route('panel.user.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nom d'utilisateur</label><span style="color: red"> *</span>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Nom d'utilisateur">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label><span style="color: red"> *</span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label><span style="color: red"> *</span>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Mot de passe">
                        </div>

                        <div class="form-group">
                            <label for="is_admin">Rôle</label><span style="color: red"> *</span>
                            <select class="form-control @error('is_admin') is-invalid @enderror" required id="is_admin"
                                name="is_admin">
                                <option value="">Selectionner le rôle</option>
                                <option value="1" {{ old('is_admin') }}>Utilisateur</option>
                                <option value="0" {{ old('is_admin') }}>Administrateur</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Photo de profil</label>
                            <input type="file" name="avatar" class="file-upload-default" id="imageInput"
                                style="display:none;">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="imagePlaceholder"
                                    placeholder="Télécharger la photo de profil" readonly>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button"
                                        style="background-color: #004200 !important">Télécharger</button>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                        <a href="{{ route('panel.user.index') }}" class="btn btn-light">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
