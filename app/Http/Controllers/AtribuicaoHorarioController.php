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
        
        $atribuicao_horarios = AtribuicaoHorario::where('atribuicoes_horarios.semestre_id', '=', Semestre::FpaAtivo()->id)->where('atribuicoes_horarios.curso_id', '=', Auth::user()->curso->id)->get();

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

        $dias_semana = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB'];

        if (isset($semestre->disciplinasPorCurso()[$curso->nome])) {
            $disciplinas_semestre =  $semestre->disciplinasPorCurso()[$curso->nome];//fazer filtro somente para o curso atual
        }else{
            return redirect()->back()->withError('A atribuição deste curso não está disponivel, devido a não oferecer nenhum disciplina no semestre vigente. Verifique o cadastro do semestre');
        }
        
        $disciplinas = [];
        foreach ($disciplinas_semestre as $key => $disciplina) {
            $disciplinas[] = Disciplina::find($disciplina['id']);
        }

        if(empty($atribuicao_horarios[0])){            
            return view('atribuicao.atribuicao_horarios', compact('disciplinas', 'dias_semana', 'semestre', 'horarios', 'curso', 'modulos'));
        }
        else{
            return view('atribuicao.atribuicao_horarios', compact('atribuicao_horarios','disciplinas', 'dias_semana', 'semestre', 'horarios', 'curso', 'modulos'));
        }
    }

    public function salvar(Request $request){
        $data = $request->all()['atrb_horarios'];
        $semestre_id = Semestre::FpaAtivo()->id;
        $curso_id = Auth::user()->curso->id;
        DB::transaction(function () use ($data, $semestre_id, $curso_id) {
            foreach ($data as $key => $modulo) {
                foreach ($modulo as $horario => $disciplinas) {
                    foreach ($disciplinas as $dia_semana => $disciplina) {
                        if (!is_null($disciplina)) {
                            AtribuicaoHorario::create(array("horario_id" => $horario, "semestre_id" => $semestre_id, "disciplina_id" => $disciplina, "dia_semana" => $dia_semana, "curso_id" => $curso_id));
                        }   
                    }                
                }
            }
        });        
        return redirect()->back()->with('success', 'Horários salvos com sucesso!');
    }

    public function atualizar(Request $request){
        $data = $request->all()['atrb_horarios'];
        $semestre_id = Semestre::FpaAtivo()->id;
        $curso_id = Auth::user()->curso->id;

        $atribuicao_horarios = AtribuicaoHorario::where('atribuicoes_horarios.semestre_id', '=', Semestre::FpaAtivo()->id)->where('atribuicoes_horarios.curso_id', '=', Auth::user()->curso->id)->get();

        // verifica se os dados do request já estão no banco e atualiza, limpando os dados do request.
        foreach ($atribuicao_horarios as $key => $atrb_horario) {
            if (isset($data[$atrb_horario->disciplina->modulo->id][$atrb_horario->horario_id][$atrb_horario->dia_semana])) {

                $atrb_horario->disciplina_id = $data[$atrb_horario->disciplina->modulo->id][$atrb_horario->horario_id][$atrb_horario->dia_semana];
                $atrb_horario->update();
                unset($data[$atrb_horario->disciplina->modulo->id][$atrb_horario->horario_id][$atrb_horario->dia_semana]);
            }
        }
        
        // cria novos horarios no banco que não estavam preenchidos anteriormente;
        DB::transaction(function () use ($data, $semestre_id, $curso_id) {
            foreach ($data as $key => $modulo) {
                foreach ($modulo as $horario => $disciplinas) {
                    foreach ($disciplinas as $dia_semana => $disciplina) {
                        if (!is_null($disciplina)) {
                            AtribuicaoHorario::create(array("horario_id" => $horario, "semestre_id" => $semestre_id, "disciplina_id" => $disciplina, "dia_semana" => $dia_semana, "curso_id" => $curso_id));
                            unset($data[$key][$horario][$dia_semana]);
                        }   
                    }                
                }
            }
        });

        //deleta as atribuições que foram deselecionadas;
        DB::transaction(function () use ($data, $atribuicao_horarios) {
            foreach ($data as $key => $modulo) {
                foreach ($modulo as $horario => $disciplinas) {                    
                    foreach ($disciplinas as $dia_semana => $disciplina) {
                     foreach ($atribuicao_horarios as $atribuicao) {
                        if ($atribuicao->disciplina->modulo->id == $key && $atribuicao->horario_id == $horario && $atribuicao->dia_semana == $dia_semana) {
                            $atribuicao->delete();
                            }
                        }
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Horários salvos com sucesso!');
    }
}