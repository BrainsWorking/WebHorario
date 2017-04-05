<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;

class TurnoController extends Controller
{
    public function index() {
        $turnos = Turno::join('Horarios', 'Turnos.id', '=', 'Horarios.id')->get();

        return view('turno.index', compact('turnos'));
    }

    public function editar($id) {
        $turno = Turno::findOrFail($id);
        return view('turno.editar', compact('turno', 'id'));
    }
    
    public function cadastrar(){
        return view('turno.cadastrar');
    }

    public function salvar(Request $request){
        $turno = Turno::firstOrCreate($request->only(['nome']));

        $horarios = $request->except(['nome', '_token']);
        $horarios = $horarios['turnos_horarios'];

        for($i = 0; $i < count($horarios); $i = $i + 2){
            $temp = array("inicio" => $horarios[$i], "fim" => $horarios[$i+1]);
            $horario = Horarios::firstOrCreate($temp);
            $turno->horario()->attach($horario);
        }
    }

    public function deletar(){

    }
}
