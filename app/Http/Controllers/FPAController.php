<?php

namespace App\Http\Controllers;

use App\Models\Fpa;
use App\Models\Semestre;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;

class FPAController extends Controller{
    
    public function index(){
        return view('welcome');
    }

    public function salvar(Request $request){
        $data = $request->all();
        $componentes     = $data['componentes'];
        $disponibilidades = $data['disp'];
        $carga_horaria = $data['regimeTrabalho'];

        $FPA = Fpa::create(['carga_horaria' => $carga_horaria]);

        foreach($disponibilidade as $disponibilidades){
            foreach($disponibilidades as $dia => $horarios_disponiveis){
                foreach($horarios_disponiveis as $horario_disponivel){
				    $FPA->horarios()->attach($horario, ['dia_semana' => $dia]);
                }
            }
        }
        
        foreach($componentes as $prioridade => $disciplina){
            $FPA->disciplinas()->attach($disciplina, ['prioridade' => $prioridade]);
        }

        return redirect()->back();
    }

    public function cadastrar(){
        $semestre = Semestre::FpaAtivo();

        $disciplinas = $semestre->disciplinas;

        $horarios = Horario::orderBy('inicio')->get();
        $horarios_manha = $horarios_tarde = $horarios_noite = [];
        $meio_dia = strtotime('12:00');
        $por_sol  = strtotime('18:00');

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

        return view('fpa.cadastrar', compact('disciplinas', 'horarios_manha', 'horarios_tarde', 'horarios_noite', 'dias_semana', 'semestre', 'funcionario'));
    }

    public function deletar($id){
        Fpa::findOrFail($id)->delete();
    }

}