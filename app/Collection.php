<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collection';

    public function dresses() {
        return $this->hasMany('\App\Dress');
    }
}
