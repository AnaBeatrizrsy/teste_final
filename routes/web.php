<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InteracaoController;

// --- MEU ---

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::post('/login-modal', [AuthController::class, 'loginModal'])->name('login.modal');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('/like', [InteracaoController::class, 'like'])->name('like');
Route::post('/dislike', [InteracaoController::class, 'dislike'])->name('dislike');
Route::post('/comentar', [InteracaoController::class, 'comentar'])->name('comentar');




// --- DASHBOARD ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
