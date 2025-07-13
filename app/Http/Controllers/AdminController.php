<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message; // adapte selon ta table messages
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalMessages = Message::count();

        // Exemple simple : compteur de visites stocké en base (table visits)
        // ou tu peux créer une table visits et incrémenter à chaque visite
        $totalVisits = DB::table('visits')->count();

        $latestUsers = User::orderBy('created_at', 'desc')->limit(5)->get();
        $latestMessages = Message::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMessages',
            'totalVisits',
            'latestUsers',
            'latestMessages'
        ));
    }
}
