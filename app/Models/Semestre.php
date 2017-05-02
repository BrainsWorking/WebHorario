<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fpa;
use App\Models\Disciplina;
use Illuminate\Support\Facades\DB;

class Semestre extends Model {

    protected $fillable = ['nome', 'inicio', 'fim', 'fpaInicio', 'fpaFim'];
    public $timestamps = false;

    public function disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'disciplinas_semestres')->orderBy('disciplinas.nome', 'asc');
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

    public function setFpaInicioAttribute($data) {
        $this->attributes['fpaInicio'] = converterDataIngles($data);
    }

    public function getFpaInicioAttribute() {
        return converterDataBrasil($this->attributes['fpaInicio']);
    }

    public function setFpaFimAttribute($data) {
        $this->attributes['fpaFim'] = converterDataIngles($data);
    }

    public function getFpaFimAttribute() {
        return converterDataBrasil($this->attributes['fpaFim']);
    }

    public function getDisciplinasPorCursoAttribute(){
        $disciplinas_curso = $this
            ->disciplinas()
            ->distinct()
            ->selectRaw('
                cursos.id as id_curso,
                cursos.nome as curso,
                cursos.sigla as sigla_curso,
                disciplinas.id as id_disciplina,                 
                disciplinas.nome as disciplina, 
                disciplinas.sigla as sigla_disciplina
            ')
            ->join('cursos_disciplinas', 'disciplinas.id', '=', 'cursos_disciplinas.disciplina_id')
            ->join('cursos', 'cursos.id', '=', 'cursos_disciplinas.curso_id')->get(['cursos.id'])->toArray();
        
        $disciplinas_curso_sem_pivot = array_map(function($curso_com_pivot) {
            $curso_com_pivot = (array) $curso_com_pivot;
            unset($curso_com_pivot['pivot']);
            return [$curso_com_pivot['id_curso'] => [
                'id'    => $curso_com_pivot['id_curso'],
                'nome'  => $curso_com_pivot['curso'],
                'sigla' => $curso_com_pivot['sigla_curso'],
                'disciplina' => [
                    'id'    => $curso_com_pivot['id_disciplina'], 
                    'nome'  => $curso_com_pivot['disciplina'],
                    'sigla' => $curso_com_pivot['sigla_disciplina'],
                ]
            ]];
        }, $disciplinas_curso);

        foreach($disciplinas_curso_sem_pivot as $chave => $disciplina){
            $disciplina = (array) ($disciplina);
            $curso = array_keys($disciplina)[0];
            $disciplinas_curso_formatada[$curso]['id']  = $disciplina[$curso]['id'];            
            $disciplinas_curso_formatada[$curso]['nome']  = $disciplina[$curso]['nome'];
            $disciplinas_curso_formatada[$curso]['sigla'] = $disciplina[$curso]['sigla'];
            $disciplinas_curso_formatada[$curso]['disciplinas'][] = $disciplina[$curso]['disciplina'];
        }
        return isset($disciplinas_curso_formatada) ? $disciplinas_curso_formatada : [];
    }

    public static function FpaAtivo(){
        $data_atual = date('Y-m-d');
        
        return Semestre::
              where('fpaInicio', '<', $data_atual)
            ->where('fpaFim'   , '>', $data_atual)
            ->firstOrFail();
    }

}
