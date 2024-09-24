@extends('layouts/blankLayout')

@section('title', 'Login Page')

<!-- ======== Page Level CSS ======== -->
@section('page-style')
    <!-- Add the custom CSS here -->
    <style>
      body {
          background-image: url({{ asset('assets/img/3.jpg') }});
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          background-attachment: fixed;
      }
  </style>
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
    @vite('resources/assets/frontend/css/login-page.css')
@endsection

@section('content')
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="py-6 mx-4 authentication-inner">
                <!-- Login -->
                <div class="card p-7">
                    <!-- Logo -->
                    <div class="mt-5 app-brand">
                        <a href="{{ url('/') }}" class="app-brand-link">
                            <img src="{{ asset('assets/img/favicon/logo.png') }}" alt="Logo" width="50%">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="mt-1 card-body">
                        <h4 class="mb-1">Welcome to {{ config('app.name') }} 👋🏻</h4>
                        <p class="mb-5">Please sign-in to your account and start the adventure</p>
                        <form id="loginForm"
                            class="mb-5" method="POST" action="{{ route('login') }}" data-dashboard-url="{{ route('dashboard') }}">
                            @csrf
                            <div class="row">
                              <div class="pt-1 pb-1 form-group col-md-12">
                                  <label for="Email">Email</label>
                                  <input type="email" name="email" id="email" class="form-control">
                                  <div class="login-error"></div>
                              </div>
                              <div class="pt-1 pb-1 mb-5 form-group col-md-12">
                                  <label for="Password">Password</label>
                                  <input type="password" name="password" id="password" class="form-control">
                                  <div class="login-error"></div>
                              </div>
                              <div id="form-errors" class="error-container"></div>
                              <div class="pt-2 pb-2 mb-2 d-flex justify-content-between align-items-center">
                                <div class="mb-0 form-check d-none">
                                    <input class="form-check-input" type="checkbox" id="remember_me">
                                    <label class="form-check-label" for="remember_me">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="mb-1 float-end">
                                    <span>Forgot Password?</span>
                                </a>
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" id="loginButton" type="submit" disabled>login</button>
                            </div>
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response"
                            value="">
                          </div>
                        </form>

                        <p class="mb-5 text-center">
                            <span>New on our platform?</span>
                            <a href="{{ route('register') }}">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
        <!-- Bootstrap Modal for OTP Verification -->
        <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="otpForm" action="{{ route('otp.verify.store') }}"
                data-dashboard-url="{{ route('dashboard') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="otp" class="form-label">Enter OTP</label>
                    <input type="text" class="form-control" id="otp" name="otp" required>
                    <div id="otp-error" class="text-danger"></div>
                  </div>
                  <button type="submit" class="btn btn-primary">Verify OTP</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <!-- Bootstrap Modal for OTP Verification -->
@endsection
@push('scripts')
    <script>
        var dashboardUrl = "{{ route('dashboard') }}";
        var recaptchaAction = "{{ 'login' }}";
    </script>
    @vite('resources/assets/frontend/js/login-page-new.js')
    <x-reCAPTCHA />
@endpush
