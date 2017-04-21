<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fpa;
use App\Models\Disciplina;

class Semestre extends Model {

    protected $fillable = ['nome', 'inicio', 'fim', 'fpaInicio', 'fpaFim'];
    public $timestamps = false;

    public function disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'disciplinas_semestres')->orderBy('nome', 'asc');
    }
  
    public function fpas(){
        return $this->hasMany(Fpa::class);
    }
  
    public function setInicioAttribute($data) {
        $this->attributes['inicio'] = converterDataIngles($data);
    }

    public function getInicioAttribute() {
        return converterDataBrasil($this->attributes['inicio']);
    }

    public function setFimAttribute($data) {
        $this->attributes['fim'] = converterDataIngles($data);
    }

    public function getFimAttribute() {
        return converterDataBrasil($this->attributes['fim']);
    }

    public function setInicioAttribute($data) {
        $this->attributes['fpaInicio'] = converterDataIngles($data);
    }

    public function getInicioAttribute() {
        return converterDataBrasil($this->attributes['fpaInicio']);
    }

    public function setFimAttribute($data) {
        $this->attributes['fpaFim'] = converterDataIngles($data);
    }

    public function getFimAttribute() {
        return converterDataBrasil($this->attributes['fpaFim']);
    }

    public function getFpaAtivoAttribute() {
        $dataAtual = date('Y-m-d');
        $inicio    = $this->attributes['fpaInicio'];
        $fim       = $this->attributes['fpaFim'];

        return ($inicio < $dataAtual && $dataAtual < $fim);
    }
}
