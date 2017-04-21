<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemestreRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        return [
            'nome'      => 'string|required',
            'inicio'    => 'date|timeBefore:fim|required',
            'fim'       => 'date|timeAfter:inicio|required',
            'fpaInicio' => 'date|timeBefore:fpaFim|required',
            'fpaFim'    => 'date|timeAfter:fpaInicio|required'
        ];
    }
}
