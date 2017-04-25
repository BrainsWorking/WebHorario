<?php
/*
|--------------------------------------------------------------------------
| Helpers/View
|--------------------------------------------------------------------------
|
| Arquivo onde devem ser colocados qualquer gerador de
| texto, HTML, CSS, JS ou qualquer coisa relacionada a view
|          ** FUNÇÕES DE USO EXCLUSÍVO EM VIEWS **
|        ** FAVOR NÃO USAR EM CONTROLLERS/MODELS **
|
*/

function setActive($name, $activeClass = 'active') {
    $active = preg_match('/' . $name . '(\.*\w)*/', Route::currentRouteName());
    return $active ? $activeClass : '' ;
}