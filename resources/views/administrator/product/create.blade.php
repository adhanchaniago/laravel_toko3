@extends('layouts.admin')

@section('title')
    Tambah Produk Baru
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
    </ol>
</nav>
<div class="col-md-12">
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf   
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror"  required>
                <option value="">--Pilih Kategori--</option>
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
            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror"   value="{{ old('price') }}" required> 
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="weight">Berat</label>
            <input type="text" id="weight" name="weight" class="form-control @error('weight') is-invalid @enderror"   value="{{ old('weight') }}" required>
            @error('weight')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="text" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror"   value="{{ old('stock') }}" required>
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            
            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Gambar</label>
            <input type="file" class="form-control  @error('image') is-invalid @enderror" name="image" id="image" value="{{ old('image') }}" required>
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> 
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection