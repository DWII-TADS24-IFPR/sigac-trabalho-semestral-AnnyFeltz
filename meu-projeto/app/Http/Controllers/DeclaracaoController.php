<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Declaracao;
use App\Models\Aluno;
use App\Models\Comprovante;
use Illuminate\Support\Facades\Auth;
use PDF; // Facade do dompdf

class DeclaracaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role->nome === 'admin') {
            // Admin vê todas declarações
            $declaracoes = Declaracao::all();
        } else {
            // Aluno vê só suas declarações
            $aluno = $user->aluno;
            $declaracoes = Declaracao::where('aluno_id', $aluno->id)->get();
        }

        return view('declaracoes.index', compact('declaracoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = Aluno::all();
        $comprovantes = Comprovante::all();

        return view('declaracoes.create', compact('alunos', 'comprovantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hash' => 'required|string|max:255',
            'data' => 'required|date',
            'aluno_id' => 'required|exists:alunos,id',
            'comprovante_id' => 'required|exists:comprovantes,id',
        ]);

        Declaracao::create($request->all());

        return redirect()->route('declaracoes.index')->with('success', 'Declaração criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $declaracao = Declaracao::findOrFail($id);

        $user = Auth::user();
        if ($user->role->nome !== 'admin' && $declaracao->aluno_id !== $user->aluno->id) {
            abort(403, 'Acesso negado');
        }

        return view('declaracoes.show', compact('declaracao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $declaracao = Declaracao::findOrFail($id);
        $alunos = Aluno::all();
        $comprovantes = Comprovante::all();

        return view('declaracoes.edit', compact('declaracao', 'alunos', 'comprovantes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Declaracao $declaracao)
    {
        $request->validate([
            'hash' => 'required|string|max:255',
            'data' => 'required|date',
            'aluno_id' => 'required|exists:alunos,id',
            'comprovante_id' => 'required|exists:comprovantes,id',
        ]);

        $declaracao->update($request->all());

        return redirect()->route('declaracoes.index')->with('success', 'Declaração atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $declaracao = Declaracao::findOrFail($id);
        $declaracao->delete();

        return redirect()->route('declaracoes.index')->with('success', 'Declaração excluída com sucesso.');
    }

    public function gerarPDF($id)
    {
        $declaracao = Declaracao::findOrFail($id);

        // Verificação de acesso para aluno
        $user = Auth::user();
        if ($user->role->nome !== 'admin' && $declaracao->aluno_id !== $user->aluno->id) {
            abort(403, 'Acesso negado');
        }

        $pdf = PDF::loadView('declaracoes.pdf', compact('declaracao'));

        return $pdf->download('declaracao_' . $declaracao->id . '.pdf');
    }
}
