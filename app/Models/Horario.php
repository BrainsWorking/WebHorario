<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Turno as Turno;

class Horario extends Model
{
    
    protected $fillable = ['inicio', 'fim'];
    public $timestamps = false;

    public function turnos(){
        return $this->belongsToMany(Turno::class, 'turnos_horarios');
    }
}
