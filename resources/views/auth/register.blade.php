@extends('layouts.app')

@section('title', 'Inscription - AnonMsg')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <h2 class="mb-4 text-center">Créer un compte</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Pseudo</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus 
                    class="form-control @error('username') is-invalid @enderror" placeholder="Votre pseudo">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" type="password" name="password" required 
                    class="form-control @error('password') is-invalid @enderror" placeholder="Votre mot de passe">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required 
                    class="form-control" placeholder="Confirmez le mot de passe">
            </div>

            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>

        <p class="mt-3 text-center">
            Déjà un compte ? <a href="{{ route('login') }}">Connectez-vous</a>
        </p>
    </div>
</div>
@endsection
