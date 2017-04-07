<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $fillable = ['nome', 'inicio', 'fim'];
    public $timestamps = false;
}
