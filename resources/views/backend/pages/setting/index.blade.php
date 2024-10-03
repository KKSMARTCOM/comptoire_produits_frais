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
                    <h4 class="card-title">Modifier profil</h4>

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif --}}

                    @if (session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <form class="forms-sample" action="{{ route('panel.setting.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Utilisé pour les mises à jour -->

                        @if (Auth()->user()->avatar)
                            <div style="display: flex;justify-content:center">
                                <div style="width: 200px;height:250px;overflow:hidden">
                                    <img src="{{ asset(Auth()->user()->avatar) }}" alt="Profile Image"
                                        style="height: 100%;width:100%;object-fit:cover">
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                name="name" placeholder="Nom d'utilisateur">
                            @error('name')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                name="email" placeholder="Email">
                            @error('email')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe actuel</label>
                            <input type="password" class="form-control" id="password" name="old_password"
                                placeholder="Veuillez entrer votre mot de passe actuel">
                            @error('old_password')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Veuillez entrer votre nouveau mot de passe">
                            @error('password')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Confirmer nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password_confirmation"
                                placeholder="Veuillez confirmer votre nouveau mot de passe">
                            @error('password_confirmation')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Photo de profil</label>
                            <input type="file" name="avatar" class="file-upload-default" id="imageInput"
                                style="display:none;">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="imagePlaceholder"
                                    placeholder="Télécharger une photo de profil" readonly>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button"
                                        style="background-color: #004200 !important">Télécharger</button>
                                </span>
                            </div>
                            @error('avatar')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Modifier</button>
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
