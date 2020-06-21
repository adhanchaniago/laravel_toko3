<?php

namespace App\Http\Controllers\ecommerce;

use App\Cart;
use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\Order;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->where('status', 0)->get();

        $provinces = Province::all();

        return view('customer.checkout', compact('carts', 'provinces'));
    }


    public function checkout_process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'phone' => 'required|string|min:6',
            'address' => 'required|string|min:10',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $latestOrder = Order::orderBy('created_at', 'DESC')->first();

        $invoice = 'INV' . str_pad($latestOrder->id + 1, 9, "0", STR_PAD_LEFT);

        $order = Order::where('status', 0)->where('user_id', $user_id);

        $carts = Cart::where('user_id', $user_id)->where('status', 0)->get();

        $total_price = $carts->sum('subtotal_price');
        $total_weight = $carts->sum('subtotal_weight');

        foreach ($carts as $cart) {
            $product_stock_update = $cart->product->stock - $cart->qty;
            $cart->product->update([
                'stock' => $product_stock_update
            ]);
        }

        Cart::where('user_id', $user_id)->where('status', 0)->update(['status' => 1]);

        $order->update([
            'invoice' => $invoice,
            'user_id' => $user_id,
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'district_id' => $request->district_id,
            'status' => 1,
            'total_price' => $total_price,
            'total_weight' => $total_weight,
        ]);



        Alert::success('Berhasil proses order!', 'Order berhasil diterima! Kami akan memproses pesanan Anda segera!');
        return redirect()->back();
    }

    public function checkout_finish()
    {
        return view('costumer.checkout_finish');
    }

    public function order_list()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->where('status', '!=', 0)->orderBy('created_at', 'desc')->get();

        return view('customer.order_list', compact('orders'));
    }





    public function getCity()
    {
        $cities = City::where('province_id', request()->province_id)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }
}
