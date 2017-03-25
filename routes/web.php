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
    return view('');
});

Route::get("/turnos", function (){
	$turnos[] = (object)['nome' => 'Matutino', 'quantidade_aulas' => '5'];
	$turnos[] = (object)['nome' => 'Vespertino', 'quantidade_aulas' => '5'];
	$turnos[] = (object)['nome' => 'Noturno', 'quantidade_aulas' => '5'];

	return view('turnos.index', compact('turnos'));

});

Route::get('turnos/cadastrar', function(){
	return view('turnos.cadastro_turno');
})->name('cadastrar_turno');