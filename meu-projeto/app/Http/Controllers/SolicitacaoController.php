<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Solicitacao;

class SolicitacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->nome === 'admin') {
            $solicitacoes = Solicitacao::with('aluno')->get();
            return view('adm.solicitacoes.index', compact('solicitacoes')); // <<< aqui está o segredo
        } else {
            $solicitacoes = Solicitacao::where('aluno_id', Auth::id())->get();
            return view('solicitacoes.index', compact('solicitacoes'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('solicitacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'carga_horaria' => 'required|integer|min:1',
            'comprovante' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('comprovante')->store('comprovantes');

        Solicitacao::create([
            'aluno_id' => Auth::id(),
            'nome' => $request->nome,
            'carga_horaria' => $request->carga_horaria,
            'comprovante' => $path,
            'status' => 'pendente',
        ]);

        return redirect()->route('solicitacoes.index')->with('success', 'Solicitação criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $solicitacao = Solicitacao::with('aluno')->findOrFail($id);

        if (Auth::user()->role->nome !== 'admin' && $solicitacao->aluno_id !== Auth::id()) {
            abort(403, 'Acesso negado');
        }

        return view('solicitacoes.show', compact('solicitacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $solicitacao = Solicitacao::findOrFail($id);

        if ($solicitacao->aluno_id !== Auth::id() || $solicitacao->status !== 'pendente') {
            abort(403, 'Ação não permitida');
        }

        return view('solicitacoes.edit', compact('solicitacao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $solicitacao = Solicitacao::findOrFail($id);

        if ($solicitacao->aluno_id !== Auth::id() || $solicitacao->status !== 'pendente') {
            abort(403, 'Ação não permitida');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'carga_horaria' => 'required|integer|min:1',
            'comprovante' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('comprovante')) {
            // Apaga o arquivo antigo
            Storage::delete($solicitacao->comprovante);
            // Salva o novo arquivo
            $path = $request->file('comprovante')->store('comprovantes');
            $solicitacao->comprovante = $path;
        }

        $solicitacao->nome = $request->nome;
        $solicitacao->carga_horaria = $request->carga_horaria;
        $solicitacao->save();

        return redirect()->route('solicitacoes.index')->with('success', 'Solicitação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $solicitacao = Solicitacao::findOrFail($id);

        if ($solicitacao->aluno_id !== Auth::id() || $solicitacao->status !== 'pendente') {
            abort(403, 'Ação não permitida');
        }

        $solicitacao->delete();

        return redirect()->route('solicitacoes.index')->with('success', 'Solicitação removida com sucesso!');
    }

    public function avaliar(Request $request, string $id)
    {
        $request->validate([
        'status' => 'required|in:aprovado,rejeitado',
    ]);

    $solicitacao = Solicitacao::findOrFail($id);

    if (Auth::user()->role->nome !== 'admin') {
        abort(403, 'Ação não permitida');
    }

    if ($solicitacao->status !== 'pendente') {
        return redirect()->back()->with('error', 'Esta solicitação já foi avaliada.');
    }

    $solicitacao->status = $request->status;
    $solicitacao->save();

    if ($request->status === 'aprovado') {
        \App\Models\Comprovante::create([
            'horas' => $solicitacao->carga_horaria,
            'atividade' => $solicitacao->nome,
            'aluno_id' => $solicitacao->aluno_id,
            'categoria_id' => 1,
        ]);
    }

    return redirect()->route('adm.solicitacoes.index')->with('success', 'Solicitação avaliada com sucesso!');
    }
}
