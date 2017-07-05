<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Funcionario;
use App\Models\Disciplina;
use App\Models\Semestre;
use App\Models\Cargo;

class AtribuicaoController {

        public function index(){

            # Verificando se tem alguma FPA ativa
            if(is_null(Semestre::FpaAtivo()))
                return redirect()->back()->withError('Não há nenhum FPA aberto no momento');
            else
                $semestre = Semestre::FpaAtivo();

            # Verificando se o usuário logado é o coordenador do curso
            if (!Auth::user()->isCoordenador()) 
                return redirect()->back()->withError('Somente coordenadores do curso podem editar');
            else
                $funcionario = Auth::user();

            # Recuperando todos os professores do curso
            $funcionarios = Funcionario::pluck('nome', 'id');

            # Recuperando o curso do coordenador
            $curso = $funcionario->curso;

            # Recuperando os módulos do semestre
            $modulos = $semestre->modulos;
            foreach ($modulos as $key => $modulo)
                if ($modulo['curso_id'] != $curso->id)
                    unset($modulos[$key]);

            # Recuperando as disciplinas
            $disciplinas_semestre = $semestre->disciplinasPorCurso()[$curso->nome]; //fazer filtro somente para o curso atual
            $disciplinas = [];
            foreach ($disciplinas_semestre as $key => $disciplina)
                $disciplinas[] = Disciplina::find($disciplina['id']);
            

            return view('atribuicao.atribuicao_disciplinas', compact('funcionarios', 'funcionario', 'semestre', 'curso', 'modulos'));
        }

        public function salvar(Request $request){
            dd($request->all());
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
    
}