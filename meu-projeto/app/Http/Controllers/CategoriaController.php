<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index')->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = \App\Models\Curso::all();
        $turmas = \App\Models\Turma::all();

        return view('categorias.create', compact('cursos', 'turmas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'max_horas' => 'required|numeric',
        'curso_id' => 'required|exists:cursos,id',
    ]);

    Categoria::create($request->all());

    return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show')->with('categoria', $categoria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $cursos = \App\Models\Curso::all();
        $turmas = \App\Models\Turma::all();

        return view('categorias.edit')->with(['categoria' => $categoria, 'cursos' => $cursos, 'turmas' => $turmas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'max_horas' => 'required|numeric',
        'curso_id' => 'required|exists:cursos,id',
    ]);

    $categoria->update($request->all());

    return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso.');
    }
}
