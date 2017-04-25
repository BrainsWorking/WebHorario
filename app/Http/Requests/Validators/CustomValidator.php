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

    public function timeBefore($field, $value, array $parameters, $instance){
        $this->requireParameterCount(1, $parameters, 'TimeBefore');

        if(count($parameters) == 2){
            $times = Arr::get($instance->getData(), $parameters[0]);
            
            $before = $value;
            $before = strtotime(converterDataIngles($before));

            foreach($times as $time) {
                $after  = $time[$parameters[1]];
                $after  = strtotime(converterDataIngles($after));

                if($before > $after) {
                    return false;
                }
            }
        } else {
            $after = Arr::get($instance->getData(), $parameters[0]);

            if(is_null($after)){
                throw new InvalidArgumentException('Validation rule TimeBefore requires at least 2 parameters on arrays.');
            }

            $before = strtotime(converterDataIngles($value));
            $after  = strtotime(converterDataIngles($after));

            return $before <= $after;
        }

        return true;
    }

    public function sex($field, $value){
        $genres = ['f', 'm', 'i'];
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