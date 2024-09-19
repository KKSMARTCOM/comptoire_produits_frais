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
                            <label for="name">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nom d'utilisateur">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Mot de passe">
                        </div>

                        <div class="form-group">
                            <label for="is_admin">Rôle</label>
                            <select class="form-control @error('is_admin') is-invalid @enderror" required id="is_admin"
                                name="is_admin">
                                <option value="0" {{ old('is_admin') == 0 ? 'selected' : '' }}>Administrateur</option>
                                <option value="1" {{ old('is_admin') == 1 ? 'selected' : '' }}>Utilisateur</option>
                            </select>
                            @error('is_admin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                        <a href="{{ route('panel.user.index') }}" class="btn btn-light">Fermer</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
