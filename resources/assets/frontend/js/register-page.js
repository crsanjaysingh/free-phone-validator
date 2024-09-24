$(document).ready(function () {
  $('#registerForm').validate({
    rules: {
      name: {
        required: true,
        maxlength: 255
      },
      email: {
        required: true,
        email: true,
        maxlength: 255
      },
      password: {
        required: true,
        minlength: 8,
        maxlength: 255,
      },
      password_confirmation: {
        required: true,
        minlength: 8,
        maxlength: 255
      },
      terms: {
        required: true
      },
    },
    messages: {
      name: {
        required: "Please enter your email address.",
        maxlength: "Name cannot exceed 255 characters."
      },
      email: {
        required: "Please enter your email address.",
        email: "Please enter a valid email address.",
        maxlength: "Email cannot exceed 255 characters."
      },
      password: {
        required: "Please enter password",
        minlength: "Please enter minimum 8 character password",
        maxlength: "Password cannot exceed 255 characters."
      },
      password_confirmation: {
        required: "Please enter confirm password",
        minlength: "Please enter minimum 8 character password confirmation",
        maxlength: "Password confirmation cannot exceed 255 characters."
      }
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      var formData = $(form).serialize();
      $('#registerButton').prop('disabled', true);
      $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function (response) {

          if (response.status == 'success') {
            window.location.replace(response.route);
          }

          $('.error').remove();

          $('#form-errors').html(
            '<div class="success">Your message has been sent successfully!</div>'
          );

          var dashboardUrl = $('#registerForm').data('dashboard-url');
          window.location.href = dashboardUrl;
        },
        error: function (xhr, status, error) {
          $('.error').remove();
          handleAjaxErrors(xhr, '#form-errors');
        },
        complete: function () {
          $('#registerButton').prop('disabled', false);
        },
      });
      return false;
    }
  });
});

function handleAjaxErrors(xhr, errorDivClass = '') {
  errorDivClass = errorDivClass != '' ? errorDivClass : "#form-errors";
  if (xhr.responseJSON) {
    var response = xhr.responseJSON;
    var statusCode = xhr.status;
    var errors = response.errors || {};
    if (statusCode === 422) {
      if (response.status == 'error') {
        $(errorDivClass).html('<div class="error">' + response.message + '</div>');
      } else {
        for (var field in errors) {
          if (errors.hasOwnProperty(field)) {
            var errorMessages = errors[field];
            var errorMessage = errorMessages.join(' ');
            $('#' + field).after('<div class="error">' +
              errorMessage + '</div>');
          }
        }
      }
    } else if (statusCode === 401) {
      $(errorDivClass).html('<div class="error">Unauthorized access. Please log in.</div>');
    } else if (statusCode === 403) {
      $(errorDivClass).html('<div class="error">Access forbidden. You do not have permission.</div>');
    } else if (statusCode === 404) {
      $(errorDivClass).html('<div class="error">Resource not found.</div>');
    } else if (statusCode === 500) {
      $(errorDivClass).html('<div class="error">Server error. Try again later.</div>');
    } else if (statusCode === 419) {
      $(errorDivClass).html('<div class="error">' + response.message + ', Please relaod the page</div>');
    }
  } else {
    $(errorDivClass).html('<div class="error">An unexpected error occurred.</div>');
  }
}
