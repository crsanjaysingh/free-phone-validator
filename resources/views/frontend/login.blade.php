@extends('layouts/frontend/app')

@section('frontendContent')
    <!-- ======== feature-section start ======== -->
    <section id="login" class="mt-10 feature-extended-section">
        <div class="feature-extended-wrapper mt-86">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card single-feature-extended">
                            <div class="card content">
                                <h3 class="text-center">Login Form</h3>
                                <div class="content">
                                    <form id="loginForm" action="{{ route('login') }}"
                                        data-dashboard-url="{{ route('dashboard') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="Email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control">
                                                <div class="error"></div>
                                            </div>
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="Password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control">
                                                <div class="error"></div>
                                            </div>
                                            <div class="block mt-4 d-none">
                                                <label for="remember_me" class="inline-flex items-center">
                                                    <input id="remember_me" type="checkbox"
                                                        class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                        name="remember">
                                                    <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">Remember
                                                        me</span>
                                                </label>
                                            </div>
                                            <div class="mt-2 form-group col-md-6">
                                                <button type="submit" class="btn btn-primary">Login</button>
                                                <div id="form-errors" class="error-container"></div>
                                            </div>
                                            <div class="mt-2 form-group col-md-6" style="text-align: right">
                                                <a class="" href="{{ route('password.request') }}">
                                                    Forgot your password?
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======== feature-section end ======== -->
@endsection
@push('styles')
    <!-- ======== Page Level CSS ======== -->
@endpush

@push('scripts')
    <script>
        var dashboardUrl = "{{ route('dashboard') }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    @vite('resources/assets/frontend/js/login-page.js')
@endpush
