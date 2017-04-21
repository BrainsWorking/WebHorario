<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina;
use App\Models\Turno;
use App\Models\Funcionario;

class Curso extends Model {
    
    protected $fillable = ['nome', 'sigla', 'turno_id', 'funcionario_id'];
	public $timestamps = false;

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'cursos_disciplinas');
    }
    
    public function turno(){
    	return $this->belongsTo(Turno::class);
    }

    public function coordenador(){
    	return $this->belongsTo(Funcionario::class);
    }
}