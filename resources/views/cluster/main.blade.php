<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {!! SEO::generate(true) !!}
</head>
<body id="body" data-spy="scroll" data-target=".header">
    @include('cluster.header')

    <div id="big_slider_wrap" class="hidden-xs">
        @section('main_slider')@show
    </div>
    
    <div class="container">
        @section('content')
            @include('cluster.components.breadcrumbs.breadcrumbs')

        @show
    </div>

    @include('cluster.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        function initGoogleMap() {
            console.log('Map init');
            $('body').trigger('googleMapInit')
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFkhR8lmvTCz5HZBYDPi1dIhfKZvOqsEY&callback=initGoogleMap" async ></script>

    @yield('page_scripts')
</body>
</html>
