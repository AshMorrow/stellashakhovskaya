<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partition extends Model
{
    public function collections() {
        return $this->hasMany('App\Collection');
    }
}
