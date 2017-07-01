<?php

namespace App\Http\Controllers;

use App\Models\Fpa;
use App\Models\AtribuicaoHorario;
use App\Models\Semestre;
use App\Models\Horario;
use App\Models\Disciplina;
use App\Models\Funcionario;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AtribuicaoHorarioController extends Controller{
    
    public function index(){
        return view('welcome');
    }

    public function cadastrar(){
        
        $atribuicao = AtribuicaoHorario::where('atribuicoes_horarios.semestre_id', '=', Semestre::FpaAtivo()->id)->where('atribuicoes_horarios.curso_id', '=', Auth::user()->curso->id)->get();

        $funcionario = Auth::user();
        $semestre = Semestre::FpaAtivo();

        if (!$funcionario->isCoordenador()) {
            return redirect()->back()->withError('Somente coordenadores do curso podem editar');
        }

        if(is_null($semestre)){
            return redirect()->back()->withError('Não há nenhum FPA aberto no momento');
        }

        $curso = $funcionario->curso;

        $modulos = $semestre->modulos;
        foreach ($modulos as $key => $modulo) {
            if ($modulo['curso_id'] != $curso->id) {
                unset($modulos[$key]);
            }
        }
        
        $horarios = $curso->turno->horarios;        

        $dias_semana = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];

        $disciplinas_semestre = $semestre->disciplinasPorCurso()[$curso->nome]; //fazer filtro somente para o curso atual
        $disciplinas = [];
        foreach ($disciplinas_semestre as $key => $disciplina) {
            $disciplinas[] = Disciplina::find($disciplina['id']);
        }

        if(is_null($atribuicao)){
             return view('atribuicao.atribuicao_horarios', compact('disciplinas', 'dias_semana', 'semestre', 'horarios', 'curso', 'modulos'));
        }
        else{
            // $disponibilidadeChecada = $fpa->horarios()->pluck('id');
            // $disciplinasSelecionadas = $fpa->disciplinas()->pluck('id');
            // dd($atribuicao);
            return view('atribuicao.atribuicao_horarios', compact('disciplinas', 'dias_semana', 'semestre', 'horarios', 'curso', 'modulos'));
        }
    }

    public function salvar(Request $request){
        $data = $request->all();
        $semestre_id = Semestre::FpaAtivo()->id;
        $curso_id = Auth::user()->curso->id;
        DB::transaction(function () use ($data, $semestre_id, $curso_id) {
            foreach ($data['atrb_horarios'] as $horario => $disciplinas) {
                foreach ($disciplinas as $dia_semana => $disciplina) {
                    if (!is_null($disciplina)) {
                        AtribuicaoHorario::create(array("horario_id" => $horario, "semestre_id" => $semestre_id, "disciplina_id" => $disciplina, "dia_semana" => $dia_semana, "curso_id" => $curso_id));
                    }   
                }                
            }
        });        
        return redirect()->back()->with('success', 'Horários salvos com sucesso!');
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
