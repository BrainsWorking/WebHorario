<?php
use App\Models\Funcionario;
use App\Models\Disciplina;

Route::group(['middleware' => 'auth'], function () {
    # TURNOS
    Route::name('turnos')->get('turnos', 'TurnoController@index');
    Route::name('turno.formTurno')->get('turno/cadastrar', 'TurnoController@cadastrar');
    Route::name('turno.salvar')->post('turno/salvar', 'TurnoController@salvar');
    Route::name('turno.editar')->get('turno/editar/{id}', 'TurnoController@editar');
    Route::name('turno.atualizar')->put('turno/atualizar/{id}', 'TurnoController@atualizar');
    Route::name('turno.deletar')->get('turno/deletar/{id}', 'TurnoController@deletar');

    # DISCIPLINAS
    Route::name('disciplinas')->get("disciplinas", 'DisciplinaController@index');
    Route::name('disciplina.cadastrar')->get('disciplina/cadastrar', 'DisciplinaController@cadastrar');
    Route::name('disciplina.salvar')->post('disciplina/salvar', 'DisciplinaController@salvar');
    Route::name('disciplina.editar')->get('disciplina/editar/{id}', 'DisciplinaController@editar');
    Route::name('disciplina.atualizar')->put('disciplina/atualizar/{id}', 'DisciplinaController@atualizar');
    Route::name('disciplina.deletar')->get('disciplina/deletar/{id}', 'DisciplinaController@deletar');

    # CURSOS
    Route::name('cursos')->get('cursos', 'CursoController@index');
    Route::name('curso.cadastrar')->get('curso/cadastrar', 'CursoController@cadastrar');
    Route::name('curso.editar')->get('curso/editar/{id}', 'CursoController@editar');
    Route::name('curso.salvar')->post('curso/salvar', 'CursoController@salvar');
    Route::name('curso.atualizar')->put('curso/atualizar/{id}', 'CursoController@atualizar');
    Route::name('curso.deletar')->get('curso/deletar/{id}', 'CursoController@deletar');

    # LOGIN
    Route::name('deslogar')->get('deslogar', 'Auth\LoginController@deslogar');

    #SEMESTRES
    Route::name('semestres')->get('semestres', 'SemestreController@index');
    Route::name('semestre.cadastrar')->get('semestre/cadastrar', 'SemestreController@cadastrar');
    Route::name('semestre.editar')->get('semestre/editar/{id}', 'SemestreController@editar');
    Route::name('semestre.salvar')->post('semestre/salvar', 'SemestreController@salvar');
    Route::name('semestre.atualizar')->put('semestre/atualizar/{id}', 'SemestreController@atualizar');
    Route::name('semestre.deletar')->get('semestre/deletar/{id}', 'SemestreController@deletar');

    #CARGOS
    Route::name('cargos')->get('cargos', 'CargoController@index');
    Route::name('cargo.cadastrar')->get('cargo/cadastrar', 'CargoController@cadastrar');
    Route::name('cargo.editar')->get('cargo/editar/{id}', 'CargoController@editar');
    Route::name('cargo.salvar')->post('cargo/salvar', 'CargoController@salvar');
    Route::name('cargo.atualizar')->put('cargo/atualizar/{id}', 'CargoController@atualizar');
    Route::name('cargo.deletar')->get('cargo/deletar/{id}', 'CargoController@deletar');

    #PESSOAS
    Route::name('funcionarios')->get('funcionarios', 'FuncionarioController@index');
    Route::name('funcionario.cadastrar')->get('funcionario/cadastrar', 'FuncionarioController@cadastrar');
    Route::name('funcionario.editar')->get('funcionario/editar/{id}', 'FuncionarioController@editar');
    Route::name('funcionario.salvar')->post('funcionario/salvar', 'FuncionarioController@salvar');
    Route::name('funcionario.atualizar')->put('funcionario/atualizar/{id}', 'FuncionarioController@atualizar');
    Route::name('funcionario.deletar')->get('funcionario/deletar/{id}', 'FuncionarioController@deletar');
    Route::name('funcionario.perfil')->get('funcionario/perfil', 'FuncionarioController@perfil');

    #COORDENADORES
    Route::name('coordenadores')->get('coordenadores', 'CoordenadorController@index');
    Route::name('coordenador.cadastrar')->get('coordenador/cadastrar', 'CoordenadorController@cadastrar');
    Route::name('coordenador.editar')->get('coordenador/editar/{id}', 'CoordenadorController@editar');
    Route::name('coordenador.salvar')->post('coordenador/salvar', 'CoordenadorController@salvar');
    Route::name('coordenador.atualizar')->put('coordenador/atualizar/{id}', 'CoordenadorController@atualizar');
    Route::name('coordenador.deletar')->get('coordenador/deletar/{id}', 'CoordenadorController@deletar');

    #INSTITUIÇÃO
    Route::name('instituicao')->get('instituicao', 'InstituicaoController@index');
    Route::name('instituicao.cadastrar')->get('instituicao/cadastrar', 'InstituicaoController@cadastrar');
    Route::name('instituicao.editar')->get('instituicao/editar/{id}', 'InstituicaoController@editar');
    Route::name('instituicao.salvar')->post('instituicao/salvar', 'InstituicaoController@salvar');
    Route::name('instituicao.atualizar')->put('instituicao/atualizar/{id}', 'InstituicaoController@atualizar');
    Route::name('instituicao.deletar')->get('instituicao/deletar/{id}', 'InstituicaoController@deletar');

    #FPA
    Route::name('fpa')->get('fpa', 'FPAController@cadastrar');
    //Route::name('fpa.cadastrar')->get('fpa/cadastrar', 'FPAController@cadastrar');
    //Route::name('fpa.editar')->get('fpa/editar/{id}', 'FPAController@editar');
    Route::name('fpa.salvar')->post('fpa/salvar', 'FPAController@salvar');
    //Route::name('fpa.atualizar')->put('fpa/atualizar/{id}', 'FPAController@atualizar');
    //Route::name('fpa.deletar')->get('fpa/deletar/{id}', 'FPAController@deletar');

    Route::name('atribuicao.disciplinas')
        ->get('atribuicao/atribuicao-disciplinas', 'AtribuicaoController@indexDisciplinas');
    //Route::get('atribuicao-disciplinas', function(){
    //    $funcionarios = Funcionario::pluck('nome', 'id');
    //    return view('atribuicao.atribuicao_disciplinas', compact('funcionarios'));
    //});

    Route::get('visualizador-horarios', function(){
        return view('visualizador_horarios.index');
    });
    
    Route::get('atribuicao-horarios', function(){
        $disciplinas = Disciplina::pluck('nome', 'id');
        return view('atribuicao.atribuicao_horarios', compact('disciplinas'));
    });
});

# Entrada
Route::name('home')->get('/', 'HomeController@index');

# Login
Route::name('login')->get('login', 'Auth\LoginController@index');
Route::name('logar')->post('logar', 'Auth\LoginController@logar');
