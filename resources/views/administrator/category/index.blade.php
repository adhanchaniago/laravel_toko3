@extends('layouts.admin')

@section('title')
    Kategori
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
    </ol>
</nav>
{{-- <a href="{{ route('catefory.create') }}" class="btn btn-primary mb-3 shadow"><i class="fas fa-plus"></i> Tambah Produk</a> --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h5 class="font-weight-bold text-secondary">Tambah Kategori Baru</h5>
                <form action="{{ route('category.store') }}" method="post">
                    @csrf   
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            
            <div class="col-md-6 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Aksi<br><small>Update | Hapus</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm mr-2  shadow"><i class="fas fa-edit"></i></a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm  shadow" onclick="return confirm('Yakin hapus kattegori ini?')"><i class="fas fa-ban"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="2">Kategori Kosong</td>
                        @endforelse
                    </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection