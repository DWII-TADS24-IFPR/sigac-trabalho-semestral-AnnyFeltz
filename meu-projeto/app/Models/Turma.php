<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Aluno;


class Turma extends Model
{
    protected $table = 'turmas';
    protected $fillable = ['ano', 'curso_id'];

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function alunos(){
        return $this->hasMany(Aluno::class);
    }
}
