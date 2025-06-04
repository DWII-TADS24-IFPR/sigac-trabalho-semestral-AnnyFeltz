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
use App\Http\Controllers\RelatorioHorasController;
use App\Http\Controllers\SolicitacaoController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    // Rotas comuns para todos usuários autenticados
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas para ADMIN (sem prefixo, direto /declaracoes etc)
    Route::middleware('isAdmin')->group(function () {

        Route::get('/home', function () {
            return view('home');
        })->name('home');

        Route::resource('alunos', AlunoController::class);
        Route::resource('cursos', CursoController::class);
        Route::resource('eixos', EixoController::class);
        Route::resource('turmas', TurmaController::class);
        Route::resource('categorias', CategoriaController::class);
        Route::resource('nivels', NivelController::class);
        Route::resource('comprovantes', ComprovanteController::class);
        Route::resource('documentos', DocumentoController::class);

        Route::resource('declaracoes', DeclaracaoController::class);
        Route::get('declaracoes/{id}/pdf', [DeclaracaoController::class, 'gerarPdf'])->name('declaracoes.pdf');

        Route::get('adm/solicitacoes', [SolicitacaoController::class, 'index'])->name('adm.solicitacoes.index');
        Route::post('adm/solicitacoes/{solicitacao}/avaliar', [SolicitacaoController::class, 'avaliar'])->name('solicitacoes.avaliar');

        Route::get('relatorios/horas', [RelatorioHorasController::class, 'index'])->name('relatorios.index');
        Route::post('relatorios/horas/grafico', [RelatorioHorasController::class, 'grafico'])->name('relatorios.grafico');
        
    });

    Route::middleware('isAluno')->prefix('aluno')->name('aluno.')->group(function () {
        Route::resource('declaracoes', DeclaracaoController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
        Route::get('declaracoes/{id}/pdf', [DeclaracaoController::class, 'gerarPdf'])->name('declaracoes.pdf');
    });

    Route::middleware('isAluno')->group(function () {

        Route::get('/home_aluno', function () {
            return view('home_aluno');
        });

        Route::resource('solicitacoes', SolicitacaoController::class)->only(['index', 'create', 'store']);
    });
});
