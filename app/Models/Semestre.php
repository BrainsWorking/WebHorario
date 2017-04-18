<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['nome', 'inicio', 'fim'];

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'disciplinas_semestres');
    }
}
