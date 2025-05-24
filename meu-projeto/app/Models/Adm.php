<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adm extends Model
{
    protected $table = 'adms';
    protected $fillable = ['nome', 'email', 'password'];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function eixos()
    {
        return $this->hasMany(Eixo::class);
    }
    
    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function niveis()
    {
        return $this->hasMany(Nivel::class);
    }

    
}
