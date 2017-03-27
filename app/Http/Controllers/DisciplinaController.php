<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index(){
        $disciplinas[] = (object)['nome' => 'Lógica de Programação', 'iniciais' => 'LOP', 'cargaHoraria' => '200'];
        $disciplinas[] = (object)['nome' => 'Matemática Discreta I', 'iniciais' => 'MD1', 'cargaHoraria' => '200'];
        $disciplinas[] = (object)['nome' => 'Linguagem de Programação', 'iniciais' => 'LOP', 'cargaHoraria' => '200'];
        
        return view('disciplinas.index', compact('disciplinas'));
    }
}
