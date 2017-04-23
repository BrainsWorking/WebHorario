<?php

namespace App\Http\Controllers;

use App\Models\FPA;
use App\Models\Disciplina;
use App\Models\Horario;
use Illuminate\Http\Request;

class FPAController extends Controller{
    
    public function index(){
        return view('welcome');
    }

    public function salvar(Request $request){
        Fpa::firstOrCreate($request->all());
    }

    public function cadastrar(){
        $disciplinas = Disciplina::all();
        $horarios = Horario::orderBy('inicio')->get();
        
        $horarios_manha = $horarios_tarde = $horarios_noite = [];
        $meio_dia = strtotime('12:00');
        $por_sol = strtotime('18:00');
        foreach($horarios as $horario) {
            $hora = strtotime($horario->inicio);
            if($hora < $meio_dia){
                $horarios_manha[] = $horario;
            } elseif($hora < $por_sol) {
                $horarios_tarde[] = $horario;
            } else {
                $horarios_noite[] = $horario;
            }
        }

        $dias_semana = ['seg', 'ter', 'qua', 'qui', 'sex', 'sab'];

        return view('fpa.cadastrar', compact('disciplinas', 'horarios_manha', 'horarios_tarde', 'horarios_noite', 'dias_semana'));
    }

    public function deletar($id){
        Fpa::findOrFail($id) -> delete();
    }

}
