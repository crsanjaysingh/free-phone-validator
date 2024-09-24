@php
$containerFooter = !empty($containerNav) ? $containerNav : 'container-fluid';
@endphp

<!-- Footer -->
<footer class="text-center content-footer footer bg-footer-theme">
  <div class="{{ $containerFooter }}">
    <div class="py-4 footer-container">
      <div class="text-body">
        © 12<script>document.write(new Date().getFullYear())</script>, made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by <a href="{{ (!empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '') }}" target="_blank" class="footer-link">{{ (!empty(config('variables.creatorName')) ? config('variables.creatorName') : '') }}</a>
      </div>
    </div>
  </div>
</footer>
<!--/ Footer -->
