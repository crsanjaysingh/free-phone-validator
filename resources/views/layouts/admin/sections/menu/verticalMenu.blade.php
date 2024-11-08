<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  <div class="card">
    <div class="app-brand demo">
      <a href="{{ route("admin.dashboard") }}" class="app-brand-link">
          <span class="mt-3 app-brand-logo">
              <img src="{{ asset("/assets/img/favicon/logo.png") }}" alt="Logo" width="200px">
          </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
          <i class="align-middle menu-toggle-icon d-xl-block"></i>
      </a>
  </div>

  <div class="menu-inner-shadow"></div>
  <div style="min-height: 100vh">
    <ul class="py-1 menu-inner ps ps--active-y">
          <li class="menu-item open">
            <a href="{{ route("admin.dashboard") }}" class="menu-link open" style="{{ Route::is('admin.dashboard') ? 'background-color: #2e263d0f;' : '' }}">
                <i class="menu-icon tf-icons ri-home-smile-line"></i>
                <div>Dashboards</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin.users.index') ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
              <i class="menu-icon tf-icons ri-layout-2-line"></i>
              <div>Users</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ route("admin.users.index") }}" class="menu-link">
                    <div>Listing</div>
                </a>
              </li>
          </ul>
        </li>
        <li class="menu-item {{ Route::is('admin.lookup.index') ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
              <i class="menu-icon tf-icons ri-layout-2-line"></i>
              <div>Recent Lookups</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ route("admin.lookup.index") }}" class="menu-link">
                    <div>Phone Lookups</div>
                </a>
              </li>
          </ul>
        </li>
        <li class="menu-item {{ Route::is('admin.plans.index') ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
              <i class="menu-icon tf-icons ri-layout-2-line"></i>
              <div>Plans</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ route("admin.plans.index") }}" class="menu-link">
                    <div>Phone Plans</div>
                </a>
              </li>
          </ul>
        </li>
        <li class="menu-item {{ Route::is('admin.wallet.history') ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
              <i class="menu-icon tf-icons ri-layout-2-line"></i>
              <div>Transactions</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ route("admin.wallet.history") }}" class="menu-link">
                    <div>Wallet History</div>
                </a>
              </li>
          </ul>
        </li>
        <li class="menu-item {{ (Route::is('admin.profile') || Route::is('admin.profile')) ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle waves-effect">
              <i class="menu-icon tf-icons ri-settings-2-line"></i>
              <div>Settings</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ route("admin.profile") }}" class="menu-link">
                    <div>Profile</div>
                </a>
              </li>
              <li class="menu-item d-none ">
                <a href="{{ route("admin.profile") }}" class="menu-link">
                    <div>Footer</div>
                </a>
              </li>
          </ul>
        </li>
        <li class="menu-item ">
              <div class="logout" style="margin: 9px 38px 0 25px;">
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
  </div>
  </div>
</aside>
