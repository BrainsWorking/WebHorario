<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fpa;
use App\Models\Disciplina;

class Semestre extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['nome', 'inicio', 'fim'];

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'disciplinas_semestres');
    }

     public function fpas(){
        return $this->belongsToMany(Fpa::class, 'fpas');
    }
}
