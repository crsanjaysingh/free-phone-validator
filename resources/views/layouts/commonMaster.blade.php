<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}"
    data-base-url="{{ url('/') }}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | Knot Networks </title>
    <meta name="description"
        content="Knot Networks" />
    <meta name="keywords"
        content="Knot Networks">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}" />


    <!-- Include Styles -->
    @include('layouts/sections/styles')

    <!-- Include Scripts for customizer, helper, analytics, config -->
    @include('layouts/sections/scriptsIncludes')
    <!-- Page Specific CSS -->
    @stack('styles')
    <style>
      a.btn.btn-sm.btn-primary {
          color: #FFF;
      }
      .right_area {
          margin-right: 26px;
          margin-top: 15px;
      }
    </style>
</head>

<body>

    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->


    <!-- Include Scripts -->
    @include('layouts/sections/scripts')
    @stack('scripts')
    <script>

    // Toastr options
    // toastr.options = {
    //   "closeButton": true,
    //   "debug": false,
    //   "newestOnTop": false,
    //   "progressBar": true,
    //   "positionClass": "toast-top-right",
    //   "preventDuplicates": false,
    //   "onclick": null,
    //   "showDuration": "300",
    //   "hideDuration": "1000",
    //   "timeOut": "5000",
    //   "extendedTimeOut": "1000",
    //   "showEasing": "swing",
    //   "hideEasing": "linear",
    //   "showMethod": "fadeIn",
    //   "hideMethod": "fadeOut"
    // };


      $.validator.addMethod("filesize", function(value, element, param) {
          return this.optional(element) || (element.files[0].size <= param);
      }, "File size must be less than 800KB.");

      $.validator.addMethod("select", function(value, element) {
          return value !== "";
      }, "Please select a country.");

      setTimeout(function() {
          $('.alert').fadeOut('slow');
      }, 3000);
    </script>
</body>

</html>
