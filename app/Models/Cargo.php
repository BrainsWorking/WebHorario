<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Cargo extends Model
{
	public $timestamp = false;
	
    protected $fillable = ['nome'];

    public function funcionarios(){
        return $this->belongsToMany(Funcionario::class, 'cargos_funcionarios');
    }
}
