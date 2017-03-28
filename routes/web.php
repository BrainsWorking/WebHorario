<?php
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

Route::get('/', function () {
    return view('welcome');
});

//<<<<<<< HEAD
Route::get("/turnos", function (){
	$turnos[] = (object)['nome' => 'Matutino', 'quantidade_aulas' => '5'];
	$turnos[] = (object)['nome' => 'Vespertino', 'quantidade_aulas' => '4'];
	$turnos[] = (object)['nome' => 'Noturno', 'quantidade_aulas' => '5'];

	return view('turnos.index', compact('turnos'));
});

Route::get('turnos/cadastrar', function(){
	return view('turnos.cadastro_turno');
});

//=======

Route::get('turno', 'TurnoController@cadastro');

Route::get('turno/salvar', 'TurnoController@salvar')->name('turno.salvar');
Route::get('turno/atualizar', 'TurnoController@atualizar')->name('turno.atualizar');

Route::get('turno/editar/{id}', function($id){
    $turno = (object)['nome' => 'tarde'];//Turno::findOrFail($id);
    return view('turno.editar', compact('turno', 'id'));
})->name('turno.editar');
//>>>>>>> upstream/master

Route::group(['prefix' => 'disciplinas'], function() {
	
	Route::get("/cadastrar", function(){
		return view("disciplinas.formDisciplina");
	});

	Route::get("/", function (){
		$disciplinas[] = (object)['nome' => 'Lógica de Programação', 'iniciais' => 'LOP', 'cargaHoraria' => '200'];
		$disciplinas[] = (object)['nome' => 'Matemática Discreta I', 'iniciais' => 'MD1', 'cargaHoraria' => '200'];
		$disciplinas[] = (object)['nome' => 'Linguagem de Programação', 'iniciais' => 'LOP', 'cargaHoraria' => '200'];
		
		return view('disciplinas.index', compact('disciplinas'));
	});
});


Route::get("/cursos", function (){
	$cursos[] = (object)['nome' => 'Análise e Desenvolvimento de Sistemas', 'iniciais' => 'ADS', 'turno' => 'Noturno', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
	$cursos[] = (object)['nome' => 'Edificações', 'iniciais' => 'EDF', 'turno' => 'Vespertino', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
	$cursos[] = (object)['nome' => 'Matemática', 'iniciais' => 'MAT', 'turno' => 'Matutino', 'disciplinas' => [['nome'=>'Disciplina 1', 'iniciais' => "DIC1"], ['nome'=>'Disciplina 2', 'iniciais' => "DIC2"]]];
	
	return view('cursos.index', compact('cursos'));
});