<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InstituicaoController extends Controller
{
    private $totalPorPag = 10;

    public function index(){
        $instituicoes = Instituicao::orderBy('nome', 'asc')->paginate($this->totalPorPag);
        return view('instituicao.index', compact(instituicoes));        
    }

    public function cadastrar(){
        return view('instituicao.cadastrar');
    }

    public function editar($id){
        $instituicao = Instituicao::findOrFail($id);
        return view('instituicao.cadastrar', compact('instituicao', 'id'));
    }

    public function salvar(Request $request){
        try{
            $dataForm = $request->all();
            DB::transaction(function () use ($dataForm) {
                foreach ($dataForm['nome'] as $key => $nome){
                    Instituicao::create(array('nome' => $nome, 'cnpj' -> $dataForm['cnpj'][$key]));
                }
            }, 3);

            return redirect()->route('instituicoes')->with('success', 'Disciplina cadastrada.');
        }    
        catch(\Exception $e){
            return redirect()->route('instituicao.cadastrar')->with('error', 'Falha ao cadastrar.');
        }
    }

    public function atualizar(){
        try{
            $dataForm = $request->all();
            DB::transaction(function () use ($dataForm) {
                $instituicao = Instituicao::find($id); 
                $instituicao->update(array('nome' => $dataForm('nome')[0], 'cnpj' -> $dataForm['cnpj'][0]));
            }, 3);

            return redirect()->route('instituicoes')->with('success', 'Disciplina editada.');
        }    
        catch(\Exception $e){
            return redirect()->route('instituicao.editar')->with('error', 'Falha ao editar.');
        }
    }

    public function deletar(){
        try{
            DB::transaction(function () use ($id) {
                $instituicao = Instituicao::find($id);
                $instituicao->delete();
            }, 3);
            return redirect()->route('instituicoes')->with('success', 'Instituicão excluída');
        }
        catch(\Exception $e){
            return redirect()->route('instituicoes')->with('error', 'Falha ao excluir.');
        }
    }
}
