<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Semestre;
use App\Models\Disciplina;
use App\Http\Requests\SemestreRequest;
use App\Models\Modulo;

class SemestreController extends Controller {

    public function index(){
    	$semestres = Semestre::orderBy('nome', 'desc')->paginate();
    	return view('semestre.index', compact('semestres'));
    }

    public function cadastrar(){
        //$disciplinas = $this->getDisciplinasComCurso();
        //$disciplina_id = array();

        $modulos = $this->getModulosDosCursos();
        $modulo_id = array();

        return view('semestre.formSemestre', compact('modulos', 'modulo_id'));
    }

    public function salvar(SemestreRequest $request){
        $dataForm = $request->all();

        DB::transaction(function() use ($dataForm){
            $semestre = Semestre::create($dataForm);

            if (isset($dataForm['modulo_id'])) {
                foreach ($dataForm['modulo_id'] as $modulo) {
                    $semestre->modulos()->attach($modulo);
                }
            }
        }, 3);

        return redirect()->route('semestres')->with('success', 'Inclusão realizada com sucesso');
    }

    public function editar($id){

        $modulos = $this->getModulosDosCursos();
        $semestre = Semestre::findOrFail($id);
        $modulo_id = $semestre->modulos()->pluck('modulos.id')->toArray();

        return view('semestre.formSemestre', compact('semestre', 'modulos', 'modulo_id'));
    }

    public function atualizar(SemestreRequest $request, $id){
        $dataForm = $request->all();

        DB::transaction(function() use ($dataForm, $id){
            $semestre = Semestre::findOrFail($id);
            $semestre->update($dataForm);
            $semestre->modulos()->sync(
                isset($dataForm['modulo_id']) ? $dataForm['modulo_id'] : []);
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

    private function getModulosDosCursos(){
        foreach (Modulo::orderBy('nome', 'asc')->get() as $mod) {
            $modulos[$mod->curso->nome][$mod->id] = $mod->nome;
        }

        return $modulos;
    }
}
