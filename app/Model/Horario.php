<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['name', 'inicio', 'fim', 'turnos_id'];

    public function turnos(){
        return $this->belongsToMany(Turno::class);
    }
}
