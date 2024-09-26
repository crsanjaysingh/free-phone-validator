<footer class="footer">
    <div class="container">
        <div class="widget-wrapper">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <div class="logo mb-50">
                            <a href="#">
                                {{-- <img src="{{ asset('frontend/img/logo/logo.svg') }}" alt="Sticky Logo" /> --}}
                                <img src="{{ asset('assets/img/favicon/logo.png') }}" alt="Sticky Logo" />
                            </a>
                        </div>
                        <p class="text-white desc mb-30">
                            Knot Networks business phone systems can help take your business global! We offer a full
                            suite of managed IT solutions, managed voice and connectivity solutions as well as
                            enterprise voice and carrier solutions under one roof.
                        </p>
                        <ul class="socials">
                            <li>
                                <a href="https://www.facebook.com/KnotNetworks">
                                    <i class="lni lni-facebook-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="skype:live:.cid.5af0850fcdf5b5ef?chat">
                                    <i class="lni lni-skype"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/knot-networks-llc/">
                                    <i class="lni lni-linkedin-original"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h3>Products</h3>
                        <ul class="links">
                            <li><a href="javascript:void(0)">Call Validation</a></li>
                            <li><a href="javascript:void(0)">Toll Free Numbers</a></li>
                            <li><a href="javascript:void(0)">How to Become Toll-Free Service Provider in USA</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3>Company</h3>
                        <ul class="links">
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('contact.get') }}">Contact Us</a></li>
                            <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms.of.service') }}">Terms of Service</a></li>
                            <li><a href="{{ route('refund.policy') }}">Refund Policy</a></li>
                            <li><a href="{{ route('faqs') }}">FAQs</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3>Corporate Office</h3>
                        <ul class="links">
                            <li style="">
                                <a href="tel:+1-8335748844"><i class="lni lni-phone"></i> +1-8335748844 </a>
                            </li>
                            <li style="">
                                <a href="mailto:help@knotnetworks.com?subject = Feedback&amp;body = Message">
                                    <i class="lni lni-envelope"></i></a> <a href="mailto:Help@Knotnetworks.com"
                                    target="_blank">Help@Knotnetworks.com</a>
                            </li>
                            <li>
                                <a
                                    href="https://www.bbb.org/us/de/rehoboth-beach/profile/computer-repair/knot-networks-llc-0251-92025415/">
                                    <i class="lni lni-map-marker"></i>
                                    Knot Networks LLC 18585 Coastal Highway Unit 10 #333 Rehoboth Beach, De 19971 United
                                    States
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="text-center text-white col-md-12 footer-widget">Copyright ©2020-{{ date('Y') }}
                    Knotnetworks
                    LLC . All Rights Reserved</div>
            </div>
        </div>
    </div>
</footer>
