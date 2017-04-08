<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
	public $timestamp = false;
	
    protected $fillable = ['nome', 'cnpj'];
}
