<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Session;


class InstituicaoController extends Controller
{
    public function index(){
        $instituicao = Instituicao::count();

        if($instituicao == 0){
            return redirect()->route('instituicao.cadastrar');
        }else{
            $instituicao = Instituicao::get()->first();

            return redirect()->route('instituicao.editar', $instituicao->id);
        }

        return view('instituicao.index');        
    }

    public function cadastrar(){
        return view('instituicao.formInstituicao');
    }

    public function editar($id){
        $instituicao = Instituicao::findOrFail($id); // # FIXIT: findOrFail aqui pode ser trocado por teste de null com ida para cadastro;

        return view('instituicao.formInstituicao', compact('instituicao'));
    }

    public function salvar(Request $request){
        Instituicao::create($request->all());

        return redirect()->route('instituicao')->with('success', 'Instituição modificada.');
    }

    public function atualizar(Request $request, $id){
        $dataForm = $request->all();

        $instituicao = Instituicao::findOrFail($id);
        $instituicao->update($dataForm);

        return redirect()->route('instituicao')->with('success', 'Instituição editada.');
    }

    public function deletar($id){
        Instituicao::findOrFail($id)->delete();

        return redirect()->route('instituicao')->with('success', 'Exclusão realizada com sucesso.');
    }
}
