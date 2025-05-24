<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adm extends Model
{
    protected $table = 'adm';
    protected $fillable = ['nome', 'email', 'password'];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function eixos()
    {
        return $this->hasMany(Eixo::class);
    }
    
}
