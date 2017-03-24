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
}
