<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/create-admin', function () {
    $admin = User::create([
        'username' => 'admin',
        'password' => Hash::make('12345678'),
        'is_admin' => 12,
    ]);

    return "Admin créé avec succès : " . $admin->username;
});

// Authentification
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard accessible uniquement aux utilisateurs connectés
Route::middleware('auth')->get('/', [MessageController::class, 'dashboard'])->name('dashboard');

// Profil public : affichage et envoi de message anonyme
Route::get('/@{username}', [PublicProfileController::class, 'show'])->name('public.profile');
Route::post('/@{username}/send', [PublicProfileController::class, 'send'])->name('public.message.send');


    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
