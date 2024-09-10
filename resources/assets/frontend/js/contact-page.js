$(document).ready(function() {
  // Custom validator method

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
