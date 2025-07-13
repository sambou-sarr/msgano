@extends('layouts.app')

@section('title', 'Connexion - AnonMsg')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <h2 class="mb-4 text-center">Se connecter</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus class="form-control @error('username') is-invalid @enderror">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" type="password" name="password" required class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100">Se connecter</button>
        </form>

        <p class="mt-3 text-center">
            Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a>
        </p>
    </div>
</div>
@endsection
