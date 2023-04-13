<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $district = District::orderBy('id', 'ASC')->get();
        return view('admin.pages.districts.index', compact('district'));
    }
    public function create()
    {
        return view('admin.pages.districts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'division_id' => 'required',
        ],
            [
                "name.required" => "please provide a category name",

            ]
        );

        $district = new District();
        $district->name = $request->name;
        $district->division_id = $request->division_id;

        $district->save();

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

        //     $district_image = new ProductImage();
        //     $district_image->product_id = $district->id;
        //     $district_image->image = $imageName;
        //     $district_image->save();

        // }

        return redirect()->route('admin.districts')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $district = District::find($id);
        // $main_category = District::orderBy('id', 'ASC')->whereNull('parent_id')->get();
        return view('admin.pages.districts.edit', compact('district'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'division_id' => 'required',
        ],
            [
                "name.required" => "please provide a category name",

            ]
        );

        $district = District::where('id', $id)->first();
        $district->name = $request->name;
        $district->division_id = $request->division_id;

        $district->save();

        return redirect()->route('admin.districts');
    }

    public function destroy($id)
    {
        $district = District::find($id);

        if (!is_null($district)) {

            $district->delete();
        }

        return back()->with('success', 'district deleted successfully!');

    }

}

