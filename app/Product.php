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
        'vat_rate' => 'float',
    ];

    /**
     * Calculate price after applying VAT
     *
     * @return float Price including VAT
     */
    public function getPriceIncludingVatAttribute()
    {
        return $this->price + $this->vat;
    }

    /**
     * Calculate VAT in price
     *
     * @return float VAT portion from price
     */
    public function getVatAttribute()
    {
        return $this->price * $this->vat_rate / 100;
    }
}
