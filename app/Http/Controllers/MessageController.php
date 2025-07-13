<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class MessageController extends Controller
{
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $messages = $user->messages()->latest()->get();
        return view('dashboard', compact('messages'));
    }
    public function sendMessage(Request $request, $username)
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

    // Exemple de géolocalisation IP via API externe
    $response = Http::get("http://ip-api.com/json/{$message->sender_ip}");
    if ($response->successful() && $response['status'] === 'success') {
        $message->sender_location = trim("{$response['city']}, {$response['country']}", ', ');
    }

    $message->save();

    return back()->with('success', 'Message envoyé anonymement.');
}

}
