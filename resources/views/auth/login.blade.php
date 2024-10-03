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
            <br>
            @if (session()->get('error'))
                <div class="alert alert-danger" style="color: red; margin-bottom:10px;">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <input id="email" type="email" class="form-control w-100 @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email">
                        @error('email')
                            <small style="color: red" class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <br>
                    <!-- Password -->
                    <div class="form-group">
                        <input id="password" type="password"
                            class="form-control w-100 @error('password') is-invalid @enderror" name="password" required
                            placeholder="Mot de passe">
                        @error('password')
                            <small style="color: red" class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password on the Same Line -->
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Se souvenir de moi') }}
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mb-3" id="connecter">
                        {{ __('Se connecter') }}
                    </button>
                </form>
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
                font-size: 22px;
            }

            .btn {
                width: 100%;
                font-size: 22px;
            }

            #email {
                width: 100%;
                font-size: 22px;
                font-family: asen pro;
            }

            #password {
                width: 100%;
                font-size: 22px;
                font-family: asen pro;
            }

            #connecter {
                background-color: #004200;
                border-radius: 10%;
                color: white;
                font-family: asen pro;
            }
        </style>
    @endsection
