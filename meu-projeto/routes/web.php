<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EixoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\DocumentoController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('isAluno')->group(function () {
        Route::get('/meu-perfil', [AlunoController::class, 'show'])->name('aluno.perfil');
        Route::post('/meu-perfil', [AlunoController::class, 'update'])->name('aluno.perfil.atualizar');
        Route::get('/alunos/show/{id}', [AlunoController::class, 'show'])->name('alunos.show');

        Route::get('/declaracoes', [DeclaracaoController::class, 'index'])->name('declaracoes.index');
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
        Route::get('/avaliar-horas', function () {
            return view('outros.avaliar_solicitacoes');
        });
        Route::get('/gerar-graficos', function () {
            return view('outros.graficos_horas_cumpridas');
        });
        
    });

    Route::middleware('isAluno')->group(function () {

        Route::get('/home_aluno', function () {
            return view('home_aluno');
        });

        Route::get('/declarar-horas', function () {
            return view('outros.declaracao_cumprimento');
        });
        Route::get('/solicitar-horas', function () {
            return view('outros.solicitar_horas');
        });
    });
});
