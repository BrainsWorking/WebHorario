<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fpa;
use App\Models\Disciplina;

class Semestre extends Model
{
    protected $fillable = ['nome', 'inicio', 'fim'];
    public $timestamps = false;

    public function disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'disciplinas_semestres')->orderBy('nome', 'asc');
    }
  
    public function fpas(){
        return $this->belongsToMany(Fpa::class, 'fpas');
    }
  
    public function setInicioAttribute($data) {
        $this->attributes['inicio'] = converterDataBrasi($data);
    }

    public function getInicioAttribute() {
        return converterDataIngles($this->attributes['inicio']);
    }

    public function setFimAttribute($data) {
        $this->attributes['fim'] = converterDataBrasi($data);
    }

    public function getFimAttribute() {
        return converterDataIngles($this->attributes['fim']);
    }

    public function getAtivoAttribute() {
        $dataAtual = date('Y-m-d');
        $inicio    = $this->attributes['inicio'];
        $fim       = $this->attributes['fim'];

        return ($inicio < $dataAtual && $dataAtual < $fim);
    }
}
