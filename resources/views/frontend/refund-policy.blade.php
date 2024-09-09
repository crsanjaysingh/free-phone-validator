@extends('layouts/frontend/app' )

@section('frontendContent')
    <!-- ======== feature-section start ======== -->
    <section id="features" class="feature-section pt-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8 col-sm-10">
                    <div class="single-feature">
                        <div class="icon">
                            <i class="lni lni-bootstrap"></i>
                        </div>
                        <div class="content">
                            <h3>Bootstrap 5</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-10">
                    <div class="single-feature">
                        <div class="icon">
                            <i class="lni lni-layout"></i>
                        </div>
                        <div class="content">
                            <h3>Clean Design</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-10">
                    <div class="single-feature">
                        <div class="icon">
                            <i class="lni lni-coffee-cup"></i>
                        </div>
                        <div class="content">
                            <h3>Easy to Use</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== feature-section end ======== -->
     <!-- ======== about-section start ======== -->
     <section id="about" class="about-section pt-15">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-img">
                        <img src="{{ asset('frontend/img/about/about-1.png') }}" alt="" class="w-100" />
                        <img src="{{ asset('frontend/img/about/about-left-shape.svg') }}" alt=""
                            class="shape shape-1" />
                        <img src="{{ asset('frontend/img/about/left-dots.svg') }}" alt=""
                            class="shape shape-2" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content">
                        <div class="section-title mb-30">
                            <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                                Perfect Solution Thriving Online Business
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                dinonumy eirmod tempor invidunt ut labore et dolore magna
                                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                                justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                                sea takimata sanctus est Lorem.Lorem ipsum dolor sit amet.
                            </p>
                        </div>
                        <a href="javascript:void(0)" class="main-btn btn-hover border-btn wow fadeInUp"
                            data-wow-delay=".6s">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== about-section end ======== -->

    <!-- ======== about2-section start ======== -->
    <section id="about" class="about-section pt-150">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content">
                        <div class="section-title mb-30">
                            <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                                Easy to Use with Tons of Awesome Features
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                aliquyam erat, sed diam voluptua.
                            </p>
                        </div>
                        <ul>
                            <li>Quick Access</li>
                            <li>Easily to Manage</li>
                            <li>24/7 Support</li>
                        </ul>
                        <a href="javascript:void(0)" class="main-btn btn-hover border-btn wow fadeInUp"
                            data-wow-delay=".6s">Learn More</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 order-first order-lg-last">
                    <div class="about-img-2">
                        <img src="{{ asset('frontend/img/about/about-2.png') }}" alt="" class="w-100" />
                        <img src="{{ asset('frontend/img/about/about-right-shape.svg') }}" alt=""
                            class="shape shape-1" />
                        <img src="{{ asset('frontend/img/about/right-dots.svg') }}" alt=""
                            class="shape shape-2" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== about2-section end ======== -->
    <!-- ======== feature-section start ======== -->
    <section id="why" class="feature-extended-section">
        <div class="feature-extended-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                        <div class="section-title mb-60">
                            <h2 class="mb-25 wow fadeInUp text-center" data-wow-delay=".2s">
                                Why Choose Call Validation
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s" style="text-align: justify">
                                Our user-friendly API makes it a breeze to check the type of any U.S. phone number. Simply input the number, and our powerful algorithms will instantly deliver the results you need. Sign up for a free trial and experience the difference.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="single-feature-extended">
                            <div class="icon text-center">
                                <i class="lni lni-rocket"></i>
                            </div>
                            <div class="content">
                                <h3 class="text-center">Highly Optimized</h3>
                                <p>
                                    In the dynamic telecommunications sector, delivering high-performance and reliable services is crucial. For companies offering services, optimizing these solutions can significantly enhance user experience and operational efficiency. Here’s an in-depth look at how to achieve highly optimized services:
                                </p>
                                <ul class="list-unstyled ps-0 mt-3">
                                    <li class="mb-3">
                                        <p><strong>Precision and Real-Time Tracking:</strong> Optimization in phone locator services focuses on leveraging advanced GPS and cellular network technologies to provide precise, real-time location tracking. Implementing state-of-the-art algorithms and data fusion techniques ensures high accuracy and responsiveness.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Scalability and Performance:</strong> A well-optimized system should handle increasing volumes of location requests efficiently. This involves optimizing server infrastructure and using load balancing to manage high traffic without compromising service quality.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>User Interface and Experience:</strong> Streamlining the user interface for both end-users and administrators is crucial. An optimized phone locator service should offer a clean, intuitive interface that simplifies the tracking process and provides actionable insights with minimal user effort.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Integration Capabilities:</strong> Seamless integration with other telecom and third-party services can enhance functionality. Optimizing APIs and data exchange processes ensures that phone locator services work harmoniously with existing systems and applications.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Cost Efficiency:</strong> Streamlining billing processes and optimizing cost management for VoIP services can help reduce operational expenses. Real-time monitoring and cost tracking features can provide insights and control over usage and expenditures.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Security Measures:</strong> Ensuring secure VoIP communications involves implementing encryption protocols, secure signaling, and regular vulnerability assessments. An optimized security framework helps protect against fraud, eavesdropping, and other cyber threats.</p>
                                    </li>
                                    <li class="mb-3">
                                        <p><strong>Accuracy and Precision:</strong> Real-time validation and comprehensive data checks ensure accuracy in phone validation systems, reducing false positives and negatives.</p>
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