<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $documentos = Documento::where('status', 'pendente')->get();
        return view('avaliacao.index', compact('documentos'));
    }

    public function edit($id)
    {
        $documento = Documento::findOrFail($id);
        return view('avaliacao.edit', compact('documento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aprovado,reprovado',
            'comentario' => 'nullable|string',
            'horas_out' => 'required|numeric|min:0',
        ]);

        $documento = Documento::findOrFail($id);
        $documento->status = $request->status;
        $documento->comentario = $request->comentario;
        $documento->horas_out = $request->horas_out;
        $documento->save();

        return redirect()->route('avaliacao.index')->with('success', 'Avaliação atualizada com sucesso!');
    }
}
