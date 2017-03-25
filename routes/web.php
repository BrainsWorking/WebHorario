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

Route::get('turno', 'TurnoController@cadastro');

Route::get('turno/salvar', 'TurnoController@salvar')->name('turno.salvar');
Route::get('turno/atualizar', 'TurnoController@atualizar')->name('turno.atualizar');

Route::get('turno/editar/{id}', function($id){
    $turno = (object)['nome' => 'tarde'];//Turno::findOrFail($id);
    return view('turno.editar', compact('turno', 'id'));
})->name('turno.editar');