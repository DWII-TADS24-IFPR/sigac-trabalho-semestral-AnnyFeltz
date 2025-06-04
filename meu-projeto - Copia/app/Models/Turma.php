<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turma extends Model
{
    use SoftDeletes;

    protected $table = 'turmas';
    protected $fillable = ['ano', 'curso_id'];

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function alunos(){
        return $this->hasMany(Aluno::class);
    }
}
