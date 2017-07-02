<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Modulo;
use App\Models\Funcionario;
use App\Models\Disciplina;
use App\Http\Requests\CursoRequest;
use App\Http\Middleware\TurnoMissing;

class CursoController extends Controller
{

    public function __construct(){ $this->middleware(TurnoMissing::class); }

    public function index() {
        $cursos = Curso::orderBy('nome', 'asc')->paginate();
        
        return view('curso.index', compact('cursos'));
    }

    public function cadastrar(){
    	$turnos = Turno::pluck('nome', 'id');
        $funcionarios = $this->getFuncionarios();

    	return view('curso.formCurso', compact('turnos', 'curso', 'funcionarios'));
    }

    public function salvar(CursoRequest $request){
        $data = $request->all();

        DB::transaction(function () use ($data) {
            $modulos = $data['modulo_novo'];
            $curso = Curso::create($data);

            foreach($modulos as $modulo){
                $modulo['curso_id'] = $curso->id;
                
                if(is_array($modulo['nome'])){
                    $modulo['nome'] = array_values($modulo['nome'])[0];
                }

                $modulo_modelo = Modulo::create($modulo);

                $disciplinas = $modulo['disciplinas'];
                $dados_disciplina = [];
                foreach($disciplinas as $chave => $disciplina){ // Itera sobre as chaves                
                    foreach($disciplina as $index => $valor){ // Itera sobre os valores de cada chave de cada disciplina
                        $dados_disciplina[$index][$chave] = $valor;
                    }
                }

                foreach($dados_disciplina as $disciplina){
                    $disciplina['modulo_id'] = $modulo_modelo->id;
                    unset($disciplina['tipo_sala']); // TODO: Tipo sala ignorado
                    Disciplina::firstOrCreate($disciplina);
                }
                
            }

        }, 3);
        
        return redirect()->route('cursos')->with('success', 'Inclusão realizada com sucesso');
    }

    public function editar($id){
    	$turnos = Turno::pluck('nome', 'id');
        
        $funcionarios = $this->getFuncionarios($id);
        $curso = Curso::findOrFail($id);

        $disciplina_id = Curso::findOrFail($id)->disciplinas()->pluck('id')->toArray();

        return view('curso.formCurso', compact('turnos', 'disciplinas', 'curso', 'disciplina_id', 'funcionarios'));
    }

    public function atualizar(CursoRequest $request, $id){
        $data = $request->all();
        //dd($data);
        DB::transaction(function () use ($data, $id) {
            if(isset($data['modulo_novo'])){
                $modulos_novos = $data['modulo_novo'];
                //dd($modulos_novos);
            }

            $modulos = $data['modulo'];
            $curso = Curso::findOrFail($id);
            $curso->fill($data);
            $curso->save();

            foreach($modulos as $key => $modulo){
                $disciplinas = $modulo['disciplinas'];
                unset($modulo['disciplinas']);

                $modulo_modelo = Modulo::findOrFail($key);
                $modulo_modelo->fill($modulo);
                $modulo_modelo->save();

                $dados_disciplina = [];
                foreach($disciplinas as $chave => $disciplina){ // Itera sobre as chaves
                    foreach($disciplina as $index => $valor){ // Itera sobre os valores de cada chave de cada disciplina
                        $dados_disciplina[$index][$chave] = $valor;
                    }
                }

                foreach($dados_disciplina as $key => $disciplina){
                    $disciplina['modulo_id'] = $modulo_modelo->id;
                    unset($disciplina['tipo_sala']); // TODO: Tipo sala ignorado
                    
                    $disciplina_modelo = Disciplina::findOrFail($key);

                    $disciplina_modelo->fill($disciplina);
                    $disciplina_modelo->save();
                }
                
            }

        }, 3);


        return redirect()->route('cursos')->with('success', 'Edição realizada com sucesso');
    }

    public function deletar($id){
        DB::transaction(function () use ($id) {
            $curso = Curso::findOrFail($id);

            $curso->delete();
        }, 3);

        return redirect()->route('cursos')->with('success', 'Exclusão realizada com sucesso');
    }

    private function getFuncionarios($id = null){
        $funcionarios = Funcionario::orderBy('nome', 'asc')->get();
        if (!is_null($id)) {
            $id_coordenador = Curso::findOrFail($id)['funcionario_id'];
        }
        # O for abaixo remove os funcionários que já são coordenadores de curso para que o mesmos
        # não sejam coordenadores em mais de um curso
        foreach($funcionarios as $key => $funcionario){
            if($funcionario->isCoordenador() && $funcionario->id != @$id_coordenador){
                unset($funcionarios[$key]);
            }
        }
        return $funcionarios = $funcionarios->pluck('nome', 'id');
    }
}
