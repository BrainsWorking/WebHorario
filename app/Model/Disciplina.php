<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = ['name', 'iniciais', 'cargaHoraria'];

    public function cursos(){
        return $this->belongsToMany(Disciplina::class);
    }
}
