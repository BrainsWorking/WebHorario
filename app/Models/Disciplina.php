<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Models\Disciplina as Disciplina;
=======
use App\Models\Disciplina as Curso;
>>>>>>> afb0e9080d0079e3c593a9d224c28092f4e5b51c


class Disciplina extends Model
{
<<<<<<< HEAD
    protected $fillable = ['nome', 'iniciais', 'cargaHoraria'];
    public $timestamps = false;

    public function cursos(){
        return $this->belongsToMany(Disciplina::class, 'cursos_disciplinas');
=======
    protected $fillable = ['nomeDisplinas', 'iniciaisDisplinas', 'cargaHoraria'];
    public $timestamps = false;

    public function cursos(){
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas');
>>>>>>> afb0e9080d0079e3c593a9d224c28092f4e5b51c
    }
}
