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
    
<<<<<<< HEAD
    public function modulo(){
        return $this->belongsTo(Modulo::class);
=======
    public function semestres(){
        return belongsToMany(Semestre::class, 'turmas')->withPivot('quantidade_alunos');
>>>>>>> c64fb49b2ade63cf217fc7d3d1f895ec7e1a771b
    }

    public function fpas(){
        return belongsToMany(Fpa::class, 'disciplinas_fpas')->withPivot('prioridade');
    }

    public function curso(){
        return $this->modulo->curso;
    }

}