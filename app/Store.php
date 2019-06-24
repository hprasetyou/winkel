<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * Get all of the store's product
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
