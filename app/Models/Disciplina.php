<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Semestre;
use App\Models\Fpa;
use App\Models\Modulo;

class Disciplina extends Model {

    protected $fillable = ['nome', 'sigla', 'aulas_semanais', 'modulo_id'];
	public $timestamps = false;

    public function modulo(){
        return $this->belongsTo(Modulo::class);
    }
    
    public function semestres(){
        return belongsToMany(Semestre::class, 'turmas')->withPivot('quantidade_alunos');
    }
}