<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{

    public function index(){
    	$cargos = Cargo::orderBy('nome', 'desc')->paginate();

    	return view('cargo.index', compact('cargos'));
    }

    public function cadastrar(){
    	return view('cargo.formCargo');
    }

    public function salvar(Request $request){
    		$data = $request->all();
    		Cargo::create($data);

    		return redirect()->route('cargos')->with('success', 'Inclusão realizada com sucesso');
    }

    public function editar($id){
    	$cargo = Cargo::findOrFail($id);

    	return view('cargo.formCargo', compact('cargo'));
    }

    public function atualizar(Request $request, $id){
    		$data = $request->all();
    		$cargo = Cargo::findOrFail($id);
    		$cargo->update($data);

    		return redirect()->route('cargos')->with('success', 'Edição realizada com sucesso');
    }

    public function deletar($id){
    		Cargo::findOrFail($id)->delete();

    		return redirect()->route('cargos')->with('success', 'Exclusão realizada com sucesso!');
    }
}