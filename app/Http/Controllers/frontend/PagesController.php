<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(3);
        return view('pages.index', compact('products'));
    }
    public function contact()
    {
        return view('pages.contact');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::orWhere('title', 'like', '%' . $search . '%')->
        orWhere('slug', 'like', '%' . $search . '%')->
            orWhere('description', 'like', '%' . $search . '%')->
            orWhere('price', 'like', '%' . $search . '%')->
            orWhere('quantity', 'like', '%' . $search . '%')->
            orWhere('title', 'like', '%' . $search . '%')->orderBy('id', 'ASC')->with('images')->paginate(4);
        return view('admin.pages.product.search', compact('search', 'products'));
    }

}
