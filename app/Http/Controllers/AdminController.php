<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard', ['orders' => $orders])->with('title', 'Admin Dashboard');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return view('admin.dashboard')->with('success', 'Order Removed')->with('title', 'Admin Dashboard');
    }

    public function viewOffer($id)
    {
        $order = Order::find($id);
        return view('admin.view_offer')->with('order', $order)->with('success', 'View Offer')->with('title', 'View Offer');
    }
}
