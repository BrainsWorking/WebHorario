<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model {

    protected $fillable = ['sigla'];
	public $timestamps = false;	

    public function curso(){
        return $this->belongsTo(Curso::class);
    }
}