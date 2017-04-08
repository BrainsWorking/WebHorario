<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
	public $timestamp = false;
	
    protected $fillable = ['nome', 'inicio', 'fim'];
}
