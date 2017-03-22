<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
    protected $fillable = ['name', 'firstClass', 'lastClass', 'shifts_id'];
}
