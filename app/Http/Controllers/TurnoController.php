<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;

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
        
        try{
            DB::transaction(function () use ($request) {
                
                $turno = Turno::firstOrCreate($request->only(['nome']));

                $horarios = $request->input('horario');
                
                foreach ($horarios as $horario) {
                    $horario = Horario::firstOrCreate($horario);
                
                    $turno->horarios()->attach($horario);
                }
            }, 3);
            
            return redirect()->route('turnos')->withSuccess('Turno cadastrado com sucesso');
        }catch(\Exception $e){
            return redirect()->route('turnos')->withError('Erro ao cadastrar turno');
        }
    }

    public function deletar(){

    }
}
