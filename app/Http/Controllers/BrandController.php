<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::orderBy('id', 'ASC')->get();
        return view('admin.pages.brands.index', compact('brand'));
    }
    public function create()
    {
        return view('admin.pages.brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ],
            [
                "name.required" => "please provide a category name",
                "image.image" => "please provide a valid image",
            ]
        );
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/brands/'), $imageName);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->image = $imageName;

        $brand->save();

        // if ($request->hasFile('product_image')) {
        //     $image = Image::make($request->file('product_image'));

        //     /**
        //      * Main Image Upload on Folder Code
        //      */
        //     $imageName = time() . '-' . $request->file('product_image')->getClientOriginalName();
        //     $destinationPath = public_path('images/');
        //     $image->save($destinationPath . $imageName);

        //     $destinationPathThumbnail = public_path('images');
        //     $image->resize(100, 100);
        //     $image->save($destinationPathThumbnail . $imageName);

        //     $brand_image = new ProductImage();
        //     $brand_image->product_id = $brand->id;
        //     $brand_image->image = $imageName;
        //     $brand_image->save();

        // }

        return redirect()->route('admin.brands')->with('success', 'brand added successfully!');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.pages.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ],
            [
                "name.required" => "please provide a category name",
                "image.image" => "please provide a valid image",
            ]
        );
        $imageName = $request->hidden_image;
        if ($request->image != '') {
            $imageName = time() . '.' . $request->image->extension();
        }

        $request->image->move(public_path('images/brands/'), $imageName);

        $brand = Brand::where('id', $id)->first();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->image = $imageName;

        $brand->save();
        return redirect()->route('admin.brands');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);

        if (!is_null($brand)) {

            $brand->delete();
        }

        return back()->with('success', 'brand deleted successfully!');

    }

}
