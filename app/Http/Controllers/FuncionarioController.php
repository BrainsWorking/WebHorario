<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Funcionario;
use App\Models\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller {

  public function index() { 
    $funcionarios = Funcionario::orderBy('nome', 'asc')->paginate();

    return view('funcionario.index', compact('funcionarios')); 
  }

  public function cadastrar() {
    $cargos = Cargo::pluck('nome', 'id');

    return view('funcionario.formFuncionario', compact('cargos'));
  }

  public function salvar(Request $request) {
    DB::transaction(function () use ($request) {
      $funcionario = Funcionario::create($request->all());
      $funcionario->cargos()->sync($request->input('cargos'));

      foreach($request->input('telefone') as $numero){
        $telefone = new Telefone;
        $telefone->numero = $numero;
        $telefone->funcionario()->associate($funcionario);
        $telefone->save();
      }
    }, 3);

    return redirect()->route('funcionarios')->withSuccess('Funcionário cadastrado com sucesso!');
  }

  public function editar($id = null) {
    $cargos = Cargo::pluck('nome', 'id');
    $funcionario = is_null($id) ? Auth::user() : Funcionario::findOrFail($id);

    return view('funcionario.formFuncionario', compact('cargos', 'funcionario'));
  }

  public function atualizar (Request $request, $id){
    DB::transaction(function () use ($request, $id) {
      $funcionario = Funcionario::findOrFail($id);
      $funcionario->update($request->all());

      # FIXIT: Não é necessário deletar, mesmo que funcione, uma boa é editar o telefone mesmo
      #        Verificar se existe, criar ou atualizar
      foreach($funcionario->telefones as $telefone) {
        $telefone->delete();
      }

      foreach($request->only('telefone') as $telefone){
        $funcionario->telefones()->attach(Telefone::create($telefone));
      }
    }, 3);

    return redirect()->route('funcionarios')->withSuccess('Funcionário atualizado com sucesso!');
  }

  public function deletar($id){
    $funcionario = Funcionario::findOrFail($id);

    foreach($funcionario->telefones as $telefone) {
      $telefone->delete();
    }

    $funcionario->delete();

    return redirect()->route('funcionarios')->withSuccess('Funcionário desativado com sucesso!');
  }

}
