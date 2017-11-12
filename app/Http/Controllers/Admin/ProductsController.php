<?php

namespace App\Http\Controllers\Admin;


use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;
use Illuminate\Support\Facades\Storage;
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
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.products.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products)->with('title', 'Всички продукти');
    }

    public function search_category(Request $request)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $search_category = $request->input('category');
        $products = Product::where('identifier', $search_category)->paginate(10);

        return view('admin.products.index', ['categories' => $categories, 'subCategories' => $subCategories, 'products' => $products])->with('title', 'Всички продукти');
    }


    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.products.create')->with('categories', $categories)->with('subCategories', $subCategories)->with('title', 'Създаване на продукт');
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
            $product->sale            = 0;
            $product->active          = 0;
            $product->recommended     = 0;
            $product->best_sellers    = 0;
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
            $descriptionRequest['upload_main_picture'] = $fileNameToStore;
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
        $product->active          = $request->input('active');
        $product->sale            = $request->input('sale');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
        $product->description     = $description;
        $product->save();

        return redirect('admin/products/create')->with('success', 'Продукта е създаден');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $descriptionRequest =  $request->input('description');

        $this->validate($request, [
            'category_id'     => 'required',
            'sub_category_id' => 'required',
            'identifier'      => 'required',
        ]);

        $old_descriptions = json_decode($product->description, true);

        if($request->hasFile('upload_main_picture'))
        {
            $filenameWithExt = $request->file('upload_main_picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('upload_main_picture')->getClientOriginalExtension();
            $fileNameToStore = 'basic_'.$filename.'_'.time().'.'.$extension;
            if (isset($old_descriptions['upload_main_picture']))
            {
                Storage::delete('public/upload_pictures/'.$id.'/'.$old_descriptions['upload_main_picture']);
            }
            $path = $request->file('upload_main_picture')->storeAs('public/upload_pictures/'.$id, $fileNameToStore);
            $descriptionRequest['upload_main_picture'] = $fileNameToStore;
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        // gallery
        if($request->hasFile('upload_gallery_pictures'))
        {

            if(isset($old_descriptions['gallery']))
            {
                $old_pic_num = count($old_descriptions['gallery']);
            }
            else
            {
                $old_pic_num = 0;
            }

            $new_pic_num = count($request->file('upload_gallery_pictures'));

            for($i = 0; $i < $new_pic_num; $i++)
            {
                $filenameWithExt = $request->file('upload_gallery_pictures')[$i]->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('upload_gallery_pictures')[$i]->getClientOriginalExtension();
                $fileNameToStore = 'gallery_'.$filename.'_'.time().'.'.$extension;
                $path = $request->file('upload_gallery_pictures')[$i]->storeAs('public/upload_pictures/'.$id, $fileNameToStore);
                $descriptionRequest['gallery'][$i + $old_pic_num]['upload_picture'] = $fileNameToStore;
            }
        }

        $description = json_encode( $descriptionRequest, JSON_UNESCAPED_UNICODE );

        $product->category_id     = $request->input('category_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->identifier      = $request->input('identifier');
        $product->active          = $request->input('active');
        $product->sale            = $request->input('sale');
        $product->recommended     = $request->input('recommended');
        $product->best_sellers    = $request->input('best_sellers');
        $product->description     = $description;
        $product->save();

        $actual_data = Product::find($id);
        $new_descriptions = json_decode($actual_data->description, true);

        if (isset($new_descriptions['gallery']))
        {
            $pic_files = Storage::allFiles('public/upload_pictures/'.$id.'/');
            $pic_name = array();

            for($i = 0; $i< count($pic_files); $i++)
             {
                 $file_name = pathinfo($pic_files[$i], PATHINFO_FILENAME);
                 if(mb_substr($file_name, 0, 5) != 'basic')
                 {
                     $file_exn = pathinfo($pic_files[$i],  PATHINFO_EXTENSION);
                     $file_name = pathinfo($pic_files[$i], PATHINFO_FILENAME);
                     $pic_name[$i] = $file_name.'.'.$file_exn;
                 }
             }

            $new_pictures = array_column($new_descriptions['gallery'], 'upload_picture');
            $diff_pic = array_diff($pic_name, $new_pictures);

            foreach($diff_pic as $old_picture)
            {
                Storage::delete('public/upload_pictures/'.$id.'/'.$old_picture);
            }
        }

        return redirect('/admin/products')->with('title', 'Обновяване на продукта');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.products.show')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('title', 'Преглед на продукта');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.products.edit')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('title', 'Обновяване информацията за продукта');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        Storage::deleteDirectory('public/upload_pictures/'.$id);

        return view('admin.products')->with('success', 'Продукта е изтрит');
    }
}
