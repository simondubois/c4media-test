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
     * Format information to send back through API
     *
     * @return array Exposed cart information
     */
    public function toArray()
    {
        return [
            'price_including_vat' => $this->price_including_vat,
            'price_excluding_vat' => $this->price_excluding_vat,
            'quantity' => $this->quantity,
            'currency' => config('core.currency'),
            'products' => $this->formatProductsToWidget(),
        ];
    }

    /**
     * Format products to send back through API
     *
     * @return array Exposed product information
     */
    private function formatProductsToWidget()
    {
        $products = [];

        foreach ($this->products as $product) {
            $products[] = [
                'id' => $product->id,
                'name' => $product->name,
                'code' => $product->code,
                'quantity' => $product->pivot->quantity,
                'price_excluding_vat' => $product->price,
                'price_including_vat' => $product->price_including_vat,
            ];
        }

        return $products;
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
     * Calculate sum of product price excluding VAT
     * @return float Total cart price
     */
    public function getPriceExcludingVatAttribute()
    {
        $price = 0;

        foreach ($this->products as $product) {
            $price += $product->price * $product->pivot->quantity;
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
