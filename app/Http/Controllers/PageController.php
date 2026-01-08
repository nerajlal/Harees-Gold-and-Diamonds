<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('hareesgandd.home');
    }

    public function collection(Request $request)
    {
        // Simple View return for now
        return view('hareesgandd.collection');
    }

    public function allProducts()
    {
        return view('hareesgandd.all-products');
    }
    
    public function combos()
    {
        // Assuming combos use collection view or a specific one if it existed. 
        // For now, mapping to collection as placeholder.
        return view('hareesgandd.collection', ['type' => 'combos']); 
    }

    public function combo()
    {
        return view('hareesgandd.product-main'); // Assuming combo detail page is product page
    }

    public function cosmopolitan()
    {
         return view('hareesgandd.collection', ['collection' => 'Cosmopolitan']);
    }

    public function product()
    {
        return view('hareesgandd.product-main');
    }

    public function checkout()
    {
        return view('hareesgandd.checkout');
    }

    // Policies - checking if views exist or using placeholders
    public function shippingPolicy()
    {
        return view('hareesgandd.shipping-policy'); // Need to create this if missing
    }

    public function returnPolicy()
    {
        return view('hareesgandd.return-policy'); // Need to create this if missing
    }

    public function termsOfService()
    {
        return view('hareesgandd.terms-of-service'); // Need to create this if missing
    }
}
