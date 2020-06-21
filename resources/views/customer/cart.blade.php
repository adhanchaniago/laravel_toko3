@extends('layouts.ecommerce')

@section('title')
    Keranjang
@endsection

@section('content')
<br><br><br><br><br>
<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Produk</th>
                            <th scope="col">Stok</th>
                            <th scope="col" class="text-center">Item</th>
                            <th scope="col" class="text-right">Harga</th>
                            {{-- <th scope="col" class="text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('cart.update') }}" method="post">
                            @csrf
                            @forelse ($carts as $cart)
                            <?php $no =1; ?>
                        <tr>
                            <td><img src="{{ asset('uploads/products/'. $cart->product->image) }}" style="height: 70px;"> </td>
                            <td>{{ $cart->name }}</td>
                            <td>{{ $cart->product->stock }}</td>
                            <td>
                                <input type="hidden" value="{{ $cart->id }}" name="id[]">
                                <input type="hidden" value="{{ $cart->product_id }}" name="product_id[]">
                                <input type="number" id="qty" name="qty[]" class="form-control" placeholder="Banyak barang" value="{{ $cart->qty }}" required min="0" max="{{ $cart->product->stock }}">
                            </td>
                            <td class="text-right">Rp. {{ number_format($cart->product->price,0,',','.') }}</td>
                            {{-- <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td> --}}
                        </tr>
                        <?php $no++ ?>
                        
                        @empty
                            <td>Keranjang Kosong</td>
                        @endforelse
                        {{-- <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">255,90 €</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Shipping</td>
                            <td class="text-right">6,90 €</td>
                        </tr> --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right">
                                <strong>
                                <?php
                                $user_id = Illuminate\Support\Facades\Auth::user()->id;
                                $cartTotal = App\Cart::where('status',0)->get()->count();
                                ?> {{ $cartTotal }} barang
                                </strong>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="{{ route('front.dashboard') }}" class="btn btn-block btn-light">Continue Shopping</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <button type="submit" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection