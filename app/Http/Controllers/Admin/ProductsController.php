<?php

namespace App\Http\Controllers\Admin;


use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;
use Illuminate\Support\Facades\DB;
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

        //$products = Product::where('active', true)->paginate(2);
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

        if(!isset(DB::table('products')->latest('id')->first()->id))
        {
            $product = new Product;
            $product->category_id     = 1;
            $product->sub_category_id = 1;
            $product->identifier      = '';
            $product->description     = '';
            $product->save();
            $oldId = DB::table('products')->latest('id')->first()->id;

            $product = Product::find($oldId);
            $product->delete();
        }
        else
        {
            $oldId = DB::table('products')->latest('id')->first()->id;
        }

        $productId = $oldId + 1;

        $descriptionRequest =  $request->input('description');
        if($request->hasFile('upload_main_picture'))
        {
            $filenameWithExt = $request->file('upload_main_picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('upload_main_picture')->getClientOriginalExtension();
            $fileNameToStore = 'basic_'.$filename.'_'.time().'.'.$extension;
            $path = $request->file('upload_main_picture')->storeAs('public/upload_pictures/'.$productId, $fileNameToStore);
            $descriptionRequest['upload_basic_image'] = $fileNameToStore;
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->hasFile('upload_gallery_pictures') && $request->hasFile('upload_main_picture'))
        {
            for($i = 0; $i < count($request->file('upload_gallery_pictures')); $i++)
            {
                $filenameWithExt = $request->file('upload_gallery_pictures')[$i]->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('upload_gallery_pictures')[$i]->getClientOriginalExtension();
                $fileNameToStore = 'gallery_'.$filename.'_'.time().'.'.$extension;
                $path = $request->file('upload_gallery_pictures')[$i]->storeAs('public/upload_pictures/'.$productId, $fileNameToStore);
                $descriptionRequest['gallery'][$i]['upload_picture'] = $fileNameToStore;
            }
        }
        $description = json_encode( $descriptionRequest, JSON_UNESCAPED_UNICODE );

        // Create Category
        $product = new Product;
        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = $request->input('identifier');
        $product->user_id         = '';
        $product->active          = $request->input('active');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
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
        $product->active          = $request->input('active');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
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
