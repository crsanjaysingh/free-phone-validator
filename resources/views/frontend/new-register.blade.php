@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

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

                        <form id="formAuthentication" class="mb-5" action="{{ url('/') }}" method="GET">
                            <div class="mb-5 form-floating form-floating-outline">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter your username" autofocus>
                                <label for="username">Username</label>
                            </div>
                            <div class="mb-5 form-floating form-floating-outline">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email">
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-5 form-password-toggle">
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

                            <div class="py-2 mb-5">
                                <div class="mb-0 form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                                    <label class="form-check-label" for="terms-conditions">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label>
                                </div>
                            </div>
                            <button class="mb-5 btn btn-primary d-grid w-100">
                                Sign up
                            </button>
                        </form>

                        <p class="mb-5 text-center">
                            <span>Already have an account?</span>
                            <a href="{{ url('auth/login-basic') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-script')
    <script>
        var dashboardUrl = "{{ route('dashboard') }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    @vite('resources/assets/frontend/js/register-page.js')
@endpush
