<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Semestre;
use App\Models\Disciplina;

class Turma extends Model {

    protected $table = 'turmas';
    protected $fillable = ['semestre_id', 'disciplina_id','quantidade_alunos'];
    public $timestamps = false;

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }    

    public function disciplina(){
        return $this->belongsTo(Disciplina::class);
    }

}