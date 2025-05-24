<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index')->with('alunos', $alunos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = \App\Models\Curso::all();
        $turmas = \App\Models\Turma::all();

        return view('alunos.create', compact('cursos', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'email' => 'required|email|max:255',
            'senha' => 'required|string|min:6',
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
        ]);

        Aluno::create($request->all());

        return redirect()->route('alunos.index')->with('success', 'Aluno criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.show')->with('aluno', $aluno);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aluno = Aluno::findOrFail($id);
        $cursos = \App\Models\Curso::all();
        $turmas = \App\Models\Turma::all();

        return view('alunos.edit')->with(['aluno' => $aluno, 'cursos' => $cursos, 'turmas' => $turmas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|max:14',
        'email' => 'required|email|max:255',
        'senha' => 'nullable|string|min:6',
        'curso_id' => 'required|exists:cursos,id',
        'turma_id' => 'required|exists:turmas,id',
    ]);

    if ($request->filled('senha')) {
        $aluno->senha = bcrypt($request->senha);
    }

    $aluno->update($request->except('senha'));

    return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso.');
    }
}
