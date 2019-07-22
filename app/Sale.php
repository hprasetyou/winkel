<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    public function sales_items()
    {
        return $this->hasMany('App\SalesItem');
    }
}
