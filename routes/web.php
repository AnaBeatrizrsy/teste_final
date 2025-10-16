<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ContatoAlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaAlunoController;
use App\Http\Controllers\Turmacontroller;
use App\Http\Controllers\ContatoProfessorcontroller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('aluno', AlunoController::class);
    Route::resource('professor', ProfessorController::class);
    Route::resource('contatoaluno', ContatoAlunoController::class);
    Route::resource('curso', CursoController::class);
    Route::resource('turmaaluno', TurmaAlunoController::class);
    Route::resource('turma', TurmaController::class);
    Route::resource('contato_professor', ContatoProfessorController::class);
});


/*Route::get('contato/aluno', [AlunoController::class, 'contato']);


Route::get('contato/professor', [ProfessorController::class, 'contato']);


Route::get('contato/contatoaluno', [ContatoAlunoController::class, 'contato']);


Route::get('contato/curso', [CursoController::class, 'contato']);


Route::get('contato/turmaaluno', [TurmaAlunoController::class, 'contato']);


Route::get('contato/turma', [TurmaController::class, 'contato']);


Route::get('contato/contato_professor', [ContatoProfessorController::class, 'contato']);*/


require __DIR__.'/auth.php';
