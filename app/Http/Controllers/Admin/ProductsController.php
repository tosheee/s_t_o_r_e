<?php

namespace App\Http\Controllers\Admin;


use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $products = Product::all();
        return view('admin.products.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products)->with('title', 'Product Dashboard');
    }

    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.products.create')->with('categories', $categories)->with('subCategories', $subCategories)->with('title', 'Create Product');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id'     => 'required',
            'sub_category_id' => 'required',
            'identifier'      => 'required',
        ]);

        $request->input('description');

        $description = json_encode( $request->input('description'), JSON_UNESCAPED_UNICODE );

        // Create Category
        $product = new Product;
        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = $request->input('identifier');
        $product->active          = true;//$request->input('active');
        $product->description     = $description;
        $product->save();

        return redirect('admin/products/create');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.products.show')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('title', 'Edit Product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.products.edit')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('title', 'Edit Product');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'category_id'     => 'required',
            'sub_category_id' => 'required',
            'identifier'      => 'required',
        ]);

        $description = json_encode( $request->input('description'), JSON_UNESCAPED_UNICODE );

        $product = Product::find($id);
        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = $request->input('identifier');
        $product->active          = true;//$request->input('actiive');
        $product->description     = $description;
        $product->save();

        return redirect('/admin/products')->with('success', 'Product Updated');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return view('admin/products')->with('success', 'Product Removed');
    }

}
