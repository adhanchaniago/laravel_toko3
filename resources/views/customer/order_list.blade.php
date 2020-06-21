@extends('layouts.ecommerce')

@section('title')
    List Pesanan
@endsection

@section('content')
    <br><br><br><br>
    
<div class="container mb-5 mt-5">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('front.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">List Pesanan</li>
        </ol>
    </nav>
    <table class="table table-striped table-hover mt-5">
        <thead>
            <tr>
                <th scope="col">Invoice</th>
                <th scope="col">Nama Pembeli</th>
                <th scope="col">Produk Pesanan</th>
                <th scope="col">Status</th>
                <th scope="col">Total Berat</th>
                <th scope="col">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>
                        <ul>
                        @foreach ($order->carts as $cart)
                            <li>{{ $cart->product->name }}</li>
                        @endforeach
                        </ul>
                    </td>
                    <td>
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
                    </td>
                    <td  align="right">{{ number_format($order->total_weight,0,',','.') }}</td>
                    <td  align="right">Rp. {{ number_format($order->total_price,0,',','.') }}</td>
                </tr>
            @empty
                <td>Pesanan kosong</td>
            @endforelse
        </tbody>
    </table>

<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
@endsection