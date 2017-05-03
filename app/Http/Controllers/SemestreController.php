<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Semestre;
use App\Models\Disciplina;
use App\Http\Requests\SemestreRequest;

class SemestreController extends Controller {

    public function index(){
    	$semestres = Semestre::orderBy('nome', 'desc')->paginate();
    	return view('semestre.index', compact('semestres'));
    }

    public function cadastrar(){
        $disciplinas = $this->getDisciplinasComCurso();
        $disciplina_id = array();
        return view('semestre.formSemestre', compact('disciplinas', 'disciplina_id'));
    }

    public function salvar(SemestreRequest $request){
        $dataForm = $request->all();

        DB::transaction(function() use ($dataForm){
            $semestre = Semestre::create($dataForm);

            if (isset($dataForm['disciplina_id'])) {
                foreach ($dataForm['disciplina_id'] as $disciplina) {
                    $semestre->disciplinas()->attach($disciplina);
                }
            }
        }, 3);

        return redirect()->route('semestres')->with('success', 'Inclusão realizada com sucesso');
    }

    public function editar($id){

        $disciplinas = $this->getDisciplinasComCurso();
        $semestre = Semestre::findOrFail($id);
        $disciplina_id = $semestre->disciplinas()->pluck('id')->toArray();

        return view('semestre.formSemestre', compact('semestre', 'disciplinas', 'disciplina_id'));
    }

    public function atualizar(SemestreRequest $request, $id){
        $dataForm = $request->all();

        DB::transaction(function() use ($dataForm, $id){
            $semestre = Semestre::findOrFail($id);
            $semestre->update($dataForm);
            $semestre->disciplinas()->sync(
                isset($dataForm['disciplina_id']) ? $dataForm['disciplina_id'] : []);
        }, 3);
        return redirect()->route('semestres')->with('success', 'Edição realizada com sucesso');
    }

    public function deletar($id){
        DB::transaction(function() use ($id){
            $semestre = Semestre::findOrFail($id);
            $semestre->delete();
        }, 3);
        return redirect()->route('semestres')->with('success', 'Exclusão realizada com sucesso!');
    }

    private function getDisciplinasComCurso(){
        $disciplinas = Disciplina::orderBy('nome', 'asc')->get();
        $disciplinas_formatada = [];
        # o for retira todas as disciplinas que não estão vinculadas com nenhum curso
        foreach ($disciplinas as $key => $disciplina) {
            if(empty($disciplina->cursos[0])){
                unset($disciplinas[$key]);
            } else {
                foreach($disciplina->cursos as $curso){
                    $disciplinas_formatada[$curso->nome][$disciplina->id] = $disciplina->nome.' ('.$disciplina->sigla.')';
                }
            }
        }

        return $disciplinas_formatada;
    }
}
