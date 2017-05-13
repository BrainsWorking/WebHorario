<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class SemestreRequest extends FormRequest {

    public function authorize() { return true; }

    public function rules() { 
        if(Route::currentRouteName() == "semestre.salvar"){
            $nameRule = 'unique:semestres,nome|string|required';
        }else{
            $nameRule = 'string|required';
        }


        return [
            'nome'      => $nameRule,
            'inicio'    => 'date|before:fim|required',
            'fim'       => 'date|after:inicio|required',
            'fpa_inicio' => 'date|before:fpa_fim|before:inicio|required',
            'fpa_fim'    => 'date|after:fpa_inicio|required'
        ];
    }

    public function validationData(){
        $data = parent::validationData();
        
        $data['inicio']    = converterDataIngles($data['inicio']);
        $data['fim']       = converterDataIngles($data['fim']);
        $data['fpa_inicio'] = converterDataIngles($data['fpa_inicio']);
        $data['fpa_fim']    = converterDataIngles($data['fpa_fim']);

        return $data;
    }
}
