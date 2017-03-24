<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso as Curso;

class Curso extends Model
{
    protected $fillable = ['nome', 'iniciais', 'turno_id'];
    public $timestamps = false;

    public function disciplinas(){
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas');
    } 
}
