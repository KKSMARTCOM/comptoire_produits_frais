@extends('layouts.app')

@section('content')
<!-- Modal Trigger -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resetPasswordModal">
    {{ __('Réinitialiser le mot de passe') }}
</button>

<!-- Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <div class="modal-body">
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row mb-4">
                        <label for="email" class="col-md-4 col-form-label text-md-end font-weight-bold">{{ __('Adresse e-mail') }}</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrez votre adresse e-mail">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0 justify-content-center">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary btn-block py-2">
                                {{ __('Envoyer le lien de réinitialisation') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .modal-header {
        background-color: #007bff;
        border-bottom: none;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .form-control {
        padding: 10px;
        font-size: 1rem;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 25px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection
