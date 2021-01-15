<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oddelenie extends Model
{

    protected $table = 'oddelenia';

    public $primaryKey = 'id';

    public $timestamps = true;
}
