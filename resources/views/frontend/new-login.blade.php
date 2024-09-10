@extends('layouts/blankLayout')

@section('title', 'Login Page')

<!-- ======== Page Level CSS ======== -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
    <!-- Add the custom CSS here -->
    <style>
        body {
            background-image: url({{ asset('assets/img/3.jpg') }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .div-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .app-brand {
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically (if needed) */
        }

        .app-brand-link {
            display: flex;
            justify-content: center;
            /* Center horizontally */
        }

        .app-brand img {
            display: block;
            max-width: 100%;
            /* Ensure the image is responsive */
            height: auto;
            /* Maintain aspect ratio */
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
                        <h4 class="mb-1">Welcome to {{ config('app.name') }} 👋🏻</h4>
                        <p class="mb-5">Please sign-in to your account and start the adventure</p>

                        <form id="loginForm" action="{{ route('login') }}" data-dashboard-url="{{ route('dashboard') }}"
                            class="mb-5" method="POST">
                            @csrf
                            <div class="mb-5 form-floating form-floating-outline">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus>
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="cursor-pointer input-group-text"><i
                                                class="ri-eye-off-line ri-20px"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2 pb-2 mb-5 d-flex justify-content-between align-items-center d-none">
                                <div class="mb-0 form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="mb-1 float-end">
                                    <span>Forgot Password?</span>
                                </a>
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit">login</button>
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
@endsection
@push('page-script')
    <script>
        var dashboardUrl = "{{ route('dashboard') }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    @vite('resources/assets/frontend/js/login-page.js')
@endpush
