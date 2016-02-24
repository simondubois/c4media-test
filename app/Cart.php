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

    /**
     * Get information for widget
     *
     * @return array Total number of products & total price
     */
    public function toWidget()
    {
        return [
            'price' => $this->price_including_vat,
            'quantity' => $this->quantity,
            'currency' => config('core.currency'),
        ];
    }

    /**
     * Calculate sum of product price including VAT
     * @return float Total cart price
     */
    public function getPriceIncludingVatAttribute()
    {
        $price = 0;

        foreach ($this->products as $product) {
            $price += $product->price_including_vat * $product->pivot->quantity;
        }

        return $price;
    }

    /**
     * Calculate number of products
     * @return int Number of products in cart
     */
    public function getQuantityAttribute()
    {
        $quantity = 0;

        foreach ($this->products as $product) {
            $quantity += intval($product->pivot->quantity);
        }

        return $quantity;
    }
}
