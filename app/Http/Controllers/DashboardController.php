<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $earnings = Order::where('status', 4)->sum('total_price');
        $possibility_earnings = Order::where('status', '!=', '5')->sum('total_price');
        $order = Order::get()->count();
        $order_entry = Order::where('status', 1)->count();
        $order_process = Order::where('status', 2)->count();
        $order_sent = Order::where('status', 3)->count();
        $order_received = Order::where('status', 4)->count();
        $product = Product::all()->count();

        return view('administrator.dashboard.index', compact('earnings', 'possibility_earnings', 'order', 'order_entry', 'order_process', 'order_sent', 'order_received', 'product'));
    }
}
