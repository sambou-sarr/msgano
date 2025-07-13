<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PublicProfileController extends Controller
{
    // Afficher la page publique avec le formulaire d'envoi
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        DB::table('visits')->insert([
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('public_profile', compact('user'));
    }

    // Recevoir et enregistrer un message anonyme
    public function send(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $message = new Message();
        $message->user_id = $user->id;
        $message->body = $request->input('body');
        $message->sender_ip = $request->ip();
        $message->sender_agent = $request->header('User-Agent');

        // Géolocalisation via IP (optionnel)
        $response = Http::get("http://ip-api.com/json/{$message->sender_ip}");
        if ($response->successful() && $response['status'] === 'success') {
            $message->sender_location = trim("{$response['city']}, {$response['country']}", ', ');
        }

        $message->save();

        return redirect()->back()->with('success', 'Message envoyé anonymement.');
    }
}
