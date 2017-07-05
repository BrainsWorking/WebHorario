<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Funcionario;
use App\Models\Disciplina;
use App\Models\Semestre;
use App\Models\Cargo;
use App\Models\AtribuicaoProfessor;

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
            $disciplinas_semestre = $semestre->disciplinasPorCurso()[$curso->nome];

            $disciplinas = [];
            foreach ($disciplinas_semestre as $key => $disciplina)
                $disciplinas[] = Disciplina::find($disciplina['id']);
            

            $atribuicao = AtribuicaoProfessor::where('atribuicoes_disciplinas.semestre_id', '=', Semestre::FpaAtivo()->id)->where('atribuicoes_disciplinas.curso_id', '=', Auth::user()->curso->id)->get();

            $funcionario_id = [];

            # funcionario_id[$disciplina->id][]
            if(!empty($atribuicao))
                foreach ($atribuicao as $attr) {
                    $funcionario_id[] = ["disciplina->id" => $attr->disciplina_id, $attr->funcionario_id];
                }

            //dd($funcionario_id);

            return view('atribuicao.atribuicao_disciplinas', compact('funcionario_id', 'funcionarios', 'funcionario', 'semestre', 'curso', 'modulos'));
        }

        public function salvar(Request $request){
            $dataForm = $request->all();
            $semestre = Semestre::FpaAtivo()->id;
            DB::transaction(function () use ($dataForm, $semestre){
                foreach ($dataForm['funcionario_id'] as $key_disciplina => $disciplina) {
                    foreach ($disciplina as $key_funcionario => $funcionario) {
                        AtribuicaoProfessor::create(array(
                                                        "disciplina_id"     => $key_disciplina,
                                                        "semestre_id"       => $semestre,
                                                        "funcionario_id"    => $funcionario,
                                                        "curso_id"          => Auth::user()->curso->id
                                                    ));
                    }
                }
            });
            return redirect()->back()->with('success', 'Atribuições salvas com sucesso!');
        }

        public function atualizar(Request $request){
            
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