@extends('layouts.admin')

@section('title')
    Edit Kategori
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Kategori</li>
    </ol>
</nav>
<div class="col-md-12">
    <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf   
        @method('put')
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ $category->name }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
</div>
@endsection