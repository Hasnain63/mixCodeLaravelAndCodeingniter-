<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
}