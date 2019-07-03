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
    public function users(){
        return $this->belongsToMany('App\User')
        ->withTimestamps();
    }

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = []){
        $store = parent::save();
        if($store){
            $user = request()->user();
            $this->users()->attach($user->id);
        }
        return $store;
    }
}
