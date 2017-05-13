<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplinaRequest extends FormRequest {
    
    public function authorize() { return true; }

    public function rules() { 
        return [
            'nome'           => 'string|required',
            'sigla'          => 'string|max:5|required',
            'aulas_semanais' => 'integer|required'
        ];
    }
}
