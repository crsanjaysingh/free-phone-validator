@extends('layouts/frontend/app')

@section('frontendContent')
    <!-- ======== feature-section start ======== -->
    <section id="contact" class="feature-extended-section">
        <div class="feature-extended-wrapper mt-86">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card single-feature-extended">
                            <div class="text-center card icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="card content">
                                <h3 class="text-center">Fill the form</h3>
                                <div class="contact-us">
                                    <form id="contactForm" action="{{ route('contact.post') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="fullName">Full Name</label>
                                                <input type="text" name="fullName" id="fullName" class="form-control">
                                                <div class="error"></div>
                                            </div>
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="contactEmail">Email</label>
                                                <input type="email" name="contactEmail" id="contactEmail"
                                                    class="form-control">
                                                <div class="error"></div>
                                            </div>
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="contactSubject">Subject</label>
                                                <select name="contactSubject" id="contactSubject" class="form-control">
                                                    <option value="Select">Select</option>
                                                    <option value="CallValidation">Call Validation</option>
                                                    <option value="TrackingNumbers">Tracking Numbers</option>
                                                    <option value="API">API</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <div class="error"></div>
                                            </div>
                                            <div class="mt-10 form-group col-md-12">
                                                <label for="contactDescription">Description</label>
                                                <textarea name="contactDescription" id="contactDescription" class="form-control" cols="30" rows="10"></textarea>
                                                <div class="error"></div>
                                            </div>
                                            <div class="mt-10 form-group col-md-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
@push('styles')
    {{-- @vite('resources/assets/frontend/css/contact-page.css') --}}
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    @vite('resources/assets/frontend/js/contact-page.js')

    <script>
        var recaptchaAction = "{{ 'contact' }}";
    </script>
    <!-- Include the reCAPTCHA v3 script -->
    <x-reCAPTCHA />
@endpush
