@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord Admin</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text fs-3">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Messages</h5>
                    <p class="card-text fs-3">{{ $totalMessages }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Visites</h5>
                    <p class="card-text fs-3">{{ $totalVisits }}</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Derniers utilisateurs inscrits</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Inscrit le</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($latestUsers as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email ?? '—' }}</td>
                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Derniers messages</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($latestMessages as $msg)
            <tr>
                <td>{{ $msg->user->username ?? '—' }}</td>
                <td>{{ Str::limit($msg->body, 250) }}</td>
                <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
