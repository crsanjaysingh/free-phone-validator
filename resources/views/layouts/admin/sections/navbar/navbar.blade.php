@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(1)
      <div class="py-0 navbar-brand app-brand demo d-none d-xl-flex me-6">
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
          <i class="align-middle ri-close-fill"></i>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="px-0 nav-item nav-link me-xl-6" href="javascript:void(0)">
          <i class="ri-menu-fill ri-24px"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            <i class="ri-search-line ri-22px me-1_5"></i>
            <input type="text" class="border-0 shadow-none form-control ps-1 ps-sm-2 ms-50" placeholder="Search..." aria-label="Search...">
          </div>
        </div>
        <ul class="flex-row navbar-nav align-items-center ms-auto">
          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="p-0 nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                @if (!empty(auth()->user()->profile_image))
                    @php
                       $imageUrl = asset('storage/' . auth()->user()->profile_image);
                    @endphp
                @else
                    @php
                        $imageUrl = asset('assets/img/avatars/1.png');
                    @endphp
                @endif
                <img src="{{ $imageUrl }}" alt class="h-auto w-px-40 rounded-circle">
              </div>
            </a>
            <ul class="py-2 mt-3 dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                      <div class="avatar avatar-online">
                        <img src="{{ $imageUrl }}" alt="user-avatar" class="h-auto w-px-40 rounded-circle" id="uploadedAvatar" />
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0 small">{{ auth()->user()->name }}</h6>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route("admin.profile") }}">
                  <i class="ri-user-3-line ri-22px me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <div class="px-4 pt-2 pb-1 d-grid">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="btn btn-danger d-flex" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                          <small class="align-middle">Logout</small>
                          <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                        </a>
                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
