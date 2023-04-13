<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    public function products()
    {
        $products = Product::paginate(6);
        return view('pages.product.index', compact('products'));
    }

    public function show($slug)
    {
        $products = Product::where('slug', $slug)->first();

        if (!is_null($products)) {
            return view('pages.product.show', compact('products'));
        } else {
            return redirect()->route('product')->with('success', 'sorry there is no user with url');
        }
    }
}
