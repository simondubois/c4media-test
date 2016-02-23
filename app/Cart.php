<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The products that belong to the cart
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
