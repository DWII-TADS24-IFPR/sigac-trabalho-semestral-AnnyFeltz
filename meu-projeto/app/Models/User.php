<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // para usar auth()
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Role;
use App\Models\Aluno;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = ['nome', 'email', 'password', 'email_verified_at', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    public function getAuthPassword()
    {
        return $this->password;
    }
    
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function aluno(): HasOne
    {
        return $this->hasOne(Aluno::class);
    }
}
