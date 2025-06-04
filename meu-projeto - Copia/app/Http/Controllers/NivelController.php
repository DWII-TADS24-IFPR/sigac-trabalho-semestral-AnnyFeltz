<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelController extends Controller
{

    public function index()
    {
        $nivels = Nivel::all();
        return view('nivels.index')->with('nivels', $nivels);
    }

    public function create()
    {
        return view('nivels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Nivel::create($request->all());

        return redirect()->route('nivels.index')->with('success', 'Nível criado com sucesso!');
    }


    public function show(string $id)
    {
        $nivel = Nivel::findOrFail($id);
        return view('nivels.show')->with('nivel', $nivel);
    }


    public function edit(string $id)
    {
        $nivel = Nivel::findOrFail($id);

        return view('nivels.edit')->with('nivel', $nivel);
    }


    public function update(Request $request, Nivel $nivel)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $nivel->update($request->all());

        return redirect()->route('nivels.index')->with('success', 'Nível atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->delete();

        return redirect()->route('nivels.index')->with('success', 'Nível excluído com sucesso!');
    }
}
