<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;

class FuncionarioController extends Controller {

  public function index() { 
    $cargos = Cargos::all();

    return view('funcionario.index', compact('cargos'))->paginate(); 
  }

  public function cadastrar(Request $request) {
    $cargos = Cargos::pluck('id', 'nome');

    return view('funcionario.formFuncionario', compact('cargos'));
  }

  public function salvar(Resquest $request) {
    Funcionario::create($request->all());

    return redirect()->route('funcionarios')->withSuccess('Funcionário cadastrado com sucesso!');
  }

  public function editar($id = null) {
    $cargos = Cargos::pluck('id', 'nome');
    $funcionario = is_null($id) ? Auth::user() : Funcionario::findOrFail($id);

    return view('funcionario.formFuncionario', compact('cargos', 'funcionario'));
  }

  public function atualizar (Request $request){
    $funcionario = Funcionario::findOrFail($id);
    $funcionario->fill($request);
    $funcionario->update();

    return redirect()->route('funcionarios')->withSuccess('Funcionário atualizado com sucesso!');
  }

  public function deletar($id){
    $funcionario = Funcionario::findOrFail($id)->delete();
  }

}
