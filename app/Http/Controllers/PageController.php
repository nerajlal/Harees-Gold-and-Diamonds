<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('azwa.home');
    }

    public function collection(Request $request)
    {
        // Simple View return for now
        return view('azwa.collection');
    }

    public function allProducts()
    {
        return view('azwa.all-products');
    }
    
    public function combos()
    {
        // Assuming combos use collection view or a specific one if it existed. 
        // For now, mapping to collection as placeholder.
        return view('azwa.collection', ['type' => 'combos']); 
    }

    public function combo()
    {
        return view('azwa.product-main'); // Assuming combo detail page is product page
    }

    public function cosmopolitan()
    {
         return view('azwa.collection', ['collection' => 'Cosmopolitan']);
    }

    public function product()
    {
        return view('azwa.product-main');
    }

    public function checkout()
    {
        return view('azwa.checkout');
    }

    // Policies - checking if views exist or using placeholders
    public function shippingPolicy()
    {
        return view('azwa.shipping-policy'); // Need to create this if missing
    }

    public function returnPolicy()
    {
        return view('azwa.return-policy'); // Need to create this if missing
    }

    public function termsOfService()
    {
        return view('azwa.terms-of-service'); // Need to create this if missing
    }
}
