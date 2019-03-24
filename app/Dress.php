<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dress extends Model
{
    protected $table = 'dress';

    public function collection() {
        return $this->belongsTo('\App\Collection', 'id');
    }
}
