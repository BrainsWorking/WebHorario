<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso as Curso;

class Curso extends Model
{

    protected $fillable = ['nome', 'iniciais', 'turno_id'];

    public $timestamps = false;

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'cursos_disciplinas');
    }
    
    public function turno(){
    	return $this->belongsTo(Turno::class);
    }
}