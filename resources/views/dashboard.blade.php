@extends('layouts.app')

@section('title', 'Dashboard - AnonMsg')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <h3 class="mb-4">📥 Tes messages reçus</h3>

        @if($messages->isEmpty())
            <div class="alert alert-info text-center">Tu n'as encore reçu aucun message.</div>
        @else
            @foreach($messages as $message)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <p class="mb-2">{{ $message->body }}</p>
                        <small class="text-muted float-end">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @endforeach
        @endif

<div class="mt-4 text-center">
    <h6 class="text-muted">🔗 Ton lien à partager :</h6>
    <div class="alert alert-secondary" id="copyLink" style="cursor: pointer;">
        <strong>{{ url('/@' . auth()->user()->username) }}</strong>
    </div>
    <small id="copyMsg" style="display:none; color:green;">Lien copié ! ✅</small>
</div>

<script>
    document.getElementById('copyLink').addEventListener('click', function() {
        const linkText = this.innerText;
        navigator.clipboard.writeText(linkText).then(() => {
            const msg = document.getElementById('copyMsg');
            msg.style.display = 'inline';
            setTimeout(() => {
                msg.style.display = 'none';
            }, 2000);
        }).catch(err => {
            alert('Erreur lors de la copie : ' + err);
        });
    });
</script>

    </div>
</div>
@endsection
