<?php
function setActive($name, $activeClass = 'active') {
    $active = preg_match('/' . $name . '(\.*\w)*/', Route::currentRouteName());
    return $active? $activeClass : '' ;
}

function converterDataBrasil($data){
	$dataFormatada = explode('-', $data);

	return $dataFormatada[2] . "/". $dataFormatada[1] ."/". $dataFormatada[0];
}

function limpaPontuacao($valor) {
    return preg_replace('/[^\d]/', '', $valor);
}

function formataCPF($cpf){
    return substr_replace(wordwrap($cpf, 3, '.', true), '-', -3, 1);
}