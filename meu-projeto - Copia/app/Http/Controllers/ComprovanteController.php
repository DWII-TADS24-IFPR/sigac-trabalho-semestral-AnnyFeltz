<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprovante;
use App\Models\Aluno;
use App\Models\Categoria;

use function view;
use function redirect;
use function compact;

class ComprovanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carrega comprovantes com aluno e o user do aluno
        $comprovantes = Comprovante::with('aluno.user')->get();
        return view('comprovantes.index')->with('comprovantes', $comprovantes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Carrega os alunos junto com os users
        $alunos = Aluno::with('user')->get();
        $categorias = Categoria::all();

        return view('comprovantes.create', compact('alunos', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'horas' => 'required|numeric',
            'atividade' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'aluno_id' => 'required|exists:alunos,id',
        ]);

        Comprovante::create($request->all());

        return redirect()->route('comprovantes.index')->with('success', 'Comprovante criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Carrega o comprovante com aluno, user e categoria
        $comprovante = Comprovante::with('aluno.user', 'categoria')->findOrFail($id);
        return view('comprovantes.show')->with('comprovante', $comprovante);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comprovante = Comprovante::findOrFail($id);
        // Carrega os alunos com seus users
        $alunos = Aluno::with('user')->get();
        $categorias = Categoria::all();

        return view('comprovantes.edit')->with([
            'comprovante' => $comprovante,
            'alunos' => $alunos,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comprovante $comprovante)
    {
        $request->validate([
            'horas' => 'required|numeric',
            'atividade' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'aluno_id' => 'required|exists:alunos,id',
        ]);

        $comprovante->update($request->all());

        return redirect()->route('comprovantes.index')->with('success', 'Comprovante atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comprovante = Comprovante::findOrFail($id);
        $comprovante->delete();

        return redirect()->route('comprovantes.index')->with('success', 'Comprovante excluído com sucesso.');
    }
}
