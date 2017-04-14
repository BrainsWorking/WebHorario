<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FuncionarioController extends Controller {

  public function index() { 
    $funcionarios = Funcionario::orderBy('nome', 'asc')->paginate();

    return view('funcionario.index', compact('funcionarios')); 
  }

  public function cadastrar() {
    $cargos = Cargo::pluck('nome', 'id');

    return view('funcionario.formFuncionario', compact('cargos'));
  }

  public function salvar(Resquest $request) {
    DB::transaction(function () use ($request) {
      $funcionario = Funcionario::create($request->all());
      $funcionario->cargos()->sync($request->only('cargos'));
    }, 3);

    return redirect()->route('funcionarios')->withSuccess('Funcionário cadastrado com sucesso!');
  }

  public function editar($id = null) {
    $cargos = Cargo::pluck('nome', 'id');
    $funcionario = is_null($id) ? Auth::user() : Funcionario::findOrFail($id);

    return view('funcionario.formFuncionario', compact('cargos', 'funcionario'));
  }

  public function atualizar (Request $request, $id){
    $funcionario = Funcionario::findOrFail($id);
    $funcionario->update($request->all());

    return redirect()->route('funcionarios')->withSuccess('Funcionário atualizado com sucesso!');
  }

  public function deletar($id){
    $funcionario = Funcionario::findOrFail($id)->delete();

    return redirect()->route('funcionarios')->withSuccess('Funcionário desativado com sucesso!');
  }

}
