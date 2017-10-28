<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests;
use Session;
use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $products = Product::where('active', true)->paginate(3);

        return view('store.index', ['categories' => $categories, 'subCategories' => $subCategories, 'products' => $products]);
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();

        $search_keyword = $request->input('keyword');
        $search_category = $request->input('category');
        $name = mb_strtolower($search_keyword);
        $name_pattern = preg_replace('/\s+/', '|', $name);
        $get_products = Product::where('active', true);

        if (isset($search_keyword) && isset($search_category))
        {
            $products_of_category = $get_products->where('identifier', $search_category)->paginate(3);
            $products = $this->get_filter_product($products_of_category, $name_pattern);
        }
        elseif(isset($search_keyword))
        {
            $products = $this->get_filter_product($get_products, $name_pattern)->paginate(3);
        }
        else
        {
            $products = $get_products->where('identifier', $search_category)->paginate(3);
        }

        if(empty($products))
        {
            $products = $get_products->where('recommended', true)->paginate(3);
        }

        return view('store.index', ['categories' => $categories, 'subCategories' => $subCategories, 'products' => $products]);
    }

    public function get_filter_product($get_products, $name_pattern)
    {
        $searched_products = array();
        foreach ($get_products as $key => $product)
        {
            $product_description = json_decode($product->description, true);
            if(preg_match('/'.$name_pattern.'/', mb_strtolower($product_description['title_product'])))
            {
                array_push($searched_products,  $get_products[$key]);
            }
        }

        return $searched_products;
    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('store.show')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('title', 'Show Product');
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);

        return redirect()->route('store.index');
    }

    public function getCart()
    {
        if(!Session::has('cart'))
        {
            return view('store.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('store.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
        if(!Session::has('cart')){
            return view('store.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        return view('store.checkout', ['total' => $total]);
    }
}
