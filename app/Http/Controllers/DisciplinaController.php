<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{
    private $totalPorPag = 20;
    
    public function index(){
        
        $disciplinas = Disciplina::orderBy('nome', 'asc')->paginate($this->totalPorPag);
        
        return view('disciplina.index', compact('disciplinas'));
    }

    public function editar($id) {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplina.cadastrar', compact('disciplina', 'id'));
    }

    public function cadastrar(){
        return view('disciplina.cadastrar');
    }
    
    public function deletar(){
        return view('disciplina.index');
    }

    public function salvar(Request $request){
        try{
            $dataForm = $request->all();

            DB::transaction(function () use ($dataForm) {
                foreach ($dataForm['nome'] as $key => $nome){
                    Disciplina::create(array("nome" => $nome, "iniciais" => $dataForm['iniciais'][$key]));
                }

            }, 3);
            return redirect()->route('disciplinas');
        }catch(\Exception $e){
            echo $e;die;
            return redirect()->route('disciplina.cadastrar');
        }
    }
}
