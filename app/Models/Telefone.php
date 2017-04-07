<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Telefone extends Model
{
    protected $fillable = ['nome', 'funcionario_id'];

  	public function funcionario(){
    	return $this->belongsTo(Funcionario::class);
    }
}
