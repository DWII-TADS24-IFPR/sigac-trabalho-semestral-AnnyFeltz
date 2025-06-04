<?php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use App\Models\Aluno;
use App\Models\Comprovante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class DeclaracaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role->nome === 'admin') {
            $declaracoes = Declaracao::with('aluno', 'comprovante')->get();
            return view('declaracoes.index', compact('declaracoes'));
        } else {
            $declaracoes = Declaracao::with('comprovante')->where('aluno_id', $user->aluno->id)->get();
            return view('aluno.declaracoes.index', compact('declaracoes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role->nome === 'admin') {
            $alunos = Aluno::all();
            $comprovantes = Comprovante::all();
            return view('declaracoes.create', compact('alunos', 'comprovantes'));
        } else {
            $comprovantes = Comprovante::where('aluno_id', $user->aluno->id)->get();
            return view('aluno.declaracoes.create', compact('comprovantes'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'hash' => 'required|string|max:255',
            'data' => 'required|date',
            'comprovante_id' => 'required|exists:comprovantes,id',
        ]);

        if ($user->role->nome === 'admin') {
            $request->validate([
                'aluno_id' => 'required|exists:alunos,id',
            ]);
            $aluno_id = $request->aluno_id;
        } else {
            $aluno_id = $user->aluno->id;
        }

        $comprovante = Comprovante::findOrFail($request->comprovante_id);

        if ($comprovante->aluno_id !== $aluno_id) {
            abort(403, 'Você não pode criar declaração para comprovante de outro aluno.');
        }

        Declaracao::create([
            'hash' => $request->hash,
            'data' => $request->data,
            'aluno_id' => $aluno_id,
            'comprovante_id' => $comprovante->id,
        ]);

        $rota = $user->role->nome === 'admin' ? 'declaracoes.index' : 'aluno.declaracoes.index';
        return redirect()->route($rota)->with('success', 'Declaração criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $declaracao = Declaracao::with('aluno', 'comprovante')->findOrFail($id);
        $user = Auth::user();

        if ($user->role->nome !== 'admin' && $declaracao->aluno_id !== $user->aluno->id) {
            abort(403, 'Acesso negado');
        }

        $view = $user->role->nome === 'admin' ? 'declaracoes.show' : 'aluno.declaracoes.show';
        return view($view, compact('declaracao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $declaracao = Declaracao::findOrFail($id);
        $user = Auth::user();

        if ($user->role->nome !== 'admin' && $declaracao->aluno_id !== $user->aluno->id) {
            abort(403, 'Acesso negado');
        }

        if ($user->role->nome === 'admin') {
            $alunos = Aluno::all();
            $comprovantes = Comprovante::all();
            return view('declaracoes.edit', compact('declaracao', 'alunos', 'comprovantes'));
        } else {
            $comprovantes = Comprovante::where('aluno_id', $user->aluno->id)->get();
            return view('aluno.declaracoes.edit', compact('declaracao', 'comprovantes'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Declaracao $declaracao)
    {
        $user = Auth::user();

        $request->validate([
            'hash' => 'required|string|max:255',
            'data' => 'required|date',
            'comprovante_id' => 'required|exists:comprovantes,id',
        ]);

        if ($user->role->nome === 'admin') {
            $request->validate([
                'aluno_id' => 'required|exists:alunos,id',
            ]);
            $aluno_id = $request->aluno_id;
        } else {
            if ($declaracao->aluno_id !== $user->aluno->id) {
                abort(403, 'Você não tem permissão para editar essa declaração.');
            }
            $aluno_id = $user->aluno->id;
        }

        $comprovante = Comprovante::findOrFail($request->comprovante_id);

        if ($comprovante->aluno_id !== $aluno_id) {
            abort(403, 'O comprovante informado não pertence a você.');
        }

        $declaracao->update([
            'hash' => $request->hash,
            'data' => $request->data,
            'aluno_id' => $aluno_id,
            'comprovante_id' => $comprovante->id,
        ]);

        $rota = $user->role->nome === 'admin' ? 'declaracoes.index' : 'aluno.declaracoes.index';
        return redirect()->route($rota)->with('success', 'Declaração atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $declaracao = Declaracao::findOrFail($id);
        $user = Auth::user();

        if ($user->role->nome !== 'admin' && $declaracao->aluno_id !== $user->aluno->id) {
            abort(403, 'Acesso negado');
        }

        $declaracao->delete();

        $rota = $user->role->nome === 'admin' ? 'declaracoes.index' : 'aluno.declaracoes.index';
        return redirect()->route($rota)->with('success', 'Declaração excluída com sucesso.');
    }

    public function gerarPDF($id)
    {
        $declaracao = Declaracao::with('aluno', 'comprovante.categoria')->findOrFail($id);
        $user = Auth::user();

        if ($user->role->nome !== 'admin' && $declaracao->aluno_id !== $user->aluno->id) {
            abort(403, 'Acesso negado');
        }

        $pdf = PDF::loadView('declaracoes.pdf', compact('declaracao'));
        return $pdf->stream('declaracao_' . $declaracao->aluno->user->nome . '.pdf');
    }
}
