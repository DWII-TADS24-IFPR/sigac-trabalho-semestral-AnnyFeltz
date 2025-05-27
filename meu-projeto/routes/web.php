<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\http\Controllers\CursoController;
use App\http\Controllers\EixoController;
use App\http\Controllers\TurmaController;
use App\http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\http\Controllers\NivelController;
use App\http\Controllers\DeclaracaoController;
use App\http\Controllers\SolicitacaoController;
use App\http\Controllers\GraficoController;
use App\http\Controllers\DashboardController;
use App\Http\Controllers\DocumentoController;
use App\Models\Documento;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('isAluno')->group(function () {
        Route::get('/meu-perfil', [AlunoController::class, 'show'])->name('aluno.perfil');
        Route::post('/meu-perfil', [AlunoController::class, 'update'])->name('aluno.perfil.atualizar');
        Route::get('/alunos/show/{id}', [AlunoController::class, 'show'])->name('alunos.show');

        Route::get('/declaracoes', [DeclaracaoController::class, 'index'])->name('declaracoes.index');
        Route::post('/declaracoes/gerar', [DeclaracaoController::class, 'gerar'])->name('declaracoes.gerar');
    });

    Route::middleware('isAdmin')->group(function () {

        Route::get('/home', function () {
            return view('home');
        });

        Route::resource('alunos', AlunoController::class);
        Route::resource('cursos', CursoController::class);
        Route::resource('eixos', EixoController::class);
        Route::resource('turmas', TurmaController::class);
        Route::resource('categorias', CategoriaController::class);
        Route::resource('nivels', NivelController::class);
        Route::resource('comprovantes', ComprovanteController::class);
        Route::resource('documentos', DocumentoController::class);
        Route::resource('declaracoes', DeclaracaoController::class);
    });
});
