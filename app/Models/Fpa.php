<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Disciplina;
use App\Models\Horario;

class Fpa extends Model {

    protected $fillable = ['horario_id', 'semestre_id', 'disciplina_id', 'funcionario_id', 'diaSemana'];
	public $timestamps = false;

    public function horarios(){
        return $this->belongsTo(Horario::class);
    }

    public function semestres(){
        return $this->belongsTo(Semestre::class);
    }

    public function disciplinas(){
        return $this->belongsTo(Disciplina::class);
    }

    public function funcionarios(){
        return $this->belongsTo(Funcionario::class);
    }

}
