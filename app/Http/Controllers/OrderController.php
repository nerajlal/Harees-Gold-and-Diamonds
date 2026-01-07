<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Placeholder for placing order
        return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    }
}
