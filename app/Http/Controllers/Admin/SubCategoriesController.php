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
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.sub_categories.index', ['categories' => $categories, 'subCategories' => $subCategories ])->with('title', 'All Sub Category');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.sub_categories.create', ['categories' => $categories])->with('title', 'Create Sub Category');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required',
            'identifier'  => 'required',
        ]);
        // Create Category
        $subCategory = new SubCategory;
        $subCategory->category_id = $request->input('category_id');
        $subCategory->name        = $request->input('name');
        $subCategory->identifier  = $request->input('identifier');
        $subCategory->save();

        return redirect('admin/sub_categories');
    }

    public function show($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);

        return view('admin.sub_categories.show', ['categories' => $categories, 'subCategory' => $subCategory])->with('title', 'Edit Sub Category');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);

        return view('admin.sub_categories.edit')->with('categories', $categories)->with('subCategory', $subCategory)->with('title', 'Edit Sub Category');
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
        $subCategory->name        = $request->input('name');
        $subCategory->identifier  = $request->input('identifier');
        $subCategory->save();

        return redirect('/admin/sub_categories')->with('success', 'Sub Category Updated');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();

        return redirect('/admin/sub_categories')->with('success', 'Category Removed');
    }
}
