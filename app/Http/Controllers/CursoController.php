<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Disciplina;

class CursoController extends Controller
{
	private $totalPorPag = 10;
	private $curso;

	function __construct(Curso $curso) {
        $this->curso = $curso;
        $this->totalPorPag = 10;
    }

    public function index() {
        /*$cursos[] = (object)['nome' => 'Análise e Desenvolvimento de Sistemas', 'iniciais' => 'ADS', 'turno' => 'Noturno', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
        $cursos[] = (object)['nome' => 'Edificações', 'iniciais' => 'EDF', 'turno' => 'Vespertino', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
        $cursos[] = (object)['nome' => 'Matemática', 'iniciais' => 'MAT', 'turno' => 'Matutino', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];*/
        $cursos = $this->curso->orderBy('nome', 'asc')->paginate($this->totalPorPag);
        
        return view('curso.index', compact('cursos'));
    }

    public function cadastrar(){
    	$turnos = Turno::pluck('nome', 'id');

    	$disciplinas = Disciplina::pluck('nome', 'id');

    	return view('curso.formCurso', compact('turnos', 'disciplinas'));
    }

    public function salvar(Request $request){

    }

    public function editar($id){
    	return 'editar';
    }
}
