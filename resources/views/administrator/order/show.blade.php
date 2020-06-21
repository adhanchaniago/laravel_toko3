@extends('layouts.admin')

@section('title')
    Detail Pesanan
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Pesanan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
    </ol>
</nav>
<tr>
    <div class="card shadow">
        <div class="card-header py-3">
            <h4>Detail Pesanan</h4>
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
                            <li>Provinsi : {{ $order->district->city->province->name }}</li>
                            <li>Kabupaten : {{ $order->district->city->name }}</li>
                            <li>Kecamatan : {{ $order->district->name }}</li>
                            <li>Kode Pos : {{ $order->district->city->postal_code }}</li>
                        </ul>
                    </th>   
                </tr>
                <tr>
                    <td>Alamat Lengkap</td>
                    <td>:</td>
                    <th>{{ $order->customer_address }}</th> 
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <th>
                        @if ($order->status == 1)
                        <span class="badge badge-warning">Pesanan Masuk</span>
                        @endif
                        @if ($order->status == 2)
                        <span class="badge badge-success">Pesanan Diproses</span>
                        @endif
                        @if ($order->status == 3)
                        <span class="badge badge-info">Pesanan Didikirim</span>
                        @endif
                        @if ($order->status == 4)
                        <span class="badge badge-primary">Pesanan Diterima</span>
                        @endif
                        @if ($order->status == 5)
                        <span class="badge badge-danger">Pesanan Ditolak</span>
                        @endif
                    </th>   
                </tr>
                <tr>
                    <td>Agen Kurir</td>
                    <td>:</td>
                    <th>
                        {{ $order->courier }}
                        @empty($order->courier)
                            <small><i>Barang belum dikirim</i></small>
                        @endempty
                    </th> 
                </tr>
                <tr>
                    <td>Kode Resi</td>
                    <td>:</td>
                    <th>
                        {{ $order->receipt }}
                        @empty($order->receipt)
                            <small><i>Barang belum dikirim</i></small>
                        @endempty
                    </th> 
                </tr>
                <tr>
                    <td>Catatan Penjual</td>
                    <td>:</td>
                    <td>
                        <i>{{ $order->note }}</i>
                        @empty($order->note)
                            <small><i>-</i></small>
                        @endempty
                    </td> 
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
                    <td>{{ number_format($cart->subtotal_weight , 0, ',', '.') }} gr</td>
                    <td>Rp. {{ number_format($cart->subtotal_price , 0, ',', '.') }}</td>
                </tr>
                @endforeach    
                <tr>
                    <td><strong>Total Berat : </strong></td>
                    <th><h3><strong>{{ number_format($order->total_weight , 0, ',', '.') }}</strong></h3></th>
                    <td></td>
                    <td></td>
                    <td><strong>Total Harga : </strong></td>
                    <th><h3><strong>Rp. {{ number_format($order->total_price , 0, ',', '.')  }}</strong></h3></th>
                </tr>
            </table>
            <hr>
        </div>    
    </div>    
</tr>
<br><br> 

@endsection