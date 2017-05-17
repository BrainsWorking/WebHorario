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
        return $this->belongsToMany(Disciplina::class, 'turmas')->withPivot('quantidade_alunos');
    }

    public function disciplinasPorCurso(){
        $disciplinas_por_curso = [];
        $disciplinas = $this->modulos()
            ->select(DB::raw('
                cursos.nome      as curso_nome,
                disciplinas.id   as disciplina_id,
                disciplinas.nome as disciplina_nome
            '))
            ->join('cursos',      'cursos.id', '=', 'modulos.curso_id')
            ->join('disciplinas', 'modulo.id', '=', 'disciplina.modulo_id')
            ->get();

            // $disciplinas[0] => [ 'curso_nome' => 'ADS', 'disciplina_id' => '1', 'disicplina_nome' => 'mat2' ]
            foreach($disciplinas as $disciplinas){
                $curso = $disciplina['curso_nome'];
                unset($disciplina['curso_nome']);

                $disciplinas_por_curso[$curso] = (object) [ 'id' => $disciplina['disciplina_id'], 'nome' => $disciplina['disciplina_nome'] ];
            }

            return $disciplinas_por_curso;
    }

    public function turmas(){
        return $this->hasMany(Turma::class, 'semestre_id');
    }
  
    public function fpas(){
        return $this->hasMany(Fpa::class);
    }
  
    public static function FpaAtivo(){
        $data_atual = date('Y-m-d');
        $semestre = Semestre::
              where('fpa_inicio', '<', $data_atual)
            ->where('fpa_fim'   , '>', $data_atual)
            ->first();

        return $semestre;
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
