<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'ASC')->with('images')->get();
        return view('admin.pages.product.index', compact('products'));
    }
    public function create()
    {
        return view('admin.pages.product.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'title' => 'required|max:150',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',

        ]);
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = Str::slug($request->title);

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->save();

        if ($request->hasFile('product_image')) {
            $image = Image::make($request->file('product_image'));

            /**
             * Main Image Upload on Folder Code
             */
            $imageName = time() . '-' . $request->file('product_image')->getClientOriginalName();
            $destinationPath = public_path('images/');
            $image->save($destinationPath . $imageName);

            $destinationPathThumbnail = public_path('images');
            $image->resize(100, 100);
            $image->save($destinationPathThumbnail . $imageName);

            $product_image = new ProductImage();
            $product_image->product_id = $product->id;
            $product_image->image = $imageName;
            $product_image->save();

        }

        return redirect()->route('admin.product.create');
    }

    public function edit($id)
    {
        $products = Product::find($id);
        return view('admin.pages.product.edit', compact('products'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'title' => 'required|max:150',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',

        ]);
        $product = Product::where('id', $id)->first();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = Str::slug($request->title);

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->save();

        return redirect()->route('admin.products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!is_null($product)) {
            $product->delete();

        }

        return back()->with('success', 'Product deleted successfully!');

    }

}
