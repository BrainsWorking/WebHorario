<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
	private $totalPorPag = 10;

    public function index(){
    	$cargos = Cargo::orderBy('nome', 'desc')->paginate($this->totalPorPag);
    	return view('cargo.index', compact('cargos'));
    }

    public function cadastrar(){
    	return view('cargo.formCargo');
    }

    public function salvar(Request $request){
    	try {
    		$dataForm = $request->all();
    		DB::transaction(function () use ($dataForm) {
    			Cargo::create($dataForm);
    		}, 3);
    		return redirect()->route('cargos')->with('success', 'Inclusão realizada com sucesso');
    	} catch (\Exception $e) {
    		return redirect()->route('cargo.cadastrar')->with('error', 'Erro na inclusão!');
    	}
    }

    public function editar($id){
    	$cargo = Cargo::find($id);
    	return view('cargo.formCargo', compact('cargo'));
    }

    public function atualizar(Request $request, $id){
    	try {
    		$dataForm = $request->all();
    		DB::transaction(function () use ($dataForm, $id) {
    			$cargo = Cargo::find($id);
    			$cargo->update($dataForm);
    		}, 3);
    		return redirect()->route('cargos')->with('success', 'Edição realizada com sucesso');
    	} catch (\Exception $e) {
    		return redirect()->route('cargo.editar', $id)->with('error', 'Erro na edição!');
    	}
    }

    public function deletar($id){
    	try{
    		DB::transaction(function() use ($id){
    			Cargo::find($id)->delete();
    		}, 3);
    		return redirect()->route('cargos')->with('success', 'Exclusão realizada com sucesso!');
    	}catch(\Exception $e){
    		return redirect()->route('cargos')->with('error', 'Erro na exclusão!');
    	}
    }
}