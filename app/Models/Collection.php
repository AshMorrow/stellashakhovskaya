<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function dresses() {
        return $this->hasMany('\App\Dress');
    }
}
