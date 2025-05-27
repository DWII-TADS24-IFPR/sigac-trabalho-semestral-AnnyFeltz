<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAluno
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role->nome === 'aluno') {
            return $next($request);
        }

        abort(403, 'Acesso negado.');
    }
}
