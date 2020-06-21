@extends('layouts.ecommerce')

@section('title')
    Checkout
@endsection

@section('content')
<br><br><br><br><br>
<div class="row">
    <div class="col-md-12 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('front.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart') }}">Keranjang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
            </ol>
        </nav>    
    </div>  
    <div class="col-md-6">
    <h4>Detail Pemesanan</h4>
    @isset($carts)
        <form action="{{ route('checkout_process') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Nomor Hp</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" required {{ old('phone') }}>
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" required {{ old('address') }}>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="province_id">Provinsi</label>
                <select name="province_id" id="province_id" class="form-control bg-default @error('province_id') is-invalid @enderror" required {{ old('province_id') }}>
                    <option value="">--Pilih Provinsi--</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                    @error('province_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </select>
                @error('province_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="city_id">Kota/Kabupaten</label>
                <select name="city_id" id="city_id" class="form-control bg-default @error('city_id') is-invalid @enderror" required {{ old('city_id') }}>
                    <option value="">--Pilih Kota/Kabupaten--</option>
                    @error('city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </select>
                @error('city_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="district_id">Kecamatan</label>
                <select name="district_id" id="district_id" class="form-control bg-default @error('district_id') is-invalid @enderror" required {{ old('district_id') }}>
                    <option value="">--Pilih Kecamatan--</option>
                    @error('district_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </select>
                @error('district_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @foreach ($carts as $cart)
            <input type="hidden" name="id" value="{{ $cart->id }}">
            <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
            @endforeach
            <div class="form-group">
                <label for="note">Tambah Catatan untuk Penjual (Opsional)</label>
                <textarea name="note" id="note" cols="50" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Bayar Pesanan</button>
        </form>        
    @endisset
        
    @empty($carts)
    <br>
        <h5 class="text-mutted">Tambahkan terlebih dahulu barang ke keranjang</h5>
    @endempty
    </div>
    <div class="col-md-6">
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <td align="right"><strong>Harga</strong></td>
                    <td align="right"><strong>Subtotal</strong></td>
                </tr>
            </thead>
            <?php $no=1; ?>
        @forelse ($carts as $cart)
            <tbody>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $cart->name }}</td>
                <td>{{ $cart->qty }}</td>
                <td align="right">Rp. {{ number_format($cart->product->price,0,',','.') }}</td>
                <td align="right">Rp. {{ number_format($cart->qty * $cart->product->price,0,',','.') }}</td>
                
            </tr>

            @empty
            <tr>
                <td colspan="6">Keranjang Kosong</td>
            </tr>
            @endforelse
            </table>
        </tbody>
    </div>
</div>
<br><br><br><br><br>

@endsection

@section('js')
    
<script>

    //from daengweb thanks !!!


    //KETIKA SELECT BOX DENGAN ID province_id DIPILIH
    $('#province_id').on('change', function() {
        //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
        //DAN MENGIRIMKAN DATA PROVINCE_ID
        $.ajax({
            url: "{{ url('/api/city') }}",
            type: "GET",
            data: { province_id: $(this).val() },
            success: function(html){
                //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                $('#city_id').empty()
                //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function(key, item) {
                    $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                })
            }
        });
    })

    //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
    $('#city_id').on('change', function() {
        $.ajax({
            url: "{{ url('/api/district') }}",
            type: "GET",
            data: { city_id: $(this).val() },
            success: function(html){
                $('#district_id').empty()
                $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                $.each(html.data, function(key, item) {
                    $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                })
            }
        });
    })
</script>
@endsection