<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class RelatorioHorasController extends Controller
{
    public function index()
    {
        $turmas = Turma::with('curso')->get(); // carrega o curso junto!
        return view('adm.relatorios.index', compact('turmas'));
    }


    public function grafico(Request $request)
    {
        $turmaId = $request->turma_id;

        $turma = Turma::with(['alunos.user', 'alunos.solicitacoes' => function ($query) {
            $query->where('status', 'aprovado');
        }])->findOrFail($turmaId);

        $dados = $turma->alunos->map(function ($aluno) {
            return [
                'nome' => $aluno->user ? $aluno->user->nome : 'Sem nome',
                'horas' => $aluno->solicitacoes->sum('carga_horaria')
            ];
        });

        return response()->json($dados);
    }
}
