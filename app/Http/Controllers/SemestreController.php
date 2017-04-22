<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\Disciplina;
use Illuminate\Support\Facades\DB;

class SemestreController extends Controller
{

    public function index(){
    	$semestres = Semestre::orderBy('nome', 'desc')->paginate();

    	return view('semestre.index', compact('semestres'));
    }

    public function cadastrar(){
        $disciplinas = Disciplina::orderBy('nome', 'asc')->pluck('nome', 'id');
        $disciplina_id = array();
        return view('semestre.formSemestre', compact('disciplinas', 'disciplina_id'));
    }

    public function salvar(Request $request){
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
        $disciplinas = Disciplina::orderBy('nome', 'asc')->pluck('nome', 'id');
        $semestre = Semestre::find($id);
        $disciplina_id = $semestre->disciplinas()->pluck('id')->toArray();

        return view('semestre.formSemestre', compact('semestre', 'disciplinas', 'disciplina_id'));
    }

    public function atualizar(Request $request, $id){
        $dataForm = $request->all();

        DB::transaction(function() use ($dataForm, $id){
            $semestre = Semestre::find($id);
            $semestre->update($dataForm);
            $semestre->disciplinas()->sync(
                isset($dataForm['disciplina_id']) ? $dataForm['disciplina_id'] : []);
        }, 3);
        return redirect()->route('semestres')->with('success', 'Edição realizada com sucesso');
    }

    public function deletar($id){
        DB::transaction(function() use ($id){
            $semestre = Semestre::find($id);
            $semestre->delete();
        }, 3);
        return redirect()->route('semestres')->with('success', 'Exclusão realizada com sucesso!');
    }
}
