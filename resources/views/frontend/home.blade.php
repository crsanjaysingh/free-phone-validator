@extends('layouts/frontend/app')

@section('frontendContent')
    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <!-- ======== typer start ======== -->
                        <h1 class="typer-heading">Free
                            <span class="typer" id="main" data-words="Call Validation,Fraud Prevention,Data Validation"
                                data-delay="100" data-deleteDelay="1000" data-colors="#fdd447"></span>
                            <span class="cursor" data-owner="main"></span>
                        </h1>
                        <script async src="https://unpkg.com/typer-dot-js@0.1.0/typer.js"></script>
                        <!-- ======== typer End ======== -->
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            Validate phone numbers to identify disconnected and invalid numbers, carrier and region details,
                            and to distinguish cell phone (mobile) from landlines. Clean your customer database of invalid
                            or outdated phone numbers to increase conversions and deliverability.
                        </p>
                        @guest
                            <a href="{{ route('login') }}" class="main-btn border-btn btn-hover wow fadeInUp"
                                data-wow-delay=".6s">Purchase Now</a>
                        @else
                            <a href="javascript:void(0)" class="main-btn border-btn btn-hover wow fadeInUp"
                                data-wow-delay=".6s">Purchase
                                Now</a>
                        @endguest

                        <a href="#features" class="scroll-bottom">
                            <i class="lni lni-arrow-down"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-img wow fadeInUp" data-wow-delay=".5s" style="position: relative;bottom: -50px;">
                        <img src="{{ asset('frontend/img/hero/mobile-img.webp') }}" alt="" />
                        {{-- <img src="https://www.realvalidito.com/wp-content/uploads/2024/05/mobile-img.webp" alt="" /> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== guest validator start ======== -->
    <section id="guest-validator-section" class="guest-validator-section subscribe-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="content">
                        <h3 class="heading">Free Call Validation</h3>
                        <p class="description">Try our phone number validation tool</p>
                        <form id="phone-validator-form" data-route="{{ route('validate.phone') }}">
                            <div class="content-form-group">
                                <input type="number" id="phoneNumber" name="phoneNumber" class="form-control"
                                    placeholder="10 Digit US/CANADA Phone Number">
                                <button type="submit" class="main-btn btn-hover">Submit</button>
                            </div>
                            <div id="error-message" style="display: none;"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="validPhoneModel">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Phone number is valid!</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row" id="phone-response-data">
                        </div>
                        <hr>
                        <div class="row" id="email-response-data">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ======== guest validator end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="why" class="feature-extended-section">
        <div class="feature-extended-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                        <div class="section-title mb-60">
                            <h2 class="text-center mb-25 wow fadeInUp" data-wow-delay=".2s">
                                Why Choose Call Validation
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s" style="text-align: justify">
                                Our user-friendly API makes it a breeze to check the type of any U.S. phone number. Simply
                                input the number, and our powerful algorithms will instantly deliver the results you need.
                                Sign up for a free trial and experience the difference.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="single-feature-extended">
                            <div class="text-center icon">
                                <i class="lni lni-rocket"></i>
                            </div>
                        </div>
                        <div class="content">
                            <p>Real-time validation and comprehensive
                                data checks ensure accuracy in phone validation systems, reducing false
                                positives and negatives.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======== feature-section end ======== -->
@endsection
@push('styles')
    @vite('resources/assets/frontend/css/home-page.css')
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    @vite('resources/assets/frontend/js/home-page.js')
@endpush
