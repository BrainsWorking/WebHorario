<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Cargo extends Model
{
    protected $fillable = ['nome'];
    public $timestamps = false;

    public function cargos_funcionarios(){
        return $this->belongsToMany(Funcionario::class, 'cargos_funcionarios');
    }
}
