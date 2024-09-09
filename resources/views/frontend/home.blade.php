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

                        <a href="javascript:void(0)" class="main-btn border-btn btn-hover wow fadeInUp"
                            data-wow-delay=".6s">Purchase Now</a>
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
                            <div class="content">
                                <h3 class="text-center">Highly Optimized</h3>
                                <p>
                                    In the dynamic telecommunications sector, delivering high-performance and reliable
                                    services is crucial. For companies offering services, optimizing these solutions can
                                    significantly enhance user experience and operational efficiency. Here’s an in-depth
                                    look at how to achieve highly optimized services:
                                </p>
                                <ul class="mt-3 list-unstyled ps-0">
                                    <li class="mb-3">
                                        <p><strong>Precision and Real-Time Tracking:</strong> Optimization in phone locator
                                            services focuses on leveraging advanced GPS and cellular network technologies to
                                            provide precise, real-time location tracking. Implementing state-of-the-art
                                            algorithms and data fusion techniques ensures high accuracy and responsiveness.
                                        </p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Scalability and Performance:</strong> A well-optimized system should
                                            handle increasing volumes of location requests efficiently. This involves
                                            optimizing server infrastructure and using load balancing to manage high traffic
                                            without compromising service quality.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>User Interface and Experience:</strong> Streamlining the user interface
                                            for both end-users and administrators is crucial. An optimized phone locator
                                            service should offer a clean, intuitive interface that simplifies the tracking
                                            process and provides actionable insights with minimal user effort.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Integration Capabilities:</strong> Seamless integration with other
                                            telecom and third-party services can enhance functionality. Optimizing APIs and
                                            data exchange processes ensures that phone locator services work harmoniously
                                            with existing systems and applications.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Cost Efficiency:</strong> Streamlining billing processes and optimizing
                                            cost management for VoIP services can help reduce operational expenses.
                                            Real-time monitoring and cost tracking features can provide insights and control
                                            over usage and expenditures.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Security Measures:</strong> Ensuring secure VoIP communications involves
                                            implementing encryption protocols, secure signaling, and regular vulnerability
                                            assessments. An optimized security framework helps protect against fraud,
                                            eavesdropping, and other cyber threats.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Accuracy and Precision:</strong> Real-time validation and comprehensive
                                            data checks ensure accuracy in phone validation systems, reducing false
                                            positives and negatives.</p>
                                    </li>
                                </ul>
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
    @vite('resources/assets/frontend/css/home-page.css')
@endpush

@push('scripts')
    @vite('resources/assets/frontend/js/home-page.js')
@endpush
