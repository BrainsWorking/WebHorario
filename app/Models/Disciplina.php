<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\TipoSala;
use App\Models\Semestre;

class Disciplina extends Model {

    protected $fillable = ['nome', 'sigla', 'aulasSemanais'];
	public $timestamps = false;
    
    public function cursos(){
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas');
    }

    public function tipoSalas(){
        return $this->belongsToMany(TipoSala::class, 'disciplinas_tiposSalas');
    }

    public function semestres(){
    	return $this->belongsToMany(Semestre::class, 'disciplinas_semestres');
    }
    
}