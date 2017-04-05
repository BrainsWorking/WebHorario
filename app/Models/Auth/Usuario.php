<?php

namespace App\Models\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\UsuarioTrait as Permissivel;

class Usuario extends Authenticatable
{
    use Notifiable;
    use Permissivel;

    protected $fillable = [ 'nome', 'email', 'senha', 'perfil_id' ];
    protected $hidden = [ 'senha', 'remember_token' ];
}
