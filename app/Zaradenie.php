<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zaradenie extends Model
{
    protected $table = 'zaradenia';

    public $primaryKey = 'id';

    public $timestamps = true;
}
