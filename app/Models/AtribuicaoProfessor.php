<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Horario;
use App\Models\Semestre;
use App\Models\Funcionario;

class AtribuicaoProfessor extends Model {
    
    protected $table = 'atribuicoes_disciplinas';
    protected $fillable = ['disciplina_id', 'semestre_id', 'funcionario_id'];
    public    $timestamps = false;

    public function disciplina(){
        return $this->belongsTo(Disciplina::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function funcionario(){
        return $this->belongsTo(Funcionario::class);
    }

}