<?php

namespace App\Http\Controllers\ecommerce;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::paginate(20);

        return view('customer.index', compact('products'));
    }

    public function detail($id, $slug)
    {
        $product = Product::findOrFail($id);


        return view('customer.detail', compact('product'));
    }
}
