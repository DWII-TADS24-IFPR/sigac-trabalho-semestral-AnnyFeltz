<?php

namespace App\Http\Controllers;

use App\Models\Adm;
use Illuminate\Http\Request;

class AdmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adms = Adm::all();
        return view('adms.index', compact('adms'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:adms',
            'senha' => 'required|string|min:8|confirmed',
        ]);

        Adm::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => bcrypt($request->senha),
        ]);

        return redirect()->route('adms.index')->with('success', 'Administrador criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $adm = Adm::findOrFail($id);
        return view('adms.show', compact('adm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adm = Adm::findOrFail($id);
        return view('adms.edit', compact('adm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:adms,email,' . $id,
            'senha' => 'nullable|string|min:8|confirmed',
        ]);

        $adm = Adm::findOrFail($id);
        $adm->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha ? bcrypt($request->senha) : $adm->senha,
        ]);

        return redirect()->route('adms.index')->with('success', 'Administrador atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adm = Adm::findOrFail($id);
        $adm->delete();

        return redirect()->route('adms.index')->with('success', 'Administrador excluído com sucesso.');
    }
}
