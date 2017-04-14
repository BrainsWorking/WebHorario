<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class Telefone extends Model
{
    protected $fillable = ['numero', 'funcionario_id'];
    public $timestamps = false;

    public function funcionario(){
        return belongsTo(Funcionario::class);
    }

    public function getNumeroAttribute(){
        return formataTelefone($this->attribute('numero'));
    }
}
