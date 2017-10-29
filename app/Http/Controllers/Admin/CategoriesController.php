<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories])->with('title', 'All Category');
    }


    public function create()
    {
        return view('admin.categories.create')->with('title', 'Create Category');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return redirect('admin/categories')->with('title', 'Create Category');
    }

    public function show($id)
    {
        $category = Category::find($id);

        return view('admin.categories.show', ['category' => $category])->with('title', 'View Product' );
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', ['category' => $category, 'title' => 'Edit Product']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect('/admin/categories')->with('success', 'Category Updated');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/admin/categories')->with('success', 'Category Removed');
    }
}
