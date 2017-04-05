<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Turno as Turno;

class Turno extends Model
{
    
    protected $fillable = ['nome'];
    public $timestamps = false;
    
    public function horarios(){
        return $this->belongsToMany(Horario::class, 'turnos_horarios');
    }

    public function cursos(){
        return $this->hasMany('App\Models\Curso');        
    }

    public function getQuantidadeAulasAttribute(){
        return $this->horarios->count();
    }
}
