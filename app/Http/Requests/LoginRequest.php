<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules() { 
        return [
            'prontuario' => 'required|alpha_num',
            'password' => 'required'
        ];
    }
}
