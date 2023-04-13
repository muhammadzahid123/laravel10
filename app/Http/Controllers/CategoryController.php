<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('id', 'ASC')->get();
        return view('admin.pages.category.index', compact('category'));
    }
    public function create()
    {
        $main_category = Category::orderBy('id', 'ASC')->whereNull('parent_id')->get();
        return view('admin.pages.category.create', compact('main_category'));
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
        $request->image->move(public_path('images/categories/'), $imageName);

        $category = new Category();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $imageName;

        $category->save();

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

        //     $category_image = new ProductImage();
        //     $category_image->product_id = $category->id;
        //     $category_image->image = $imageName;
        //     $category_image->save();

        // }

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $main_category = Category::orderBy('id', 'ASC')->whereNull('parent_id')->get();
        return view('admin.pages.category.edit', compact('category', 'main_category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'parent_id' => 'required',
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

        $request->image->move(public_path('images/categories/'), $imageName);

        $category = Category::where('id', $id)->first();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $imageName;

        $category->save();
        return redirect()->route('admin.categories');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!is_null($category)) {

            if ($category->parent_id == NULL) {
                $sub_category = Category::orderBy('id', 'ASC')->where('parent_id', $category->id)->get();
                foreach ($sub_category as $sub) {
                    $sub->delete();
                }
            }
        }

        return back()->with('success', 'Category deleted successfully!');

    }

}
