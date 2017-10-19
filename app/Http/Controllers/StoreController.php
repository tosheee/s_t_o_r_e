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
        $products = Product::where('active', true)->paginate(2);
        return view('store.index', ['categories' => $categories, 'subCategories' => $subCategories, 'products' => $products]);
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

        //dd($cart->items);

        //foreach($cart->items as $items)
        //{
         //foreach($items as $item)
         //{
           //  echo $item;
         //}
         //}



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
