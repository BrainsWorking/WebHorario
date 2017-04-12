<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso as Curso;
use App\Models\TipoSala as TipoSala;

class Disciplina extends Model{

	public $timestamps = false;

    protected $fillable = ['nome', 'sigla', 'aulasSemanais'];
    
    public function cursos(){
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas');
    }

    public function tipoSalas(){
        return $this->belongsToMany(TipoSala::class, 'disciplinas_tiposSalas');
    }
    
}