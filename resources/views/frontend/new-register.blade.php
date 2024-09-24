@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

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
                <!-- Register Card -->
                <div class="card p-7">
                    <!-- Logo -->
                    <div class="mt-5 app-brand">
                        <a href="{{ url('/') }}" class="app-brand-link">
                            <img src="{{ asset('assets/img/favicon/logo.png') }}" alt="Logo" width="50%">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="mt-1 card-body">
                        <h4 class="mb-1">Adventure starts here 🚀</h4>
                        <p class="mb-5">Make your app management easy and fun!</p>

                        <form id="registerForm" action="{{ route('register') }}"
                        data-dashboard-url="{{ route('login') }}" class="mb-5">
                            @csrf
                            <div class="mt-10 form-group col-md-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <div class="error"></div>
                            </div>
                            <div class="mt-1 form-group col-md-12">
                              <label for="Email">Email</label>
                              <input type="email" name="email" id="email" class="form-control">
                              <div class="error"></div>
                           </div>
                            <div class="mt-1 form-group col-md-12">
                                <label for="Password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <div class="error"></div>
                            </div>
                            <div class="mt-1 form-group col-md-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    id="password_confirmation" class="form-control">
                                <div class="error"></div>
                            </div>
                            <div class="py-2 mb-5">
                                <div class="mb-0 form-check">
                                    <label class="form-check-label" for="terms">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label>
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms">
                                </div>
                            </div>
                            <div id="form-errors" class="error-container"></div>
                            <button class="mb-5 btn btn-primary d-grid w-100" id="registerButton" disabled>
                                Sign up
                            </button>
                            <div id="form-errors" class="error-container"></div>

                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response"
                                value="">
                        </form>

                        <p class="mb-5 text-center">
                            <span>Already have an account?</span>
                            <a href="{{ url('login') }}">
                                <span>Sign in instead</span>
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
    var recaptchaAction = "{{ 'register' }}";
</script>
@vite('resources/assets/frontend/js/register-page.js')
<x-reCAPTCHA />
@endpush
