<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Disciplina;

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

    	return view('curso.formCurso', compact('turnos', 'disciplinas'));
    }

    public function salvar(Request $request){
    	try{
    		$dataForm = $request->all();

	    	$curso = Curso::create($dataForm);

	    	foreach ($dataForm['disciplina_id'] as $disciplina) {
	    		$curso->disciplinas()->attach($disciplina);
	    	}

	    	return redirect()->route('cursos.index');
    	}catch(\Exception $e){
    		return redirect()->route('curso.formCurso');
    	}
    }

    public function editar($id){
    	$turnos = Turno::pluck('nome', 'id');

        $disciplinas = Disciplina::pluck('nome', 'id');

        $curso = Curso::find($id);

        //tentei separar em outra variavel para ver se funcionava, mas tbm não deu em nada
        //$disciplinaCurso = $curso->disciplinas()->where('curso_id', $id);
        $disciplinaCurso = $curso->disciplinas();

        return view('curso.formCurso', compact('turnos', 'disciplinas', 'curso', 'disciplinaCurso'));
    }

    public function atualizar(Request $request){

    }
}
