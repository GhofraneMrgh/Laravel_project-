<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = ['rawContent','importDate'];
}
