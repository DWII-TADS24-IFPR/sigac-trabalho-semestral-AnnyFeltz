<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Turma;

class GraficoController extends Controller
{
    public function form()
    {
        $turmas = Turma::all();
        return view('graficos.form', compact('turmas'));
    }

    public function gerarGrafico(Request $request)
    {
        $request->validate([
            'turma_id' => 'required|exists:turmas,id',
        ]);

        $turma = Turma::findOrFail($request->turma_id);
        $alunos = $turma->alunos()->with('comprovantes')->get();

        $dados = [];

        foreach ($alunos as $aluno) {
            $totalHoras = $aluno->comprovantes->sum('horas');
            $dados[] = ['nome' => $aluno->user->nome, 'horas' => $totalHoras];
        }

        return view('graficos.resultado', compact('dados', 'turma'));
    }
}
