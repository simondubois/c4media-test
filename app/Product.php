<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'vat' => 'float',
    ];

    /**
     * Calculate price after applying VAT
     *
     * @return float Price including VAT
     */
    public function getPriceIncludingVatAttribute()
    {
        return $this->price + $this->price * $this->vat / 100;
    }
}
