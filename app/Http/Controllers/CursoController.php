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
        $curso = new Curso();

        $cursos = $curso->orderBy('nome', 'asc')->paginate($this->totalPorPag);
        
        return view('curso.index', compact('cursos'));
    }

    public function cadastrar(){
    	$turnos = Turno::pluck('nome', 'id');

    	$disciplinas = Disciplina::pluck('nome', 'id');

    	return view('curso.formCurso', compact('turnos', 'disciplinas'));
    }

    public function salvar(Request $request){
    	$curso = new Curso();

    	$dataForm = $request->all();

    	$insert = $curso->create($dataForm);

        if ($insert) {
            //return redirect()->route('disciplinas.index');
            return 'deu certo';
        } else {
            //return redirect()->route('disciplina.formCurso');
            return 'erro';
        }
    }

    public function editar($id){
    	return 'editar';
    }
}
