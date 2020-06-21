@extends('layouts.admin')

@section('title')
    Pesanan
@endsection

@section('content')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
    </ol>
</nav>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Nama Pengguna</th>
                <th>Nama Pemesan</th>
                <th>No Telpon</th>
                <th>List Pesanan</th>
                <th>Status</th>
                <th>Aksi<br><small>Detail | Update | Hapus</small></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>
                        @foreach ($order->carts()->get() as $cart)
                            <ul>
                                <li>{{ $cart->product->name }}</li>
                            </ul>
                        @endforeach
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
                    <td>
                        <form action="{{ route('order.destroy',$order->id) }}" method="post">
                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-info btn-sm mr-2  shadow"><i class="fas fa-edit"></i></a>
                            @csrf
                            @method('delete')
                            @if ($order->status == 4)
                                <button type="submit" class="btn btn-danger btn-sm  shadow"><i class="fas fa-ban" onclick="return confirm('Hapus pesanan yang telah selesai?')"></i></button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <td colspan="6">Pesanan kosong</td>
            @endforelse
        </tbody>
        </table>
        {{ $orders->links() }}
    </div>
    </div>
</div>
@endsection