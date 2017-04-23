<?php
/*
|--------------------------------------------------------------------------
| Helpers/Formatters
|--------------------------------------------------------------------------
|
| Arquivo onde devem ser colocados formatadores e conversores
| ** FUNÇÕES DE USO EXCLUSÍVO EM CONTROLLERS E MODELS **
|             ** FAVOR NÃO USAR EM VIEWS **
|
*/

function converterDataBrasil($data){
    if(strpos($data, '-')){
        $dataFormatada = explode('-', $data);

        return $dataFormatada[2] . "/". $dataFormatada[1] ."/". $dataFormatada[0];
    }

    return $data;
}

function converterDataIngles($data){
    if(strpos($data, '/')){
        $dataFormatada = explode('/', $data);

        return $dataFormatada[2] . "-". $dataFormatada[1] ."-". $dataFormatada[0];
    }

    return $data;
}

function limpaPontuacao($valor) {
    return preg_replace('/[^\d]/', '', $valor);
}

function formataCPF($cpf){
    return substr_replace(wordwrap($cpf, 3, '.', true), '-', -3, 1);
}

function formataRG($rg){
    $rg = substr_replace($rg,'.', -7, 0);
    $rg = substr_replace($rg,'.', -4, 0);
    $rg = substr_replace($rg,'-', -1, 0);
    return $rg;
}

function formataTelefone($telefone){
    $telSize = strlen($telefone);

    if($telSize == 11) {
        $telefone = substr_replace($telefone,  '(',  0, 0);
        $telefone = substr_replace($telefone, ') ',  3, 0);
        $telefone = substr_replace($telefone,  '-',  6, 0);
        $telefone = substr_replace($telefone,  '-', 11, 0);
    } elseif ($telSize == 10) {
        $telefone = substr_replace($telefone,  '(',  0, 0);
        $telefone = substr_replace($telefone, ') ',  3, 0);
        $telefone = substr_replace($telefone,  '-', 9, 0);
    } 
    
    return $telefone;
}


# Converte espaços em dash(_) e retorna tudo em letra minúscula
function formatarDash($string){
    $string = preg_replace('/ /', '_', $string);
    return str;
}