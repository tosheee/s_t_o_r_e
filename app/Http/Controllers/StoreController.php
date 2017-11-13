<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Admin\SubCategory;
use App\Admin\Category;
use App\Admin\Product;
use App\Order;
use App\Admin\Page;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $products = Product::where('active', true)->paginate(9);

        return view('store.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products);
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

        return view('store.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('products', $products);
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
    {   if( is_int($id))
        {
            $product = Product::find($id);
            $categories = Category::all();
            $subCategories = SubCategory::all();

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
        }
        else
        {
            return view('errors.404');
        }

        if(isset($product))
        {
            return view('store.show')->with('categories', $categories)->with('subCategories', $subCategories)->with('product', $product)->with('cart', $cart);
        }
        else
        {
            return view('errors.404');
        }
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function getIncreaseByOne(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function getCart()
    {
        if(!Session::has('cart'))
        {
            return view('store.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('store.shopping-cart')->with('products', $cart->items)->with('totalPrice', $cart->totalPrice);
    }

    public function getCheckout()
    {
        if(!Session::has('cart')){
            return view('store.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('store.checkout')->with('cart', $cart);
    }

    public function postCheckout(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'last_name' => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address'  => 'required',
            'delivery_method'  => 'required',
            'payment_method'  => 'required',
        ]);

        if(!Session::has('cart'))
        {
            return redirect()->route('shop.shoppingCart');
        }

        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);

        $order = new Order();
        $order->user_id         = $request->input('user_id');
        $order->name            = $request->input('name');
        $order->last_name       = $request->input('last_name');
        $order->email           = $request->input('email');
        $order->phone           = $request->input('phone');
        $order->address         = $request->input('address');
        $order->delivery_method = $request->input('delivery_method');
        $order->payment_method  = $request->input('payment_method');
        $order->company         = $request->input('company');
        $order->bulstat         = $request->input('bulstat');
        $order->note            = $request->input('note');
        $order->cart = base64_encode(serialize($cart));

        if(isset(Auth::user()->name))
        {
            Auth::user()->orders()->save($order);
        }
        else
        {
            $order->save();
        }

        Session::forget('cart');

        return redirect()->route('store.index');
    }

    public function getShowPages(Request $request)
    {
        $active_page = Page::where('active_page', true)->get();
        $page = $active_page->where('url_page', $request->input('show'))->first();

        return view('store.show-pages')->with('page', $page);
    }

    public function viewUserOrders($id)
    {
        if (Auth::check())
        {
            $userOrders = Order::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);;

            return view('store.view-user-orders')->with('user_orders', $userOrders);
        }
        else
        {
          echo "process denied";
        }
    }
}
