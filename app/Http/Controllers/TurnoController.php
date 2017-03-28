<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function index() {
        $turnos[] = (object)['nome' => 'Matutino', 'quantidade_aulas' => '5'];
        $turnos[] = (object)['nome' => 'Vespertino', 'quantidade_aulas' => '4'];
        $turnos[] = (object)['nome' => 'Noturno', 'quantidade_aulas' => '5'];

        return view('turno.index', compact('turnos'));
    }

    public function editar($id) {
        $turno = Turno::findOrFail($id);
        return view('turno.editar', compact('turno', 'id'));
    }
    
    public function cadastro(){
        return view('turno.cadastrar');
    }
}
