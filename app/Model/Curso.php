<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nome', 'iniciais', 'turnos_id'];

    public function disciplinas(){
        return $this->belongsToMany(Curso::class);
    } 
}
