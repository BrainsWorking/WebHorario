<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Disciplina;

class AtribuicaoController {

        public function indexDisciplinas(){
            $funcionarios = Funcionario::pluck('nome', 'id');
            return view('atribuicao.atribuicao_disciplinas', compact('funcionarios'));
        }

        public function salvarProfessorDisciplina(Request $request){

            DB::transaction(function(){
                 $atribuicaoProfessor = $request->input('atribuicaoProfessor');
                foreach($atribuicaoHorario as $dia_semana => $horarios){          
                    foreach($horarios as $horario_id){
                        $horario = Horario::find($horario_id);
                        $atribuicaoProfessor = AtribuicaoProfessor::create([
                            "horario_id" => $horario,
                            "semestre_id" => Semestre::FpaAtivo()->id,
                            "funcionario_id" => Funcionario::find($request("professor")) 
                        ]);
                    }
                }
            }, 3);

        }

        public function salvarHorarioDisciplina(Request $request){
            DB::transaction(function(){
                $atribuicaoHorario = $request->input('atribuicaoHorario');
                foreach($atribuicaoHorario as $dia_semana => $horarios){          
                    foreach($horarios as $horario_id){
                        $horario = Horario::find($horario_id);
                        $atribuicaoDisciplina = AtribuicaoDisciplina::create([
                            "horario_id" => $horario,
                            "semestre_id" => Semestre::FpaAtivo()->id,
                            "disciplina_id" => null,
                            "dia_semana" => $dia_semana
                        ]);
                    }
                }
            }, 3);
        
        }

        public function updateProfessorDisciplina(Request $request){
            DB::transaction(function(){


                $atribuicaoProfessor = $request->input('atribuicaoProfessor');
                foreach($atribuicaoHorario as $dia_semana => $horarios){          
                    foreach($horarios as $horario_id){
                        $horario = Horario::find($horario_id);
                        $atribuicaoProfessor = AtribuicaoProfessor::create([
                            "horario_id" => $horario,
                            "semestre_id" => Semestre::FpaAtivo()->id,
                            "funcionario_id" => Funcionario::find($request("professor")) 
                        ]);
                    }
                }
            }, 3);
        
        }

        public function updateAtribuicaoHorario(Request $request){
            
        }

        public function index(){
            return view('fpa.atribuicao_disciplinas');
        }
    
}