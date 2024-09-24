@php
$containerFooter = !empty($containerNav) ? $containerNav : 'container-fluid';
@endphp

<!-- Footer -->
<footer class="text-center content-footer footer bg-footer-theme">
  <div class="{{ $containerFooter }}">
    <div class="py-4 footer-container">
      <div class="text-body">
        Copyright ©2020-{{ date("Y") }} <a href="{{ route('home') }}" target="_blank" class="footer-link">Knotnetworks LLC</a>. All Rights Reserved
      </div>
    </div>
  </div>
</footer>
<!--/ Footer -->
