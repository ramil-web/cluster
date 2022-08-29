<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

@yield('content')

<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    function initGoogleMap() {
        console.log('Map init');
        jQuery('body').trigger('googleMapInit')
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFkhR8lmvTCz5HZBYDPi1dIhfKZvOqsEY&callback=initGoogleMap" async ></script>


</body>
</html>
