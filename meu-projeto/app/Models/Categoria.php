<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Documento;
use App\Models\Comprovante;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['nome', 'max_horas', 'curso_id'];

    public function curso(){
        return $this->belongsTo(Curso::class); 
    }

    public function documentos(){
        return $this->hasMany(Documento::class); 
    }

    public function comprovantes(){
        return $this->hasMany(Comprovante::class); 
    }
}
