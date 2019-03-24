<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partition extends Model
{
    protected $table = 'partition';

    public function collections() {
        return $this->hasMany('App\Collection');
    }
}
