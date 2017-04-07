<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Login extends Model
{
    protected $fillable = ['username', 'senha', 'funcionario_id'];
    public $timestamps = false;

    public function funcionario(){
    	return $this->belongsTo(Funcionario::class);
    }
}
