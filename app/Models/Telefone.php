<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Telefone extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['nome', 'funcionario_id'];

  	public function funcionario(){
    	return $this->belongsTo(Funcionario::class);
    }

	public function getNumeroAttribute(){
		return formataTelefone($this->attributes['numero']);
	}

	public function setNumeroAttribute($numero){
		$this->attributes['numero'] = limpaPontuacao($numero);
	}
}
