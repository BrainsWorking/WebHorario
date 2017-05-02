<?php
namespace App\Http\Requests\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Support\Arr;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Concerns\ReplacesAttributes;
use InvalidArgumentException;

class CustomValidator {

    use ValidatesAttributes;
    use ReplacesAttributes;

    public function sex($field, $value){
        $genres = ['f', 'm'];
        $value = strtolower($value);

        return in_array($value, $genres);
    }

    public function rg($field, $value){
        return preg_match('/^\d{2}\.\d{3}\.\d{3}-\d{1}$/', $value);
    }

    public function cpf($field, $value){
        // TODO: Fazer uma validação de CPF mesmo
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value);
    }
}