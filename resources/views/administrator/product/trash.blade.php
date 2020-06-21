@extends('layouts.admin')

@section('title')
    Produk Nonaktif
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="">Produk</a></li>
    <li class="breadcrumb-item active" aria-current="page">List Produk Nonaktif</li>
    </ol>
</nav>
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
                <th>Aksi<br><small>Aktifkan | Hapus</small></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category()->find($product->category_id)->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->weight }}</td>
                    <td>{{ $product->stock }}</td>
                    <td><img src="{{ asset('uploads/products/' . $product->image) }}" alt="product-image" width="100" height="100"></td>
                    <td>
                        <form action="{{ route('product.burn',$product->id) }}" method="post">
                            <a href="{{ route('product.restore', $product->id) }}" class="btn btn-success btn-sm mr-2"><i class="fas fa-check-circle"></i></a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus permanen produk ini?')"><i class="fas fa-trash"></i></button>
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