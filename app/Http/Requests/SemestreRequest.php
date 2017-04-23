<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemestreRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        return [
            'nome'      => 'string|required',
            'inicio'    => 'date|timeBefore:fim|required',
            'fim'       => 'date|required',
            'fpaInicio' => 'date|timeBefore:fpaFim|required',
            'fpaFim'    => 'date|required'
        ];
    }

    public function all(){
        $data = parent::all();
        
        $data['inicio']    = converterDataIngles($data['inicio']);
        $data['fim']       = converterDataIngles($data['fim']);
        $data['fpaInicio'] = converterDataIngles($data['fpaInicio']);
        $data['fpaFim']    = converterDataIngles($data['fpaFim']);

        return $data;
    }
}
