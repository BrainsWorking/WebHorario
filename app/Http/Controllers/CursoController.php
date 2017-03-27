<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index() {
        $cursos[] = (object)['nome' => 'Análise e Desenvolvimento de Sistemas', 'iniciais' => 'ADS', 'turno' => 'Noturno', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
        $cursos[] = (object)['nome' => 'Edificações', 'iniciais' => 'EDF', 'turno' => 'Vespertino', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
        $cursos[] = (object)['nome' => 'Matemática', 'iniciais' => 'MAT', 'turno' => 'Matutino', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
        
        return view('curso.index', compact('cursos'));
    }
}
