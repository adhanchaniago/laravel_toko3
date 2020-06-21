@extends('layouts.admin')

@section('title')
    Edit Order
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Pesanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Pesanan</li>
    </ol>
</nav>
<div class="card shadow">
    <div class="card-header py-3">
        <h4>Edit Pesanan</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-borderless table-hover">
            <tr>
                <td>Invoice</td>
                <td>:</td>
                <th>{{ $order->invoice }}</th>  
            </tr>
            <br>
            <tr>
                <td>Nama Pemesan</td>
                <td>:</td>
                <th>{{ $order->customer_name }}</th>    
            </tr>
            <tr>
                <td>No Telpon</td>
                <td>:</td>
                <th>{{ $order->customer_phone }}</th>   
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <th>
                    <ul>
                        <li>Provinsi : {{ $order->district->name }}</li>
                        <li>Kabupaten : {{ $order->district->city->name }}</li>
                        <li>Kecamatan : {{ $order->district->city->province->name }}</li>
                        <li>Kode Pos : {{ $order->district->city->postal_code }}</li>
                    </ul>
                </th>   
            </tr>
            <tr>
                <td>Alamat Lengkap</td>
                <td>:</td>
                <th>{{ $order->customer_address }}</th> 
            </tr>
        </table>
        <hr>
    </div>    
    <div class="card-header py-3">
        <h4>Detail Produk Yang Dipesan</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-borderless table-hover">
            <tr>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Berat</th>
                <th>Harga</th>
                <th>Subtotal Berat</th>
                <th>Subtotal Harga</th>
            </tr>
            @foreach ($order->carts()->get() as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>{{ $cart->qty }}</td>
                <td>{{ number_format($cart->product->weight , 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($cart->product->price , 0, ',', '.') }}</td>
                <td>{{ number_format($cart->subtotal_weight , 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($cart->subtotal_price , 0, ',', '.') }}</td>
            </tr>
            @endforeach    
            <tr>
                <td><strong>Total Berat : </strong></td>
                <th><h3><strong>{{ number_format($order->total_weight , 0, ',', '.') }} gr</strong></h3></th>
                <td></td>
                <td></td>
                <td><strong>Total Harga : </strong></td>
                <th><h3><strong>Rp. {{ number_format($order->total_price , 0, ',', '.')  }}</strong></h3></th>
            </tr>
        </table>
        <hr>
    </div>    
    <div class="card-header py-3">
        <h4><strong>Ubah Status Pesanan</strong></h4>
    </div>
    <div class="card-body">
        <form action="{{ route('order.update', $order->id) }}" method="post">
            @csrf
            @method('put')
            <table  class="table table-striped table-borderless table-hover">
                <tr>
                    <td><h5>Status</h5></td>
                    <td>:</td>
                    <th>
                        <select name="status" id="status" class="form-control" required>
                            @if ($order->status == 1)
                            <option value="{{ $order->status }}" selected>Pesanan Masuk</option>
                            @endif
                            @if ($order->status == 2)
                            <option value="{{ $order->status }}" selected>Pesanan Diproses</option>
                            @endif
                            @if ($order->status == 3)
                            @endif
                            @if ($order->status == 4)
                            <option value="{{ $order->status }}" selected>Pesanan Diterima</option>
                            @endif
                            @if ($order->status == 5)
                            <option value="{{ $order->status }}" selected>Pesanan Ditolak</option>
                            @endif
                            <option value="1">Pesanan Masuk</option>
                            <option value="2">Pesanan Diproses</option>
                            <option value="3">Pesanan Dikirim</option>
                            <option value="4">Pesanan Diterima</option>
                            <option value="5">Pesanan Ditolak</option>
                        </select>
                    </th>   
                </tr>
                <tr>
                    <td><h5>Kode Resi Pengiriman</h5></td>
                    <td>:</td>
                    <td>
                        <input type="text" name="receipt" class="form-control" value="{{ $order->receipt }}">
                    </td>
                </tr>
                <tr>
                    <td><h5>Kurir</h5></td>
                    <td>:</td>
                    <td>
                        <select name="courier" id="courier" class="form-control">
                            @isset($order->courier)
                            <option value="{{ $order->courier }}" selected>{{ $order->courier }}</option>
                            @endisset
                            @empty($order->courier)
                                <option value="">--Pilih Agen Kurir--</option>
                            @endempty
                            <option value="JNE">JNE</option>
                            <option value="T&t">J&T</option>
                            <option value="POS">POS</option>
                            <option value="TIKI">TIKI</option>
                            <option value="Sicepat">Sicepat</option>
                            <option value="IndahCargo">IndahCargo</option>
                            <option value="Wahana">Wahana</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><h5>Catatan Penjual</h5></td>
                    <td>:</td>
                    <td>
                        <textarea name="note" id="note" cols="100" rows="10">{{ $order->note }}</textarea>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">Update Pesanan</button>
        </form>
    </div>
</div>    
@endsection