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
    	$disciplinas = Disciplina::pluck('nome', 'id');
        $funcionarios = Funcionario::all();

        # O for abaixo remove os funcionários que já são coordenadores de curso para que o mesmos
        # não sejam coordenadores em mais de um curso
        foreach($funcionarios as $key => $funcionario){
            if($funcionario->isCoordenador()){
                unset($funcionarios[$key]);
            }
        }
        $funcionarios = $funcionarios->pluck('nome', 'id');

    	return view('curso.formCurso', compact('turnos', 'disciplinas', 'funcionarios'));
    }

    public function salvar(CursoRequest $request){
        $dataForm = $request->all();

        DB::transaction(function () use ($dataForm) {
            $curso = Curso::create($dataForm);

            if(isset($dataForm['disciplina_id'])){
                foreach ($dataForm['disciplina_id'] as $disciplina) {
                    $curso->disciplinas()->attach($disciplina);
                }
            }
        }, 3);
        
        return redirect()->route('cursos')->with('success', 'Inclusão realizada com sucesso');
    }

    public function editar($id){
    	$turnos = Turno::pluck('nome', 'id');
        $disciplinas = Disciplina::pluck('nome', 'id');
        $funcionarios = Funcionario::pluck('nome', 'id');
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
}
