<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    //
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
