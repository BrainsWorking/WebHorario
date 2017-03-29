<?php
<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
=======
# Entrada
Route::name('home')->get('/', function () { return view('welcome'); });

# TURNOS
Route::name('turnos')->get('turnos', 'TurnoController@index');
Route::name('turno.cadastrar')->get('turno/cadastrar', 'TurnoController@cadastrar');
Route::name('turno.salvar')->post('turno/salvar', 'TurnoController@salvar');
Route::name('turno.editar')->get('turno/editar/{id}', 'TurnoController@editar');
Route::name('turno.atualizar')->patch('turno/atualizar', 'TurnoController@atualizar');
>>>>>>> afb0e9080d0079e3c593a9d224c28092f4e5b51c

# DISCIPLINAS
Route::name('disciplinas')->get("disciplinas", 'DisciplinaController@index');

# CURSOS
Route::name('cursos')->get('cursos', 'CursoController@index');
Route::name('curso.cadastrar')->get('curso/cadastrar', 'CursoController@cadastrar');
Route::name('curso.editar')->get('curso/editar', 'CursoController@editar');
Route::name('curso.salvar')->post('curso/salvar', 'CursoController@salvar');
