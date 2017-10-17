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
        return view('admin.categories.index')->with('categories', $categories)->with('title', 'All Category');
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

        // Create Category
        $cagegory = new Category;
        $cagegory->name = $request->input('name');
        $cagegory->save();

        return redirect('admin/categories')->with('title', 'Create Category');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.categories.show')->with('category', $category)->with('title', 'View Product');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit')->with('category', $category)->with('title', 'Edit Product');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');

        $category->save();
        return redirect('/admin/categories')->with('success', 'Post Updated');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        // Check for correct user
        //if(auth()->user()->id !==$post->user_id)
        //{
          //  return redirect('/posts')->with('error', 'Unauthorized Page');
        //}
        // Delete file

        $category->delete();
        return redirect('admin/categories')->with('success', 'Category Removed');
    }
}
