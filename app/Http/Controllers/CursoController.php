<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Funcionario;
use App\Models\Disciplina;
use App\Http\Requests\CursoRequest;

class CursoController extends Controller
{
    public function index() {
        $cursos = Curso::orderBy('nome', 'asc')->paginate();
        
        return view('curso.index', compact('cursos'));
    }

    public function cadastrar(){
    	$turnos = Turno::pluck('nome', 'id');
    	$disciplinas = $this->getDisciplinas();
        // TODO: Remover dsiciplinas já cadastradas em outros cursos
        $funcionarios = $this->getFuncionarios();

    	return view('curso.formCurso', compact('turnos', 'modulos', 'funcionarios'));
    }

    public function salvar(Request $request){
        $nome = $request('nome');
        $sigla = $request('sigla');
        $turno = $request('id_turno');
        $coordenador = $request('id_coordenador');
        $modulos = $request('modulos');
        $curso = Curso::create('nome', 'sigla', 'id_turno', 'id_coordenador');
        $curso->save();

        foreach($modulos as $modulo){
            $modulo = new Modulo();
            $modulo->curso()->associate($curso);
            $modulo->save();
            $disciplinas = $request([$modulo]['disciplinas']);
            foreach($disciplinas as $disciplina){
                $disciplina = new Disciplina();
                $disciplina->curso()->associate($modulo);
                $disciplina->save();
            }
        }
    }

    public function editar($id){
    	$turnos = Turno::pluck('nome', 'id');
        $disciplinas = $this->getDisciplinas($id);
        // TODO: Remover dsiciplinas já cadastradas em outros cursos, mas manter as já cadastradas no curso selecionado
        
        $funcionarios = $this->getFuncionarios($id);
        $curso = Curso::findOrFail($id);

        $disciplina_id = Curso::findOrFail($id)->disciplinas()->pluck('id')->toArray();

        return view('curso.formCurso', compact('turnos', 'disciplinas', 'curso', 'disciplina_id', 'funcionarios'));
    }

    public function atualizar(CursoRequest $request, $id){
        $dataForm = $request->all();

        DB::transaction(function () use ($dataForm, $id) {
            $curso = Curso::findOrFail($id);

            $curso->update($dataForm);

            $curso->disciplinas()->sync(isset($dataForm['disciplina_id']) ? $dataForm['disciplina_id'] : []);
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

    private function getDisciplinas($id = null){
        $disciplinas = Disciplina::orderBy('nome', 'asc')->get();
        $disciplinas_formatadas = [];
        if (!is_null($id)) {
            $disciplinas_cadastradas = Curso::findOrFail($id)->disciplinas->pluck('nome', 'id')->toArray();
        }
        # O for abaixo remove as disciplinas já cadastradas em outros cursos
        foreach($disciplinas as $key => $disciplina){
            if(!empty($disciplina->cursos[0]) && @!array_key_exists($disciplina->id, $disciplinas_cadastradas)){
                unset($disciplinas[$key]);
            }else{
                $disciplinas_formatadas[$disciplina->id] = $disciplina->nome . ' (' . $disciplina->sigla . ')';
            }
        }
        
        return $disciplinas_formatadas;
    }
}
