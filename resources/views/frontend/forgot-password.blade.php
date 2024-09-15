@extends('layouts/blankLayout')

@section('title', 'Login Page')

<!-- ======== Page Level CSS ======== -->
@section('page-style')
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
                        <h4 class="mb-1">Forgot Password</h4>
                        <p class="mb-5">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>
                        <form id="forgotPasswordForm"
                            class="mb-5" method="POST" action="{{ route('password.email') }}" data-dashboard-url="{{ route('dashboard') }}">
                            @csrf
                            <div class="row">
                              <div id="form-errors"></div>
                              <div class="pt-1 pb-2 form-group col-md-12">
                                  <label for="Email">Email</label>
                                  <input type="email" name="email" id="email" class="form-control">
                                  <div class="login-error"></div>
                              </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit"> Email Password Reset Link</button>
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
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var dashboardUrl = "{{ route('dashboard') }}";
        var recaptchaAction = "{{ 'forgotpassword' }}";
    </script>
    @vite('resources/assets/frontend/js/forgot-password.js')
    <x-reCAPTCHA />
@endpush
