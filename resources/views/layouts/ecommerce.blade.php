<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('customer/') }}./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('customer/') }}./assets/img/favicon.png">
    <title>
        @yield('title') - BloowEcommerce
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Nucleo Icons -->
    <link href="{{ asset('customer_assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('customer_assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('customer_assets/assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('customer_assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('customer_assets/assets/css/argon-design-system.css?v=1.2.0') }}" rel="stylesheet" />
</head>

<body class="index-page">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
    <div class="container">
        <a class="navbar-brand" href="javascript:;">Bloow> <small>Ecommerce</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-inner-primary" aria-controls="nav-inner-primary" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-inner-primary">
            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.dashboard') }}">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    
                    <a class="nav-link nav-link-icon" href="#"  id="product" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Produk <small><i class="fas fa-caret-down"></i></small>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="product">
                        <a class="dropdown-item" href="#">Smartphone</a>
                        <a class="dropdown-item" href="#">Laptop</a>
                        <a class="dropdown-item" href="#">TV</a>
                        <a class="dropdown-item" href="#">Pakaian</a>
                    </div>
                </li>
                @isset(Illuminate\Support\Facades\Auth::user()->id)
                <li class="nav-item p-0 mr-2">
                    <?php
                        $user_id = Illuminate\Support\Facades\Auth::user()->id;
                        $order_list = App\Order::where('status','!=',5)->where('status','!=',5)->where('status','!=',0)->where('user_id',$user_id)->get()->count();
                    ?>
                    <a class="nav-link" href="{{ route('order_list') }}"><i class="fas fa-shopping-bag"></i>@if ($order_list > 0)
                    <span class="badge badge-danger">{{ $order_list }}</span>@endif </a>
                </li>
                <li class="nav-item p-0 mr-2">
                    <?php
                        $user_id = Illuminate\Support\Facades\Auth::user()->id;
                        $cartTotal = App\Cart::where('status',0)->where('user_id',$user_id)->get()->count();
                    ?>
                    <a class="nav-link" href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>@if ($cartTotal > 0)
                    <span class="badge badge-danger">{{ $cartTotal }}</span>@endif </a>
                </li>
                @endisset
            </ul>
        </div>
    </div>
    @isset(Illuminate\Support\Facades\Auth::user()->id)
    <li class="nav-item dropdown">
        <a class="btn btn-sm btn-white" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-settings-gear-65"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profil</a>
            <a class="dropdown-item" href="{{ route('order_list') }}"><i class="fas fa-shopping-bag"></i> Pesanan</a>
            <div class="dropdown-divider"></div>
            {{-- <hr> --}}
            <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </li>
    @endisset
    @empty(Illuminate\Support\Facades\Auth::user()->id)
    <div class="nav-item mr-2">
        <a class="nav-link btn btn-white" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
    </div>
    @endempty
</nav>



<!-- End Navbar -->
<div class="wrapper">
    <div class="container">
        @yield('content')
    </div>
</div>



<footer class="footer footer-default  bg-white" >
    <div class="container">
        <nav class="float-left">
            <ul>
            <li>
                <a href="#">
                    Bloow> Ecommerce
                </a>
            </li>
            </ul>
        </nav>
    </div>
</footer> <!-- Core -->
<!--   Core JS Files   -->
<script src="{{ asset('customer_assets/assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer_assets/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer_assets/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer_assets/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!--  Plugin or Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('customer_assets/assets/js/plugins/bootstrap-switch.js') }}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('customer_assets/assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer_assets/assets/js/plugins/moment.min.js') }}"></script>
<script src="{{ asset('customer_assets/assets/js/plugins/datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer_assets/assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/argon-design-system.min.js?v=1.2.0" type="text/javascript"></script>

<!-- Argon JS -->
<script src="{{ asset('customer_assets/assets/js/argon-design-system.js') }}"></script>
@include('sweetalert::alert')
@yield('js')
</body>

</html>