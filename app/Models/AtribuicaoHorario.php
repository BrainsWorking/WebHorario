<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Horario;
use App\Models\Semestre;
use App\Models\Disciplina;

class AtribuicaoHorario extends Model {
    
    protected $table = 'atribuicoes_horarios';
    protected $fillable = ['horario_id', 'semestre_id', 'disciplina_id', 'dia_semana', 'curso_id'];
    public    $timestamps = false;

    public function horario(){
        return $this->belongsTo(Horario::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class);
    }

}