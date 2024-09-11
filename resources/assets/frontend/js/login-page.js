$(document).ready(function() {

  // Initialize form validation
  $('#loginForm').validate({
      rules: {
          email: {
              required: true,
              email: true,
              maxlength: 255
          },
          password: {
              required: true,
              maxlength: 255
          }

      },
      messages: {
          email: {
              required: "Please enter your email address.",
              email: "Please enter a valid email address.",
              maxlength: "Email cannot exceed 255 characters."
          },
          password: {
              required: "Please enter password",
              valueNotEquals: "Please choose a valid subject."
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

                  // Display a success message
                  $('#form-errors').html(
                      '<div class="success">Your message has been sent successfully!</div>'
                  );

                  // Get the dashboard route from the data attribute
                  var dashboardUrl = $('#loginForm').data('dashboard-url');

                  // Redirect to the dynamically generated dashboard route
                  window.location.href = dashboardUrl;
              },
              error: function(xhr, status, error) {
                  // Clear previous error messages
                  $('.error').remove();

                  // Check if the response is JSON
                  if (xhr.responseJSON) {
                      var response = xhr.responseJSON;
                      console.log(response);
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
