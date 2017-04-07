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
    
    public function deletar($id){
        try {
            DB::transaction(function () use ($id) {
                $disciplina = Disciplina::find($id);

                $disciplina->delete();
            }, 3);

            return redirect()->route('disciplinas')->with('success', 'Disciplina excluída');
        } catch (\Exception $e) {
            return redirect()->route('disciplinas')->with('error', 'Falha ao excluir');
        }
    }

    public function salvar(Request $request){
        try{
            $dataForm = $request->all();

            DB::transaction(function () use ($dataForm) {
                foreach ($dataForm['nome'] as $key => $nome){
                    Disciplina::create(array("nome" => $nome, "iniciais" => $dataForm['iniciais'][$key], "cargaHoraria" => $dataForm['cargaHoraria'][$key]));
                }
            }, 3);

            return redirect()->route('disciplinas')->with('success', 'Disciplina cadastrada');

        }catch(\Exception $e){
            return redirect()->route('disciplina.cadastrar')->with('error', 'Falha ao cadastrar');
        }
    }

    public function atualizar(Request $request, $id){
        try{
            $dataForm = $request->all();

            DB::transaction(function () use ($dataForm, $id) {
                $disciplina = Disciplina::find($id);
                $disciplina->update(array("nome" => $dataForm['nome'][0], "iniciais" => $dataForm['iniciais'][0],  "cargaHoraria" => $dataForm['cargaHoraria'][0]));
            }, 3);

            return redirect()->route('disciplinas')->with('success', 'Disciplina editada');

        }catch(\Exception $e){
            return redirect()->route('disciplina.editar', $id)->with('error', 'Falha ao editar');
            echo $e;
        }
    }
}
