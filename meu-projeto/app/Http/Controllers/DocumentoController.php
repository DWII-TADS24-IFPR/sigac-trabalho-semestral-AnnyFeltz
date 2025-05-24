<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index')->with('documentos', $documentos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = \App\Models\Categoria::all();

        return view('documentos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'horas_in' => 'required|numeric',
            'status' => 'required|string|max:50',
            'comentario' => 'nullable|string',
            'horas_out' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Documento::create($request->all());

        return redirect()->route('documentos.index')->with('success', 'Documento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $documento = Documento::findOrFail($id);
        return view('documentos.show')->with('documento', $documento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $documento = Documento::findOrFail($id);
        $categorias = \App\Models\Categoria::all();

        return view('documentos.edit')->with(['documento' => $documento, 'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documento $documento)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'horas_in' => 'required|numeric',
            'status' => 'required|string|max:50',
            'comentario' => 'nullable|string',
            'horas_out' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $documento->update($request->all());

        return redirect()->route('documentos.index')->with('success', 'Documento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();

        return redirect()->route('documentos.index')->with('success', 'Documento excluído com sucesso.');
    }
}
