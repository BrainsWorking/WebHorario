<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Curso as Curso;

class Curso extends Model
{
    protected $fillable = ['nome', 'iniciais', 'turno_id'];
    public $timestamps = false;

    public function disciplinas(){
<<<<<<< HEAD
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas');
    } 
=======
        return $this->belongsToMany(Disciplina::class, 'cursos_disciplinas');
    }

    public function turno(){
    	return $this->belongsTo(Turno::class);
    }
>>>>>>> afb0e9080d0079e3c593a9d224c28092f4e5b51c
}
