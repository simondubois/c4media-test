<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show session cart information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->getCartFromSession($request);
    }

    /**
     * Add product to session cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retrieve records from database
        $cart = $this->getCartFromSession($request);
        $product = $cart->products()->find($request->productId);

        // Update relations
        if ($product instanceof Product) {
            $cart->products()->updateExistingPivot(
                $product->id,
                ['quantity' => $product->pivot->quantity + $request->quantity]
            );
        } else {
            $cart->products()->attach($request->productId, ['quantity' => $request->quantity]);
        }

        // Save modifications to database & session
        $this->saveCartToSession($cart, $request);
        return $cart;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        // Retrieve records from database
        $cart = $this->getCartFromSession($request);
        $product = $cart->products()->find($product_id);

        // Update relations
        if ($request->quantity === 0) {
            $cart->products()->detach($product_id);
        } elseif ($product instanceof Product) {
            $cart->products()->updateExistingPivot($product->id, ['quantity' => $request->quantity]);
        } else {
            $cart->products()->attach($product_id, ['quantity' => $request->quantity]);
        }

        // Save modifications to database & session
        $this->saveCartToSession($cart, $request);
        return $cart;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Find in database cart which id has been stored in session, return a new one otherwise
     *
     * @param  \Illuminate\Http\Request $request    Current HTTP request
     * @return Cart Session cart
     */
    private function getCartFromSession(Request $request)
    {
        if ($request->session()->has('cart_id')) {
            $id = $request->session()->get('cart_id');
            $cart = Cart::with('products')->find($id);
        }

        if (isset($cart) === false) {
            $cart = new Cart();
            // Save to session now to generate a valid ID
            $this->saveCartToSession($cart, $request);
        }

        return $cart;
    }

    /**
     * Save cart to database and store cart id to session
     *
     * @param  Cart $cart                           Cart to save
     * @param  \Illuminate\Http\Request $request    Current HTTP request
     * @return bool Save success
     */
    private function saveCartToSession(Cart $cart, Request $request)
    {
        $success = $cart->save();

        if ($success) {
            $request->session()->put('cart_id', $cart->id);
        }

        // Reload relation, or last modifications will be missing
        $cart->load('products');

        return $success;
    }
}
