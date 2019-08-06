<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get all of the owning product models.
     */
    public function store()
    {
        return $this->belongsTo('\App\Store');
    }

    public function prices(){
        return $this->hasMany('\App\ProductPrice');
    }

}
