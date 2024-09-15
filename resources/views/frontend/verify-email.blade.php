@extends('layouts/blankLayout')

@section('title', 'Login Page')

<!-- ======== Page Level CSS ======== -->
@section('page-style')
    <!-- Add the custom CSS here -->
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
    @vite('resources/assets/frontend/css/login-page.css')
    @vite('resources/css/app.css')
    <style>
      body {
          background-image: url({{ asset('assets/img/3.jpg') }});
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          background-attachment: fixed;
      }
    .authentication-wrapper.authentication-basic .authentication-inner {
          max-width: 568px;
      }
  </style>
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
                        <h4 class="mb-1">Email Verification</h4>
                        <p class="mb-5">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                        </p>
                         <div class="row">
                          <div class="mb-4 text-sm font-medium text-green-600 dark:xtext-green-400" id="success-message" style="display: none;">
                          </div>
                            <div class="col-md-8">
                                <form method="POST" action="{{ route('verification.send') }}" id="email-verification-form">
                                    @csrf
                                    <div>
                                        <x-primary-button id="email-verification">
                                            {{ __('Resend Verification Email') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="mt-1">
                                  <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                      <button type="submit" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                          {{ __('Log Out') }}
                                      </button>
                                  </form>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var dashboardUrl = "{{ route('dashboard') }}";
    </script>
    @vite('resources/assets/frontend/js/email-verification.js')
@endpush
