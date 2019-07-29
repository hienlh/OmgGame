<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="OMG Game - Admin Panel">
    <meta name="author" content="Hieren Lee">
    <meta name="keyword"
          content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>OMG Game - Admin Panel</title>

    <!-- Icons -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Styles required by this views -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<!-- BODY options, add following classes to body to change options
'.header-fixed' - Fixed Header
'.brand-minimized' - Minimized brand (Only symbol)
'.sidebar-fixed' - Fixed Sidebar
'.sidebar-hidden' - Hidden Sidebar
'.sidebar-off-canvas' - Off Canvas Sidebar
'.sidebar-minimized'- Minimized Sidebar (Only icons)
'.sidebar-compact'    - Compact Sidebar
'.aside-menu-fixed' - Fixed Aside Menu
'.aside-menu-hidden'- Hidden Aside Menu
'.aside-menu-off-canvas' - Off Canvas Aside Menu
'.breadcrumb-fixed'- Fixed Breadcrumb
'.footer-fixed'- Fixed footer
-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
@include('templates.admin.panel.navbar')

<div class="app-body">
@include('templates.admin.panel.sidebar')
<!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
    @include('templates.admin.panel.breadcrumb')

    @yield('content')
    <!-- /.container-fluid -->
    </main>

    @include('templates.admin.panel.asidemenu')

</div>

@include('templates.admin.panel.footer')

@include('templates.admin.panel.scripts')
@yield('myscript')

</body>
</html>
