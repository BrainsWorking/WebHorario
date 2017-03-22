<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schoolSubjects extends Model
{
    protected $fillable = ['name', 'initials', 'area_id'];
}
