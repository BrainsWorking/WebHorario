<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semestre;
use Illuminate\Support\Facades\DB;

class SemestreController extends Controller
{
	private $totalPorPag = 10;

    public function index(){

    	$semestres = Semestre::orderBy('nome', 'desc')->paginate($this->totalPorPag);

    	return view('semestre.index', compact('semestres'));

    }

    public function cadastrar(){

    	return view('semestre.formSemestre');

    }

    public function salvar(Request $request){

    	try {
    		$dataForm = $request->all();

    		DB::transaction(function () use ($dataForm) {
    			
    			Semestre::create($dataForm);

    		}, 3);

    		return redirect()->route('semestres')->with('success', 'Inclusão realizada com sucesso');

    	} catch (\Exception $e) {
    		return redirect()->route('semestre.cadastrar')->with('error', 'Erro na inclusão!');
    	}
    }

    public function editar($id){
    	$semestre = Semestre::find($id);

    	return view('semestre.formSemestre', compact('semestre'));
    }

    public function atualizar(Request $request, $id){
    	try {
    		$dataForm = $request->all();

    		DB::transaction(function () use ($dataForm, $id) {
    			$semestre = Semestre::find($id);

    			$semestre->update($dataForm);

    		}, 3);

    		return redirect()->route('semestres')->with('success', 'Edição realizada com sucesso');

    	} catch (\Exception $e) {
    		return redirect()->route('semestre.editar', $id)->with('error', 'Erro na edição!');
    	}
    }

    public function deletar($id){
    	try{
    		DB::transaction(function() use ($id){
    			Semestre::find($id)->delete();
    		}, 3);

    		return redirect()->route('semestres')->with('success', 'Exclusão realizada com sucesso!');

    	}catch(\Exception $e){
    		return redirect()->route('semestres')->with('error', 'Erro na exclusão!');
    	}
    }
}
