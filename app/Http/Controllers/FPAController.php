<?php

namespace App\Http\Controllers;

use App\Models\Fpa;
use App\Models\Semestre;
use App\Models\Horario;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;

class FPAController extends Controller{
    
    public function index(){
        return view('welcome');
    }

    public function cadastrar(){
        
        $fpa = Fpa::where('fpas.semestre_id', '=', Semestre::FpaAtivo()->id)->where('fpas.funcionario_id', '=', Auth::user()->id)->first();
        $funcionario = Auth::user();
        $semestre = Semestre::FpaAtivo();

        if(is_null($semestre)){
            return redirect()->back()->withError('Não há nenhum FPA aberto no momento');
        }

        $disciplinas = $semestre->disciplinas;

        $horarios = Horario::orderBy('inicio')->get();
        $horarios_manha = $horarios_tarde = $horarios_noite = [];
        $meio_dia = strtotime('12:00');
        $por_sol  = strtotime('18:00');

        foreach($horarios as $horario){
            $hora = strtotime($horario->inicio);
            if($hora < $meio_dia){
                $horarios_manha[] = $horario;
            } 
            elseif($hora < $por_sol){
                $horarios_tarde[] = $horario;
            } 
            else{
                $horarios_noite[] = $horario;
            }
        }

        $dias_semana = ['seg', 'ter', 'qua', 'qui', 'sex', 'sab'];
        $disciplinas_curso = $semestre->disciplinasPorCurso();

        if($fpa == null){
             return view('fpa.cadastrar', compact('disciplinas_curso', 'horarios_manha', 'horarios_tarde', 'horarios_noite', 'dias_semana', 'semestre', 'funcionario'));
        }
        else{
            $disponibilidadeChecada = $fpa->horarios()->get();
            $disciplinasSelecionadas = $fpa->disciplinas()->get();
            //limpando a variavel de disciplinas por curso;
            foreach ($disciplinas_curso as $key_curso => $curso) {
                foreach ($curso as $key_disciplina => $disciplina) {
                    foreach ($disciplinasSelecionadas as $disciplina_selecionada) {
                        if ($disciplina_selecionada->id == $disciplina['id']) {
                            unset($disciplinas_curso[$key_curso][$key_disciplina]);
                        }
                    }
                }
            }
            return view('fpa.cadastrar', compact('disciplinas_curso', 'disciplinasSelecionadas', 'disponibilidadeChecada', 'horarios_manha', 'horarios_tarde', 'horarios_noite', 'dias_semana', 'semestre', 'funcionario'));
        }
    }

    public function salvar(Request $request){

        $fpa = Fpa::create([
            "carga_horaria" => $request->input('regimeTrabalho'),
            "semestre_id" => Semestre::FpaAtivo()->id,
            "funcionario_id" => Auth::user()->id
        ]);

        $prioridade = 1;
        $disciplinas = $request->input('componentes');
        foreach($disciplinas as $disciplina_id){
            $disciplinas = Disciplina::find($disciplina_id);
            $fpa->disciplinas()->attach($disciplinas, ["prioridade" => $prioridade]);
            $prioridade++;
        }

        $disponibilidade = $request->input('disp');
        foreach($disponibilidade as $dia_semana => $horarios){          
            foreach($horarios as $horario_id){
                $horario = Horario::find($horario_id);
                $fpa->horarios()->attach($horario, ["dia_semana" => $dia_semana]);
            }
        }
        
        return redirect()->back();
    }

    public function atualizar(Request $request){

        $fpa = Fpa::where('fpas.semestre_id', '=', Semestre::FpaAtivo()->id)->where('fpas.funcionario_id', '=', Auth::user()->id)->first();
        $fpa->carga_horaria = $request->input('regimeTrabalho');
        $fpa->update();

        $fpa->disciplinas()->sync([]);
        $fpa->horarios()->sync([]);

        $prioridade = 1;
        $disciplinas = $request->input('componentes');
        foreach($disciplinas as $disciplina_id){
            $disciplinas = Disciplina::find($disciplina_id);
            $fpa->disciplinas()->attach($disciplinas, ["prioridade" => $prioridade]);
            $prioridade++;
        }

        $disponibilidade = $request->input('disp');
        foreach($disponibilidade as $dia_semana => $horarios){          
            foreach($horarios as $horario_id){
                $horario = Horario::find($horario_id);
                $fpa->horarios()->attach($horario, ["dia_semana" => $dia_semana]);
            }
        }
        
        return redirect()->back();

    }

}
