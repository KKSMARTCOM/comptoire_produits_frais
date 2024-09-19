@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="card">
            <!-- Centered Logo and Title -->
            <a class="navbar-brand d-flex flex-column align-items-center justify-content-center mb-4"
                href="{{ url('/') }}">
                <!-- Logo -->
                <img src="{{ asset('backend/images/logo.svg') }}" alt="Logo" style="height: 50px;">
                <!-- Application Title -->
                <span class="mt-2">{{ config('COMPTOIR DES PRODUITS FRAIS') }}</span>
            </a>

            @if (session('error'))
                <small style="color: red" class="alert alert-danger">
                    {{ session('error') }}
                </small>
            @endif

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <div><input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <small style="color: red" class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">{{ __('Mot de passe') }}</label>
                        <div><input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                        </div>
                        @error('password')
                            <small style="color: red" class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>

                    <!-- Forgot Password -->
                    <div class="form-group">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">
                        {{ __('Se connecter') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Styles to center and style the login form -->
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .card {
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            background-color: white;
        }

        .navbar-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn {
            width: 100%;
        }
    </style>
@endsection
