<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Curso;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;

class CoordenadorController extends Controller
{

    public function index(){
        $cursos = Curso::whereNotNull('funcionario_id')->get();
        return view('coordenador.index', compact('cursos'));
    }

    public function deletar($id){

        try {
            $curso = Curso::find($id);
            $curso->funcionario()->dissociate();
            $curso->save();

            return redirect()->route('coordenadores')->with('success', 'Exclusão realizada com sucesso');
        }catch (\Exception $e){
            return redirect()->route('coordenadores')->with('error', 'Erro na inclusão!');
        }
    }

    public function salvar(Request $request){
        try{
            $dataForm = $request->all();
            DB::transaction(function () use ($dataForm) {
                $curso = Curso::find($dataForm['curso']);
                $funcionario = Funcionario::find($dataForm['coordenador']);
                $curso->funcionario()->associate($funcionario);
                $curso->save();
            }, 3);

            return redirect()->route('coordenadores')->with('success', 'Inclusão realizada com sucesso');
        }catch (\Exception $e){
            dd($e);
            return redirect()->route('coordenador.cadastrar')->with('error', 'Erro na inclusão!');
        }
    }

    public function cadastrar(){
        $cursos = Curso::whereNull('funcionario_id')->pluck('nome', 'id');
        $funcionarios = Funcionario::pluck('nome', 'id');

        return view('coordenador.formCoordenador', compact('cursos', 'funcionarios'));
    }

    public function editar($id){
        $curso = Curso::find($id);
        $funcionarios = Funcionario::pluck('nome', 'id');

        return view('coordenador.formCoordenador', compact('funcionarios',  'curso'));
    }

    public function atualizar(Request $request, $id){
        try{
            $dataForm = $request->all();
            DB::transaction(function () use ($dataForm, $id) {
                $curso = Curso::find($id);
                $funcionario = Funcionario::find($dataForm['coordenador']);
                $curso->funcionario()->associate($funcionario);
                $curso->save();
            }, 3);

            return redirect()->route('coordenadores')->with('success', 'Edição realizada com sucesso');
        }catch (\Exception $e){
            dd($e);
            return redirect()->route('coordenador.editar', $id)->with('error', 'Erro na edição!');
        }
    }
}
