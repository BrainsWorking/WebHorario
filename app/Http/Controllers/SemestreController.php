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
    			
    		Semestre::create($dataForm);

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

    		$semestre = Semestre::find($id);

    		$semestre->update($dataForm);

    		return redirect()->route('semestres')->with('success', 'Edição realizada com sucesso');

    	} catch (\Exception $e) {
    		return redirect()->route('semestre.editar', $id)->with('error', 'Erro na edição!');
    	}
    }

    public function deletar($id){
    	try{

    		Semestre::find($id)->delete();

    		return redirect()->route('semestres')->with('success', 'Exclusão realizada com sucesso!');

    	}catch(\Exception $e){
    		return redirect()->route('semestres')->with('error', 'Erro na exclusão!');
    	}
    }
}
