<?php

namespace App\Http\Controllers\Admin;

use App\Admin\SubCategory;
use App\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $subCategories = SubCategory::all();
        $categories = Category::all();
        return view('admin.sub_categories.index')->with('subCategories', $subCategories)->with('categories', $categories);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.sub_categories.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {

        var_dump($request->input('category_id'));
        /*
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required',
            'identifier'  => 'required',
        ]);
        // Create Category
        $subCagegory = new SubCategory;
        $subCagegory->category_id = $request->input('category_id');
        $subCagegory->name        = $request->input('name');
        $subCagegory->identifier  = $request->input('identifier');
        $subCagegory->save();

        return redirect('admin/sub_categories');*/
    }

    public function show($id)
    {
        $subCategory = SubCategory::find($id);

        return view('admin.sub_categories.show')->with('category', $subCategory);
    }

    public function edit($id)
    {
        $subCategory = SubCategory::find($id);

        return view('admin.sub_categories.edit')->with('category', $subCategory);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'identifier' => 'required',
        ]);

        $subCategory = SubCategory::find($id);
        $subCategory->category_id = $request->input('category_id');
        $subCategory->name = $request->input('name');
        $subCategory->identifier = $request->input('identifier');
        $subCategory->save();

        return redirect('/admin/sub_categories')->with('success', 'Post Updated');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        return redirect('admin/sub_categories')->with('success', 'Category Removed');
    }
}
