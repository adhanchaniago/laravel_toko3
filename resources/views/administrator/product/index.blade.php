@extends('layouts.admin')

@section('title')
    Daftar Produk
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Produk</li>
    </ol>
</nav>
<a href="{{ route('product.create') }}" class="btn btn-primary mb-3 shadow"><i class="fas fa-plus"></i> Tambah Produk</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Aksi<br><small>Update | Nonaktifkan</small></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category()->find($product->category_id)->name }}</td>
                    <td align="right">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ number_format($product->weight, 0, ',', '.') }} gr</td>
                    <td>{{ number_format($product->stock, 0, ',', '.') }}</td>
                    <td><img src="{{ asset('uploads/products/' . $product->image) }}" alt="product-image" width="100" height="100"></td>
                    <td>
                        <form action="{{ route('product.destroy',$product->id) }}" method="post">
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm mr-2  shadow"><i class="fas fa-edit"></i></a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-warning btn-sm  shadow"><i class="fas fa-ban"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <td colspan="6">Produk Kosong</td>
            @endforelse
        </tbody>
        </table>
        {{ $products->links() }}
    </div>
    </div>
</div>

@endsection