<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Declaracao;

class DeclaracaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $declaracoes = Declaracao::all();
        return view('declaracoes.index')->with('declaracoes', $declaracoes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = \App\Models\Aluno::all();
        $comprovantes = \App\Models\Comprovante::all();

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
        return view('declaracoes.show')->with('declaracao', $declaracao);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $declaracao = Declaracao::findOrFail($id);
        $alunos = \App\Models\Aluno::all();
        $comprovantes = \App\Models\Comprovante::all();

        return view('declaracoes.edit')->with(['declaracao' => $declaracao, 'alunos' => $alunos, 'comprovantes' => $comprovantes]);
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
}
