<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Aluno;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|max:14|unique:alunos',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'required|exists:roles,id',
        'curso_id' => 'nullable|exists:cursos,id',
        'turma_id' => 'nullable|exists:turmas,id',
    ]);

    $user = User::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => $request->role_id,
    ]);

    // Se for aluno, cria o registro na tabela alunos
    if ($user->role && strtolower($user->role->nome) === 'aluno') {
        Aluno::create([
            'cpf' => $request->cpf,
            'curso_id' => $request->curso_id,
            'turma_id' => $request->turma_id,
            'user_id' => $user->id,
        ]);
    }

    return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->nome = $request->nome;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->passord);
        }
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
