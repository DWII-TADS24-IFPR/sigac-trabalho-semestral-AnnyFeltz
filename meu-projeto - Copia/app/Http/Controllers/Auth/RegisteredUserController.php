<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\Aluno;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    // app/Http/Controllers/Auth/RegisteredUserController.php



    public function create()
    {
        $cursos = Curso::all();
        $turmas = Turma::all();

        return view('auth.register', compact('cursos', 'turmas'));
    }

    private function redirecionarUsuario($user)
    {
        switch ($user->role_id) {
            case 1:
                return redirect('/home');       
            case 2:
                return redirect('/home_aluno');  
            default:
                return redirect('/');             
        }
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'integer', 'exists:roles,id'], // Agora é inteiro e valida ID na tabela roles
            // Campos extras para aluno (considerando role_id 2 = aluno)
            'cpf' => ['required_if:role,2', 'nullable', 'string', 'max:20'],
            'curso_id' => ['required_if:role,2', 'nullable', 'integer', 'exists:cursos,id'],
            'turma_id' => ['required_if:role,2', 'nullable', 'integer', 'exists:turmas,id'],
        ]);

        $user = User::create([
            'nome' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role, // salva o ID do role
        ]);

        if ($request->role == 2) { // 2 é aluno
            Aluno::create([
                'user_id' => $user->id,
                'cpf' => $request->cpf,
                'curso_id' => $request->curso_id,
                'turma_id' => $request->turma_id,
            ]);
        }

        auth()->login($user);
        return $this->redirecionarUsuario($user);

        return redirect('/dashboard'); // ou '/' ou onde for sua rota pós-login
    }
}
