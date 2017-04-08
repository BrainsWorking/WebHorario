<?php
# Entrada
Route::name('home')->get('/', function () { return view('welcome'); });

# TURNOS
Route::name('turnos')->get('turnos', 'TurnoController@index');
Route::name('turno.formTurno')->get('turno/cadastrar', 'TurnoController@cadastrar');
Route::name('turno.salvar')->post('turno/salvar', 'TurnoController@salvar');
Route::name('turno.editar')->get('turno/editar/{id}', 'TurnoController@editar');
Route::name('turno.atualizar')->patch('turno/atualizar', 'TurnoController@atualizar');
Route::name('turno.deletar')->patch('turno/deletar', 'TurnoController@deletar');

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
Route::name('login')->get('login', 'LoginController@index');
Route::name('logar')->get('logar', 'LoginController@logar');
Route::name('deslogar')->get('deslogar', 'LoginController@deslogar');

#SEMESTRES
Route::name('semestres')->get('semestres', function (){ return view('semestre.index'); });
Route::name('semestre.cadastrar')->get('semestre/cadastrar', function (){ return view('semestre.formSemestre'); });

#CARGOS
Route::name('cargos')->get('cargos', function (){ return view('cargo.index'); });
Route::name('cargo.cadastrar')->get('cargo/cadastrar', function (){ return view('cargo.formCargo'); });

#PESSOAS
Route::name('pessoas')->get('pessoas', function (){ return view('pessoa.index'); });
Route::name('pessoa.cadastrar')->get('pessoa/cadastrar', function (){ return view('pessoa.formPessoa'); });

#COORDENADORES
Route::name('coordenador')->get('coordenadores', function (){ return view('coordenador.index'); });
Route::name('coordenador.cadastrar')->get('coordenador/cadastrar', function (){ return view('coordenador.formCoordenador'); });
