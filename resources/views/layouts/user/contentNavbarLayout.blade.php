@extends('layouts/user/commonMaster' )

@php
/* Display elements */
$contentNavbar = true;
$containerNav = ($containerNav ?? 'container-xxl');
$isNavbar = ($isNavbar ?? true);
$isMenu = ($isMenu ?? true);
$isFlex = ($isFlex ?? false);
$isFooter = ($isFooter ?? true);

/* HTML Classes */
$navbarDetached = 'navbar-detached';

/* Content classes */
$container = ($container ?? 'container-xxl');

@endphp

@section('layoutContent')
<div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
  <div class="layout-container">

    @if ($isMenu && auth()->check())
      @if (auth()->user()->hasRole('user'))
          @include('layouts/user/sections/menu/verticalMenu')
      @endif
    @endif

    <!-- Layout page -->
    <div class="layout-page">
      <!-- BEGIN: Navbar-->
      @if ($isNavbar && auth()->check())
        @if (auth()->user()->hasRole('user'))
            @include('layouts/user/sections/navbar/navbar')
        @endif
      @endif
      <!-- END: Navbar-->


      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        @if ($isFlex)
        <div class="{{$container}} d-flex align-items-stretch flex-grow-1 p-0">
          @else
          <div class="{{$container}} flex-grow-1 container-p-y">
            @endif
            @include('_partials.flash-messages')
            @yield('content')

          </div>
          <!-- / Content -->

          <!-- Footer -->
          @if ($isFooter)
          @include('layouts/admin/sections/footer/footer')
          @endif
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!--/ Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    @if ($isMenu)
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
  @endsection