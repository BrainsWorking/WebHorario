<?php

namespace App\Http\Controllers;

use App\Models\FPA;
use App\Models\Semestre;
use App\Models\Disciplina;
use App\Models\Horario;
use App\Models\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FPAController extends Controller{
    
    public function index(){
        return view('welcome');
    }

    public function salvar(Request $request){
        Fpa::firstOrCreate($request->all());
    }

    public function cadastrar(){
        $disciplinas = Semestre::
            where('fpaInicio', '<' , date('Y-m-d'))
            ->where('fpaFim', '>', date('Y-m-d'))->firstOrFail()->disciplinas;
        

        //$disciplinas = Disciplina::all();
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

        $funcionario = Auth::user();

        return view('fpa.cadastrar', compact('disciplinas', 'horarios_manha', 'horarios_tarde', 'horarios_noite', 'dias_semana', 'funcionario'));
    }

    public function deletar($id){
        Fpa::findOrFail($id) -> delete();
    }

}
