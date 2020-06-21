@extends('layouts.ecommerce')

@section('content')

{{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
    <div class="carousel-item active">
        <img class="d-block w-100 bg-carousel" src="{{ asset('images/bg1.jpg') }}" alt="First slide">
    </div>
    <div class="carousel-item">
        <img class="d-block w-100 bg-carousel" src="{{ asset('images/bg2.jpg') }}" alt="Second slide">
    </div>
    <div class="carousel-item">
        <img class="d-block w-100 bg-carousel" src="{{ asset('images/bg3.jpg') }}" alt="Third slide">
    </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
</div> --}}
<br><br><br><br>
<div class="container mt-5">
        <h3>List Produk</h3>
        <div class="col-md-12">
            <div class="row">
                @forelse ($products as $product)
                
                <div class="col-lg-3 col-md-4">
                    <div class="card h-70">
                        <a href="{{ url('detail/'. $product->id.'/'. $product->slug) }}"><img class="card-img-top" src="{{ asset('uploads/products/'.$product->image) }}" alt="product image" style="height: 150px"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ url('detail/'. $product->id.'/'. $product->slug) }}">{{ $product->name }}</a>
                            </h4>
                            <h5>Rp. {{ number_format($product->price,0,',','.') }}</h5>
                            <p class="card-text"><span class="badge badge-success">{{ $product->category()->find($product->category_id)->name }}</span></p>
                            <p>Stok : {{ $product->stock }}</p>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div> --}}
                </div>
                @empty
                <h6>Produk kosong</h6>
                @endforelse
            </div>
        </div>
        
    
    </div>
</div>

@endsection