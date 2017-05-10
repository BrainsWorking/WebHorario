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
        return $this->hasMany(Horario::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'disciplinas_fpas');
    }

    public function funcionarios(){
        return $this->belongsTo(Funcionario::class);
    }

}
