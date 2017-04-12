<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{

    protected $table = 'instituicoes';

	public $timestamps = false;
	
    protected $fillable = ['nome', 'cep', 'endereco', 'telefone'];
}
