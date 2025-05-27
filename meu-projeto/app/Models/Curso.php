<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Nivel;
use App\Models\Categoria;
use App\Models\Turma;
use App\Models\Aluno;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $fillable = ['nome', 'sigla', 'total_horas', 'nivel_id'];

    public function nivel(){
        return $this->belongsTo(Nivel::class);
    }

    public function categorias(){
        return $this->hasMany(Categoria::class);
    }

    public function turmas(){
        return $this->hasMany(Turma::class);
    }

    public function alunos(){
        return $this->hasMany(Aluno::class);
    }

    public function eixo()
    {
        return $this->belongsTo(Eixo::class);
    }
}
