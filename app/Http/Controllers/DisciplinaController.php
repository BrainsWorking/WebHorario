<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{
    
    public function index(){
        $disciplinas = Disciplina::orderBy('nome', 'asc')->paginate();
        
        return view('disciplina.index', compact('disciplinas'));
    }

    public function editar($id) {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplina.formDisciplina', compact('disciplina', 'id'));
    }

    public function cadastrar(){
        return view('disciplina.formDisciplina');
    }
    
    public function deletar($id){
        DB::transaction(function () use ($id) {
            $disciplina = Disciplina::findOrFail($id); // # FIXIT: findOrFail aqui pode ser trocado por teste de null com sucesso direto;

            $disciplina->delete();
        }, 3);

        return redirect()->route('disciplinas')->with('success', 'Disciplina excluída');
    }

    public function salvar(Request $request){
        $dataForm = $request->all();
        
        DB::transaction(function () use ($dataForm) {
            foreach ($dataForm['nome'] as $key => $nome){
                Disciplina::create(array("nome" => $nome, "sigla" => $dataForm['sigla'][$key], "aulasSemanais" => $dataForm['aulasSemanais'][$key]));
            }
        }, 3);

        return redirect()->route('disciplinas')->with('success', 'Disciplina cadastrada');
    }

    public function atualizar(Request $request, $id){
        $dataForm = $request->all();

        DB::transaction(function () use ($dataForm, $id) {
            $disciplina = Disciplina::find($id);
            $disciplina->update(array("nome" => $dataForm['nome'][0], "sigla" => $dataForm['sigla'][0],  "aulasSemanais" => $dataForm['aulasSemanais'][0]));
        }, 3);

        return redirect()->route('disciplinas')->with('success', 'Disciplina editada');
    }
}
