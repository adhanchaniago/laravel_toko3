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
<link href="{{ asset('customer/assets/css/material-kit.css?v=2.0.7') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

<link href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="index-page">
<div class="wrapper">
    <div class="container">
        @yield('content')
    </div>
</div>

<!--   Core JS Files   -->
<script src="{{ asset('customer/assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer/assets/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('customer/assets/js/plugins/moment.min.js') }}"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="{{ asset('customer/assets/js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('customer/assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
<!--  Google Maps Plugin  -->
<script type="{{ asset('customer/text/javascript') }}" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('customer/assets/js/material-kit.js?v=2.0.7') }}" type="text/javascript"></script>


@include('sweetalert::alert')
@yield('js')
</body>

</html>