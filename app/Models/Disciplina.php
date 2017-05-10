<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Semestre;
use App\Models\Modulo;

class Disciplina extends Model {

    protected $fillable = ['nome', 'sigla', 'aulas_semanais', 'modulo_id'];
	public $timestamps = false;

    public function modulo(){
        return $this->belongsTo(Modulo::class);
    }
    
    public function cursos(){
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas');
    }

    public function semestres(){
    	return $this->belongsToMany(Semestre::class, 'disciplinas_semestres');
    }
    
}