<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;

class Funcionario extends Model
{
    protected $fillable = ['nome', 'sexo', 'cpf', 'data_nascimento', 'endereco', 'foto', 'email', 'senha'];
    public $timestamps = false;

    public function cargo_funcionarios(){
        return $this->belongsToMany(Cargo::class, 'cargos_funcionarios');
    }
}
