<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\Comprovante;
use App\Models\Declaracao;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Solicitacao;
use App\Models\User;

class Aluno extends Model
{
    use SoftDeletes;

    protected $table = 'alunos';
    protected $fillable = ['cpf', 'curso_id', 'turma_id', 'user_id'];  // tira nome, email, senha daqui

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function comprovantes()
    {
        return $this->hasMany(Comprovante::class);
    }

    public function declaracoes()
    {
        return $this->hasMany(Declaracao::class);
    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class);
    }
}
