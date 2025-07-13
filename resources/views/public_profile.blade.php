@extends('layouts.app')

@section('title', '@' . $user->username . ' - Envoyer un message')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <h3 class="mb-4 text-center">Envoyer un message anonyme à <span class="text-primary">{{ $user->username }}</span></h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/@' . $user->username . '/send') }}">
            @csrf
            <div class="mb-3">
                <textarea name="body" rows="5" class="form-control @error('body') is-invalid @enderror" placeholder="Ton message ici..." required>{{ old('body') }}</textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Envoyer anonymement</button>
        </form>
    </div>
</div>
@endsection
