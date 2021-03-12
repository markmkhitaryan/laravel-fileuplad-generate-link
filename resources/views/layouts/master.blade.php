<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('js/jquery.fileupload.js')}}"></script>

        <!--Style File Custom-->
    @yield('styles')
    <!--End Style File Custom-->
</head>
<body>
<div id="app">

<!--Header-->
@include('partials.header')
<!--End Header-->
<!--Content-->

<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
              @yield('content')
            </div>
        </div>
    </div>
</main>
<!--End Content-->

<!--Footer-->
@include('partials.footer')
<!--End Footer-->
</div>
<script src="{{asset('js/custom.js')}}"></script>

<!--Script tag custom-->
@yield('scripts')
<!--End Script tag custom-->
</body>
</html>
