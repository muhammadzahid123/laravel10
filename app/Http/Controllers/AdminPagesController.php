<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class AdminPagesController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }
    public function createProduct()
    {
        return view('admin.pages.product.create');
    }

    public function manageProducts()
    {
        $products = Product::orderBy('id', 'ASC')->with('images')->get();
        return view('admin.pages.product.index', compact('products'));
    }

    public function storeProduct(Request $request)
    {

        $request->validate([
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

        $product->category_id = 1;
        $product->brand_id = 1;
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

    public function editProduct($id)
    {
        $products = Product::find($id);
        return view('admin.pages.product.edit', compact('products'));
    }

    public function updateProduct(Request $request, $id)
    {

        $request->validate([
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

        $product->category_id = 1;
        $product->brand_id = 1;
        $product->admin_id = 1;
        $product->save();

        return redirect()->route('admin.products');
    }

    public function destroyProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.products')->with('message', 'product deleted successfully');
    }
}
