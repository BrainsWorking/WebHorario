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

	    	$curso = Curso::create($dataForm);

	    	foreach ($dataForm['disciplina_id'] as $disciplina) {
	    		$curso->disciplinas()->attach($disciplina);
	    	}

	    	return redirect()->route('cursos');
    	}catch(\Exception $e){
    		//return redirect()->route('curso.cadastrar');
            dd($e);
    	}
    }

    public function editar($id){
    	$turnos = Turno::pluck('nome', 'id');

        $disciplinas = Disciplina::pluck('nome', 'id');

        $curso = Curso::find($id);

        $disciplina_id = array();

        $disciplina_id = Curso::find($id)->disciplinas()->pluck('id')->toArray();

        return view('curso.formCurso', compact('turnos', 'disciplinas', 'curso', 'disciplina_id'));
    }

    public function atualizar(Request $request, $id){
        try{
            $dataForm = $request->all();

            $curso = Curso::find($id);

            $curso->update($dataForm);

            $curso->disciplinas()->sync($dataForm['disciplina_id']);

            return redirect()->route('cursos');
        }catch(\Exception $e){
            dd($e);
            return redirect()->route('curso.editar', $id);
        }
    }

    public function deletar($id){
        try {
            $curso = Curso::find($id);

            $curso->delete();

            return redirect()->route('cursos');
        } catch (\Exception $e) {
            return redirect()->route('cursos')->with('error', 'Erro na exclusão!');
        }
    }
}
