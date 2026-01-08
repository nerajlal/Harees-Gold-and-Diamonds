<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('hareesgandd.cart');
    }

    public function add(Request $request)
    {
        // Placeholder for adding to cart
        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
         // Placeholder for updating cart
        return redirect()->route('cart')->with('success', 'Cart updated!');
    }

    public function remove(Request $request)
    {
         // Placeholder for removing from cart
        return redirect()->route('cart')->with('success', 'Item removed!');
    }
}
