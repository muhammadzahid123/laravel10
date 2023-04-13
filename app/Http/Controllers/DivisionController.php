<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $division = Division::orderBy('id', 'ASC')->get();
        return view('admin.pages.divisions.index', compact('division'));
    }
    public function create()
    {
        // $main_category = Division::orderBy('id', 'ASC')->whereNull('parent_id')->get();
        return view('admin.pages.divisions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'priority' => 'required',
        ],
            [
                "name.required" => "please provide a category name",

            ]
        );

        $division = new Division();
        $division->name = $request->name;
        $division->priority = $request->priority;

        $division->save();

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

        //     $division_image = new ProductImage();
        //     $division_image->product_id = $division->id;
        //     $division_image->image = $imageName;
        //     $division_image->save();

        // }

        return redirect()->route('admin.divisions')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $division = Division::find($id);
        // $main_category = Division::orderBy('id', 'ASC')->whereNull('parent_id')->get();
        return view('admin.pages.divisions.edit', compact('division'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'priority' => 'required',
        ],
            [
                "name.required" => "please provide a category name",

            ]
        );

        $division = Division::where('id', $id)->first();
        $division->name = $request->name;
        $division->priority = $request->priority;

        $division->save();

        return redirect()->route('admin.divisions');
    }

    public function destroy($id)
    {
        $division = Division::find($id);

        if (!is_null($division)) {

            $district = District::where('division_id', $division->id)->get();

            foreach ($district as $districts) {
                $districts->delete();
            }
            $division->delete();

        }

        return back()->with('success', 'Division deleted successfully!');

    }

}
