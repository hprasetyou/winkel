<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get all of the owning product models.
     */
    public function company()
    {
        return $this->belongsTo('\App\Company');
    }

    public function prices(){
        return $this->hasMany('\App\ProductPrice');
    }
    
    public function images(){
        return $this->hasMany('\App\ProductImage');
    }

    public function parentProduct(){
        return $this->belongsTo('\App\Product','parent_id');
    }
    
}
