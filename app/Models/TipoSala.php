<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina;

class TipoSala extends Model
{
	public $timestamps = false;

    protected $fillable = ['nome', 'descricao'];

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'disciplinas_tiposSalas');
    }
}
