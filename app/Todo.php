<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    public $primaryKey = 'id';

    public $timestamps = true;
}
