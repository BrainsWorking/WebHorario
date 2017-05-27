<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Disciplina;

class Modulo extends Model {
    
    protected $table = 'modulos';
    protected $fillable = ['nome', 'curso_id'];
    public    $timestamps = false;

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function semestres(){
        return $this->belongsToMany(Modulo::class, 'modulos_semestres');
    }

    public function disciplinas(){
        return $this->hasMany(Disciplina::class);
    }

}