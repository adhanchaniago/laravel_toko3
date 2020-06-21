@extends('layouts.admin')

@section('title')
    Edit Produk
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
    </ol>
</nav>
<div class="col-md-12">
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf   
        @method('put')
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ $product->name }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                <option value="{{ $product->category_id }}">{{$product->category()->find($product->category_id)->name}}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror"   value="{{ $product->price }}"> 
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="weight">Berat</label>
            <input type="text" id="weight" name="weight" class="form-control @error('weight') is-invalid @enderror"   value="{{ $product->weight }}">
            @error('weight')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="text" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror"   value="{{ $product->stock }}">
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            
            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ $product->description }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Gambar <small>(Opsional)</small></label>
            <input type="file" class="form-control  @error('image') is-invalid @enderror" name="image" id="image" value="{{ $product->image }}">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> 
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
</div>
@endsection