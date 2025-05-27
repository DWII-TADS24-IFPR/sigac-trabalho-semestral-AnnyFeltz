<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // para usar auth()
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = ['nome', 'email', 'senha', 'role_id'];

    protected $hidden = ['senha'];

    public function getAuthPassword()
    {
        return $this->senha;
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function aluno()
    {
        return $this->hasOne(Aluno::class);
    }
}
