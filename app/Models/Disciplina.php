<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina as Curso;

class Disciplina extends Model{

    protected $fillable = ['nome', 'iniciais', 'cargaHoraria'];

    public $timestamps = false;
    
}