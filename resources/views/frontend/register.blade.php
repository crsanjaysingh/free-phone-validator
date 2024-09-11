@extends('layouts/frontend/app')

@section('frontendContent')
    <!-- ======== feature-section start ======== -->
    <section id="register" class="mt-10 feature-extended-section">
        <div class="feature-extended-wrapper mt-86">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card single-feature-extended">
                            <div class="card content">
                                <h3 class="text-center">Registration Form</h3>
                                <div class="content">
                                    <form id="registerForm" action="{{ route('register') }}"
                                        data-dashboard-url="{{ route('login') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                                <div class="error"></div>
                                            </div>
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
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control">
                                                <div class="error"></div>
                                            </div>
                                            <div class="mt-2 form-group col-md-6">
                                                <button type="submit" class="btn btn-primary">Register</button>
                                                <div id="form-errors" class="error-container"></div>
                                            </div>
                                            <div class="mt-2 form-group col-md-6" style="text-align: right">
                                                <a href="{{ route('login') }}" class="btn btn-primary">Already have an
                                                    account? Login here</a>
                                                <div id="form-errors" class="error-container"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response"
                                            value="">
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
        var recaptchaAction = "{{ 'register' }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    @vite('resources/assets/frontend/js/register-page.js')
    <!-- Include the reCAPTCHA v3 script -->
    <x-reCAPTCHA />
@endpush
