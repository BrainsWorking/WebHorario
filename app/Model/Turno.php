<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = ['nome'];

    public function horarios(){
        return $this->belongsToMany(Horario::class);
    }
}
