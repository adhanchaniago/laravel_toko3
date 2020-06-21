<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $carts = Cart::where('user_id', $user_id)->where('status', 0)->get();

        return view('customer.cart', compact('carts'));
    }
    public function add_cart($id)
    {

        $product = Product::findOrFail($id);
        $user_id = Auth::user()->id;
        $order = Order::where('user_id', $user_id)->where('status', 0)->first();

        if (!isset($order)) {
            Order::create([
                'user_id' => $user_id,
                'status' => 0
            ]);
        }
        $order_id = Order::where('user_id', $user_id)->where('status', 0)->first()->id;
        $available = Cart::where('product_id', $product->id)->where('status', 0)->where('user_id', $user_id)->get();

        if ($available->isEmpty()) {
            Cart::create([
                'product_id' => $id,
                'user_id' => $user_id,
                'order_id' => $order_id,
                'name' => $product->name,
                'qty' => 1,
                'subtotal_price' => $product->price,
                'subtotal_weight' => $product->weight,
                'status' => 0
            ]);

            Alert::success('Berhasil!', 'Produk berhasil ditambahkan ke keranjang!');
            return redirect()->back();
        }


        Alert::success('Sudah masuk!', 'Produk sudah masuk keranjang!');
        return redirect()->back();
    }

    public function update_cart(Request $request)
    {
        $this->validate($request, [
            'qty' => 'required'
        ]);

        foreach ($request->id as $i => $id) {
            $cart = Cart::where('id', $id)->first();

            if ($request->qty[$i] == 0) {
                $cart->delete();
            } else {
                $subtotal_price = $request->qty[$i] * $cart->product->price;
                $subtotal_weight = $request->qty[$i] * $cart->product->weight;
                $cart->update([
                    'qty' => $request->qty[$i],
                    'subtotal_price' => $subtotal_price,
                    'subtotal_weight' => $subtotal_weight,
                ]);
            }
        }
        return redirect()->route('checkout');
    }

    // public function cart_delete($id)
    // {
    //     $cart = Cart::find($id);
    //     $cart->delete();
    //     $carts = Cart::get()->all();
    //     if (!isset($carts)) {
    //         Alert::toast('Barang berhasil dihapus.', 'warning');
    //         return redirect()->route('front.dashboard');
    //     }
    //     Alert::toast('Barang berhasil dihapus.', 'warning');
    //     return redirect()->back();
    // }
}
