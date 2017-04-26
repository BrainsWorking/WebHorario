<?php

namespace App\Http\Controllers;

use App\Models\Fpa;
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
        // $disciplina         = Disciplina::findOrFail($request->only('disciplina_id'));
        // $curso              = $disciplina->curso;
        // $turno              = $curso->turno;
        // $horarios           = $turno->horarios;
        // $horario_cadastrado = Horario::findOrFail($request->only('horario_id'));

        // $nome_turno      = $turno->nome;
        // $nome_disciplina = $disciplina->nome;

        // if(!in_array($request->only('horario_id'), $horarios)){
        //     return response("A disciplina $nome_disciplina não pertence ao turno $nome_turno");
        // }

        // $disciplinas_cadastradas = Semestre::FpaAtivo()
        //     ->where('funcionario_id', '=', Auth::user()->id)
        //     ->where('disciplina_id' , '=', $disciplina->id)->count();

        // if($disciplinas_cadastradas>=$disciplina->aulasSemanais){
        //     return response("O limite de aulas semanais para $nome_disciplina é de {$disciplina->aulasSemanais} e já foi preenchido,
        //     se deseja colocar esta disciplina no horário {$horario_cadastrado->inicio} - {$horario_cadastrado->fim}, verifique outro 
        //     horário onde esta disciplina deva ser removida");
        // }

        $dados = $request->all();
        $dados['funcionario_id'] = Auth::user()->id;
        $dados['semestre_id'] = Semestre::fpaAtivo()->id;
        Fpa::firstOrCreate($dados);

        return response($dados);
    }

    public function cadastrar(){
        $disciplinas = Semestre::FpaAtivo()->disciplinas;

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
        Fpa::findOrFail($id)->delete();
    }

}
