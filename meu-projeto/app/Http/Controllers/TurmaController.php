<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turmas = Turma::with('curso')->get();
        return view('turmas.index')->with('turmas', $turmas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('turmas.create')->with('cursos', $cursos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ano' => 'required|integer',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        Turma::create($request->all());

        return redirect()->route('turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $turma = Turma::with('curso')->findOrFail($id);

        return view('turmas.show')->with('turma', $turma);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $turma = Turma::with('curso')->findOrFail($id);
        $cursos = Curso::all();

        return view('turmas.edit')->with(['turma' => $turma, 'cursos' => $cursos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turma $turma)
    {
        $request->validate([
            'ano' => 'required|integer',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $turma->update($request->all());

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();
    }

    public function minhaTurma()
    {
        $user = Auth::user();

        if (!$user || $user->role->nome !== 'Aluno') {
            return redirect()->route('home_aluno')->with('error', 'Acesso não autorizado.');
        }

        // Verifica se o usuário tem aluno e turma relacionada
        if (!$user || $user->role->nome !== 'aluno') {
            return redirect()->route('home_aluno')->with('error', 'Acesso não autorizado.');
        }


        $turma = $user->aluno->turma;

        return view('turmas.minha', compact('turma'));
    }
}
