<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model {

    protected $table = 'instituicoes';
    protected $fillable = ['nome', 'cep', 'endereco', 'telefone'];
	public $timestamps = false;	

	public function getTelefoneAttribute(){
		return formataTelefone($this->attributes['telefone']);
	}

	public function setTelefoneAttribute($telefone){
		$this->attributes['telefone'] = limpaPontuacao($telefone);
	}
}
