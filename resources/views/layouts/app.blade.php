<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    <!-- Bootstrap -->
    <link href="{{ asset("admin/css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("admin/css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset("admin/css/nprogress.css") }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset("admin/css/green.css") }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset("admin/css/bootstrap-progressbar-3.3.4.min.css") }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset("admin/css/jqvmap.min.css") }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset("admin/css/daterangepicker.css") }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset("admin/css/custom.min.css") }}" rel="stylesheet">
    @yield('styles')

    @yield('head')
</head>
<body class="@yield('body_class')">

    {{--Page--}}
    @yield('page')

    <!-- jQuery -->
    <script src="{{ asset("admin/js/jquery.min.js") }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset("admin/js/bootstrap.min.js") }}"></script>
    <!-- FastClick -->
    <script src="{{ asset("admin/js/fastclick.js") }}"></script>
    <!-- NProgress -->
    <script src="{{ asset("admin/js/nprogress.js") }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset("admin/js/Chart.min.js") }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset("admin/js/gauge.min.js") }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset("admin/js/bootstrap-progressbar.min.js") }}"></script>
    <!-- iCheck -->
    <script src="{{ asset("admin/js/icheck.min.js") }}"></script>
    <!-- Skycons -->
    <script src="{{ asset("admin/js/skycons.js") }}"></script>
    <!-- Flot -->
    <script src="{{ asset("admin/js/jquery.flot.js") }}"></script>
    <script src="{{ asset("admin/js/jquery.flot.pie.js") }}"></script>
    <script src="{{ asset("admin/js/jquery.flot.time.js") }}"></script>
    <script src="{{ asset("admin/js/jquery.flot.stack.js") }}"></script>
    <script src="{{ asset("admin/js/jquery.flot.resize.js") }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset("admin/js/jquery.flot.orderBars.js") }}"></script>
    <script src="{{ asset("admin/js/jquery.flot.spline.min.js") }}"></script>
    <script src="{{ asset("admin/js/curvedLines.js") }}"></script>
    <!-- DateJS -->
    <script src="{{ asset("admin/js/date.js") }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset("admin/js/jquery.vmap.js") }}"></script>
    <script src="{{ asset("admin/js/jquery.vmap.world.js") }}"></script>
    <script src="{{ asset("admin/js/jquery.vmap.sampledata.js") }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset("admin/js/moment.min.js") }}"></script>
    <script src="{{ asset("admin/js/daterangepicker.js") }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset("admin/js/custom.min.js") }}"></script>

    {{--Scripts--}}
    @yield('scripts')
</body>
</html>
