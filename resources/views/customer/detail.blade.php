@extends('layouts.ecommerce')

@section('title')
    Detail {{ $product->name }}
@endsection

@section('content')
<br><br><br><br>
<div class="container">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('front.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
    <div class="row mt-5">
        <div class="col-md-6">
            <img class="img-fluid" src="{{ asset('uploads/products/'.$product->image) }}" alt="product image">
        </div>
    
        <div class="col-md-6">
            <h3 class="my-3">{{ $product->name }}</h3>
            <table class="table table-striped">
                <tr>
                    <th>Deskripsi</th>
                    <td>:</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>:</td>
                    <td><span class="badge badge-info">{{ $product->category()->find($product->category_id)->name }}</span></td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>:</td>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th>Berat</th>
                    <td>:</td>
                    <td>{{ $product->weight }} gr</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>:</td>
                    <td>Rp. {{ number_format($product->price,0,',','.') }}</td>
                </tr>
            </table>
            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success btn-round"><i class="fas fa-cart-plus"></i> Masukkan Keranjang</a>
        </div>
    </div>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
</div>
    
@endsection