<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InteracaoController;

// --- PÁGINA PRINCIPAL ---
Route::get('/', [SiteController::class, 'index'])->name('home');

// --- LOGIN MODAL ---
Route::post('/login-modal', [AuthController::class, 'loginModal'])->name('login.modal');

// --- LOGOUT ---
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- INTERAÇÕES (likes, dislikes e comentários) ---
Route::post('/like', [InteracaoController::class, 'like'])->name('like');
Route::post('/dislike', [InteracaoController::class, 'dislike'])->name('dislike');
Route::post('/comentar', [InteracaoController::class, 'comentar'])->name('comentar');

// --- INTERAGIR (se precisar de outra ação) ---
Route::post('/interagir', [InteracaoController::class, 'interagir'])->name('interagir');

// --- DASHBOARD (restrito) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- PROFILE (restrito) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- AUTENTICAÇÃO PADRÃO ---
require __DIR__.'/auth.php';
