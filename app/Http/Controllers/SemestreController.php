<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semestre;
use Illuminate\Support\Facades\DB;

class SemestreController extends Controller
{

    public function index(){
    	$semestres = Semestre::orderBy('nome', 'desc')->paginate();

    	return view('semestre.index', compact('semestres'));
    }

    public function cadastrar(){
    	return view('semestre.formSemestre');
    }

    public function salvar(Request $request){
    		$dataForm = $request->all();

    		Semestre::create($dataForm);

    		return redirect()->route('semestres')->with('success', 'Inclusão realizada com sucesso');
    }

    public function editar($id){
    	$semestre = Semestre::find($id);

    	return view('semestre.formSemestre', compact('semestre'));
    }

    public function atualizar(Request $request, $id){
    		$dataForm = $request->all();

    		$semestre = Semestre::findOrFail($id);
    		$semestre->update($dataForm);

    		return redirect()->route('semestres')->with('success', 'Edição realizada com sucesso');
    }

    public function deletar($id){
    		Semestre::findOrFail($id)->delete(); // FIXIT: findOrFail aqui pode ser trocado por teste de null com ida para sucesso direto;

    		return redirect()->route('semestres')->with('success', 'Exclusão realizada com sucesso!');
    }
}
