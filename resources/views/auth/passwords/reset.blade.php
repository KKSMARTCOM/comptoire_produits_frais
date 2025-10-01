@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="card p-4">
        <!-- Centered Logo and Title -->
        <a class="navbar-brand d-flex flex-column align-items-center justify-content-center mb-4" href="{{ url('/') }}">
            <!-- Logo -->
            <img src="{{ asset('backend/images/logo.svg') }}" alt="Logo" style="height: 50px;">
            <!-- Application Title -->
            <span class="mt-2 app-title">{{ config('COMPTOIR DES PRODUITS FRAIS') }}</span>
        </a>

        <div class="card-header text-center">{{ __('CONNEXION') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email and Password aligned vertically -->
                <div class="form-group mb-4">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control input-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    <input id="password" type="password" class="form-control input-field @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Se souvenir de moi') }}
                    </label>
                </div>

                <!-- Forgot Password -->
                <div class="form-group mb-3">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-custom">
                        {{ __('Se connecter') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles to enhance the login form -->
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
    }
    .card {
        width: 100%;
        max-width: 450px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .navbar-brand {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .app-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }
    .input-field {
        border-radius: 5px;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
    }
    .input-field:focus {
        border-color: #28a745;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
    }
    .btn-custom {
        width: 150px;
        font-size: 1rem;
        padding: 10px;
        background-color: #28a745;
        border: none;
        border-radius: 25px;
        color: #fff;
        transition: background-color 0.3s;
    }
    .btn-custom:hover {
        background-color: #218838;
    }
    .form-label {
        font-weight: bold;
        color: #555;
    }
    .form-check-label {
        font-size: 0.9rem;
        color: #555;
    }
</style>
@endsection
