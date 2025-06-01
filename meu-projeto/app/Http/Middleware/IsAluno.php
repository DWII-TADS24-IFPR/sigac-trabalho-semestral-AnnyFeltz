<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAluno
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->role && $user->role->nome === 'aluno') {
            return $next($request);
        }

        abort(403, 'Acesso negado.');
    }
}
