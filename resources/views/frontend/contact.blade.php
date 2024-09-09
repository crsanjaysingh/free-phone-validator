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
                                            <div class="mt-2 mt-10 form-group col-md-12">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <div id="form-errors" class="error-container"></div>
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
    {{-- @vite('resources/assets/frontend/css/contact-page.css') --}}
@endpush

@push('scripts')
    {{-- @vite('resources/assets/frontend/js/contact-page.js') --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            // Custom validator method
            $.validator.addMethod("valueNotEquals", function(value, element, arg) {
                return value !== arg;
            }, "Value must not equal arg.");

            // Initialize form validation
            $('#contactForm').validate({
                rules: {
                    fullName: {
                        required: true,
                        maxlength: 255
                    },
                    contactEmail: {
                        required: true,
                        email: true,
                        maxlength: 255
                    },
                    contactSubject: {
                        required: true,
                        valueNotEquals: "Select" // Custom validator for select field
                    },
                    contactDescription: {
                        required: true,
                        minlength: 5,
                        maxlength: 255
                    }
                },
                messages: {
                    fullName: {
                        required: "Please enter your full name.",
                        maxlength: "Full name cannot exceed 255 characters."
                    },
                    contactEmail: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address.",
                        maxlength: "Email cannot exceed 255 characters."
                    },
                    contactSubject: {
                        required: "Please select a subject.",
                        valueNotEquals: "Please choose a valid subject."
                    },
                    contactDescription: {
                        required: "Please provide a description.",
                        minlength: "Description must be at least 5 characters long."
                    }
                },
                submitHandler: function(form) {
                    // Serialize form data
                    var formData = $(form).serialize();

                    // Perform AJAX form submission
                    $.ajax({
                        type: 'POST',
                        url: $(form).attr('action'), // Form action URL
                        data: formData,
                        success: function(response) {
                            // Remove error messages
                            $('.error').remove();
                            // Handle successful response
                            console.log('Form submitted successfully:', response);

                            // Display a success message
                            $('#form-errors').html(
                                '<div class="success">Your message has been sent successfully!</div>'
                            );

                            // Reset the form
                            $('#contactForm')[0].reset();
                        },
                        error: function(xhr, status, error) {
                            // Clear previous error messages
                            $('.error').remove();

                            // Check if the response is JSON
                            if (xhr.responseJSON) {
                                var response = xhr.responseJSON;
                                var statusCode = xhr.status;
                                var errors = response.errors || {};

                                // Handle validation errors (422 Unprocessable Entity)
                                if (statusCode === 422) {
                                    for (var field in errors) {
                                        if (errors.hasOwnProperty(field)) {
                                            var errorMessages = errors[field];
                                            var errorMessage = errorMessages.join(' ');
                                            $('#' + field).after('<div class="error">' +
                                                errorMessage + '</div>');
                                        }
                                    }
                                }
                                // Handle unauthorized errors (401 Unauthorized)
                                else if (statusCode === 401) {
                                    $('#form-errors').html(
                                        '<div class="error">Unauthorized access. Please log in.</div>'
                                    );
                                }
                                // Handle forbidden errors (403 Forbidden)
                                else if (statusCode === 403) {
                                    $('#form-errors').html(
                                        '<div class="error">Access forbidden. You do not have permission to perform this action.</div>'
                                    );
                                }
                                // Handle not found errors (404 Not Found)
                                else if (statusCode === 404) {
                                    $('#form-errors').html(
                                        '<div class="error">Resource not found. Please try again.</div>'
                                    );
                                }
                                // Handle server errors (500 Internal Server Error)
                                else if (statusCode === 500) {
                                    $('#form-errors').html(
                                        '<div class="error">An internal server error occurred. Please try again later.</div>'
                                    );
                                }
                            } else {
                                // If response is not JSON, handle it as a generic error
                                $('#form-errors').html(
                                    '<div class="error">An unexpected error occurred. Please try again.</div>'
                                );
                            }
                        }
                    });

                    // Prevent the default form submission
                    return false;
                }
            });
        });
    </script>
@endpush
