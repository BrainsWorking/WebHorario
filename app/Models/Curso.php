<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina as Disciplina;
use App\Models\Turno as Turno;

class Curso extends Model
{
	public $timestamps = false;

    protected $fillable = ['nome', 'sigla', 'turno_id', 'funcionario_id'];

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