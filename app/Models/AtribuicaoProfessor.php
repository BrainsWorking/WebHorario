<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Horario;
use App\Models\Modulo;
use App\Models\Funcionario;

class AtribuicaoProfessor extends Model {
    
    protected $table = 'atribuicoes_disciplinas';
    protected $fillable = ['disciplina_id', 'modulo_id', 'funcionario_id'];
    public    $timestamps = false;

    public function disciplina(){
        return $this->belongsTo(Disciplina::class);
    }

    public function modulo(){
        return $this->belongsTo(Modulo::class);
    }

    public function funcionario(){
        return $this->belongsTo(Funcionario::class);
    }

}