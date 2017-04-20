<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Disciplina;
use App\Models\Horario;

class Fpa extends Model
{

	public $timestamps = false;
	
    protected $fillable = ['horario_id', 'semestre_id', 'disciplina_id', 'funcionario_id', 'diaSemana'];

    public function horarios(){
        return $this->belongsToMany(Horario::class, 'horarios');
    }

    public function semestres(){
        return $this->belongsToMany(Semestre::class, 'semestres');
    }

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'disciplinas');
    }

    public function funcionarios(){
        return $this->belongsToMany(Funcionario::class, 'funcionarios');
    }

}
