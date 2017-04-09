<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;

class Funcionario extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['nome', 'sexo', 'cpf', 'data_nascimento', 'endereco', 'foto', 'email', 'password'];

    public function cargos(){
        return $this->belongsToMany(Cargo::class, 'cargos_funcionarios');
    }
}
