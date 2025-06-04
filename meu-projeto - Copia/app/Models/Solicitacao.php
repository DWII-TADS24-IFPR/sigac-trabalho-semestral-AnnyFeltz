<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Solicitacao extends Model
{
    use SoftDeletes;

    protected $table = 'solicitacoes';
    protected $fillable = ['aluno_id', 'nome', 'comprovante', 'carga_horaria', 'status'];

    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }
}
