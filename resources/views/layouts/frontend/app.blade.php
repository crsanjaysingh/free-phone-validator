<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $title ?? config('app.name', 'Call Validater') }}</title>
    <meta name="description"
        content="Welcome to Knot Networks LLC, a leading American telecommunication service provider specializing in offering Toll Free Numbers to businesses of all sizes." />
    <meta name="keywords" content="Knot Networks LLC  Telecommunication,toll free service provider,toll free number">
    <link rel="canonical" href="https://www.knotnetworks.com/" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}" />
    <!-- Place favicon.ico in the root directory -->

    <!-- ======== CSS here ======== -->

    @vite('resources/assets/frontend/css/bootstrap.min.css')
    @vite('resources/assets/frontend/css/frontend-main.css')
    @vite('resources/assets/frontend/css/animate.css')
    @vite('resources/assets/frontend/css/lineicons.css')
    @vite('resources/assets/frontend/css/custom.css')
    <!-- Page Specific CSS -->
    @stack('styles')
    <style>
        .footer-widget .logo img {
            max-width: 250px;
        }
    </style>
</head>

<body>

    <!-- ======== preloader start ======== -->
    @include('layouts.frontend.prelaoder')
    <!-- preloader end -->

    <!-- ======== header start ======== -->
    @include('layouts.frontend.header')
    <!-- ======== header end ======== -->

    <!-- ======== main content start ======== -->
    @yield('frontendContent')
    <!-- ======== main content end ======== -->

    <!-- ======== footer start ======== -->
    @include('layouts.frontend.footer')
    <!-- ======== footer end ======== -->

    <!-- ======== scroll-top ======== -->
    <a href="#" class="scroll-top btn-hover">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ======== JS here ======== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite('resources/assets/frontend/js/bootstrap.bundle.min.js')
    @vite('resources/assets/frontend/js/wow/wow.bundle.min.js')
    @vite('resources/assets/frontend/js/wow/wow.min.js')
    @vite('resources/assets/frontend/js/frontend-main.js')
    @vite('resources/assets/frontend/js/app.js')
    <!-- Page Specific JS -->
    @stack('scripts')
</body>

</html>
