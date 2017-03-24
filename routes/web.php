<?php

    use App\Model\Horario;
    use App\Model\Turno;
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
    //return view('welcome');

    $horario = new Horario(['inicio' => '7:00', 'fim' => '7:50']);
    $horario->save();

    $turno = new Turno(['nome' => 'Matutino']);
    $turno->associate($horario);
    $turno->save();
});
