<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class Modulo extends Model {

    protected $fillable = ['sigla'];
	public $timestamps = false;	
=======
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Disciplina;

class Modulo extends Model {
    
    protected $table = 'modulos';
    protected $fillable = ['sigla', 'curso_id'];
    public    $timestamp = false;
>>>>>>> c64fb49b2ade63cf217fc7d3d1f895ec7e1a771b

    public function curso(){
        return $this->belongsTo(Curso::class);
    }
<<<<<<< HEAD
=======

    public function semestres(){
        return $this->belongsToMany(Modulo::class, 'modulos_semestres');
    }

    public function disciplinas(){
        return $this->hasMany(Disciplina::class);
    }

>>>>>>> c64fb49b2ade63cf217fc7d3d1f895ec7e1a771b
}