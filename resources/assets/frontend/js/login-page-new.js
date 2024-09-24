$(document).ready(function () {
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
    submitHandler: function (form, event) {
      event.preventDefault();
      var formData = $(form).serialize();
      $('#loginButton').prop('disabled', true);
      $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function (response) {
          $('.error').remove();
          $('#form-errors').html(
            '<div class="success">Your otp has been sent successfully!</div>'
          );
          if (response.status === 'success') {
            $('#otpModal').modal('show');
          } else {
            $('#otpModal').modal('hide');
          }
        },
        error: function (xhr, status, error) {
          $('.error').remove();
          handleAjaxErrors(xhr, '#form-errors');
        },
        complete: function () {
          $('#loginButton').prop('disabled', false);
        }
      });
      return false;
    }
  });

  $('#otpForm').validate({
    rules: {
      otp: {
        required: true,
        minlength: 6,
        maxlength: 6
      }
    },
    messages: {
      otp: {
        required: "Please enter your OTP.",
        minlength: "OTP must be 6 digits.",
        maxlength: "OTP must be 6 digits."
      }
    },
    submitHandler: function (otpForm, event) {
      event.preventDefault();
      var formData = $(otpForm).serialize();

      $.ajax({
        type: 'POST',
        url: $(otpForm).attr('action'),
        data: formData,
        success: function (response) {
          console.log(response);
          if (response.status == "success") {
            $('#otp-error').html('<div class="success">' + response.message + '</div>');
            window.location.href = response.route;
          }
        },
        error: function (xhr, status, error) {
          $('#otp-error').css('display:block');
          handleAjaxErrors(xhr, '#otp-error');
        }
      });
      return false;
    }
  });

  function handleAjaxErrors(xhr, errorDivClass = '') {
    errorDivClass = errorDivClass != '' ? errorDivClass : "#form-errors";

    if (xhr.responseJSON) {
      var response = xhr.responseJSON;
      var statusCode = xhr.status;
      var errors = response.errors || {};
      if (statusCode === 422) {
        if (response.status == 'error') {
          if (response.message == "Invalid reCAPTCHA response.") {
            location.reload();
          }
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
});
