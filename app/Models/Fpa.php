<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Disciplina;
use App\Models\Horario;

class Fpa extends Model {

    protected $fillable = ['carga_horaria', 'semestre_id', 'funcionario_id'];
	public $timestamps = false;

    public function horarios(){
        return $this->belongsToMany(Horario::class, 'horarios_fpas')->withPivot('dia_semana');
    }

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'disciplinas_fpas')->withPivot('prioridade');
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function funcionario(){
        return $this->belongsTo(Funcionario::class);
    }

}
