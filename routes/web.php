<?php
# Entrada
Route::name('home')->get('/', function () { return view('welcome'); });

# TURNOS
Route::name('turnos')->get('turnos', 'TurnoController@index');
Route::name('turno.cadastrar')->get('turno/cadastrar', 'TurnoController@cadastrar');
Route::name('turno.salvar')->post('turno/salvar', 'TurnoController@salvar');
Route::name('turno.editar')->get('turno/editar/{id}', 'TurnoController@editar');
Route::name('turno.atualizar')->patch('turno/atualizar', 'TurnoController@atualizar');

# DISCIPLINAS
Route::name('disciplinas')->get("disciplinas", 'DisciplinaController@index');

# CURSOS
Route::name('cursos')->get('cursos', 'CursoController@index');
Route::name('curso.cadastrar')->get('curso/cadastrar', 'CursoController@cadastrar');
Route::name('curso.editar')->get('curso/editar', 'CursoController@editar');
Route::name('curso.salvar')->get('curso/salvar', 'CursoController@salvar');
