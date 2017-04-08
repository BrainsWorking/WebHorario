<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso as Curso;
use App\Models\TipoSala;

class Disciplina extends Model{

    protected $fillable = ['nome', 'iniciais', 'cargaHoraria'];
    
    public $timestamps = false;
    
    public function cursos(){
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas');
    }

    public function tipoSalas(){
        return $this->belongsToMany(TipoSala::class, 'disciplinas_tiposSalas');
    }
    
}