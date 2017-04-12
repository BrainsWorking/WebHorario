<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Disciplina;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
	private $totalPorPag = 10;

    public function index() {

        $cursos = Curso::orderBy('nome', 'asc')->paginate($this->totalPorPag);
        
        return view('curso.index', compact('cursos'));
    }

    public function cadastrar(){
    	$turnos = Turno::pluck('nome', 'id');

    	$disciplinas = Disciplina::pluck('nome', 'id');

        $disciplina_id = array();

    	return view('curso.formCurso', compact('turnos', 'disciplinas', 'disciplina_id'));
    }

    public function salvar(Request $request){
    	try{
            $dataForm = $request->all();

            DB::transaction(function () use ($dataForm) {
    	    	$curso = Curso::create($dataForm);

    	    	foreach ($dataForm['disciplina_id'] as $disciplina) {
    	    		$curso->disciplinas()->attach($disciplina);
    	    	}
            }, 3);
	    	return redirect()->route('cursos')->with('success', 'Inclusão realizada com sucesso');
    	}catch(\Exception $e){
    	    echo $e;die;
    		return redirect()->route('curso.cadastrar')->with('error', 'Erro na inclusão!');
    	}
    }

    public function editar($id){
    	$turnos = Turno::pluck('nome', 'id');

        $disciplinas = Disciplina::pluck('nome', 'id');

        $curso = Curso::find($id);

        $disciplina_id = Curso::find($id)->disciplinas()->pluck('id')->toArray();

        return view('curso.formCurso', compact('turnos', 'disciplinas', 'curso', 'disciplina_id'));
    }

    public function atualizar(Request $request, $id){
        try{
            $dataForm = $request->all();

            DB::transaction(function () use ($dataForm, $id) {
                $curso = Curso::find($id);

                $curso->update($dataForm);

                $curso->disciplinas()->sync($dataForm['disciplina_id']);
            }, 3);

            return redirect()->route('cursos')->with('success', 'Edição realizada com sucesso');
        }catch(\Exception $e){
            return redirect()->route('curso.editar', $id)->with('error', 'Erro na edição!');
        }
    }

    public function deletar($id){
        try {
            DB::transaction(function () use ($id) {
                $curso = Curso::find($id);

                $curso->delete();
            }, 3);

            return redirect()->route('cursos')->with('success', 'Exclusão realizada com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('cursos')->with('error', 'Erro na exclusão!');
        }
    }
}
