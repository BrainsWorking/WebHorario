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

Route::get("/turno", function (){
	return view('turnos.index');
});

Route::get('turno/cadastrar', function(){
	return view('turnos.cadastro_turno');
})->name('cadastrar_turno');