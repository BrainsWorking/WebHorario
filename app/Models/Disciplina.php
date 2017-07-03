<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Semestre;
use App\Models\Fpa;
use App\Models\Modulo;

class Disciplina extends Model {

    protected $fillable = ['nome', 'sigla', 'tipo_sala', 'aulas_semanais', 'quantidade_professores', 'modulo_id']; // XXX: Por hora, sem tipo de sala
	public $timestamps = false;

    public function modulo(){
        return $this->belongsTo(Modulo::class);
    }
    public function semestres(){
        return belongsToMany(Semestre::class, 'turmas')->withPivot('quantidade_alunos');
    }
    
    public function fpas(){		
        return belongsToMany(Fpa::class, 'disciplinas_fpas')->withPivot('prioridade');		
    }		
		
    public function curso(){		
        return $this->modulo->curso;		
    }

    public function professor(){
        return $this->belongsTo(Funcionario::class, 'atribuicoes_disciplinas');
    }
}