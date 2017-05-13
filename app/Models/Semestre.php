<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fpa;
use App\Models\Modulo;
use App\Models\Disciplina;
use Illuminate\Support\Facades\DB;

class Semestre extends Model {

    protected $fillable = ['nome', 'inicio', 'fim', 'fpa_inicio', 'fpa_fim'];
    public $timestamps = false;

    public function modulos(){
        return $this->belongsToMany(Modulo::class, 'modulos_semestre');
    }

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'turmas');
    }

    public function turmas(){
        return $this->hasMany(Turma::class, 'semestre_id');
    }
  
    public function fpas(){
        return $this->hasMany(Fpa::class);
    }
  
    public static function FpaAtivo(){
        $data_atual = date('Y-m-d');
        
        return Semestre::
              where('fpa_inicio', '<', $data_atual)
            ->where('fpa_fim'   , '>', $data_atual)
            ->firstOrFail();
    }

    # Atributos customizados: Accessors e Mutators

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

    public function setFpaInicioAttribute($data) {
        $this->attributes['fpa_inicio'] = converterDataIngles($data);
    }

    public function getFpaInicioAttribute() {
        return converterDataBrasil($this->attributes['fpa_inicio']);
    }

    public function setFpaFimAttribute($data) {
        $this->attributes['fpa_fim'] = converterDataIngles($data);
    }

    public function getFpaFimAttribute() {
        return converterDataBrasil($this->attributes['fpa_fim']);
    }

}
