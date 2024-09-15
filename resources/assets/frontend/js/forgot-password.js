$(document).ready(function() {
  $('#forgotPasswordForm').validate({
      rules: {
          email: {
              required: true,
              email: true,
              maxlength: 255
          }
      },
      messages: {
          email: {
              required: "Please enter your email address.",
              email: "Please enter a valid email address.",
              maxlength: "Email cannot exceed 255 characters."
          }
      },
      submitHandler: function(form, event) {

          event.preventDefault();
          var formData = $(form).serialize();

          $.ajax({
              type: 'POST',
              url: $(form).attr('action'),
              data: formData,
              success: function(response) {
                  $('.error').remove();
                  $('#form-errors').html('<div class="success">We have emailed your password reset link</div>');
                  $("#email").val('');
              },
              error: function(xhr, status, error) {
                  $('.error').remove();
                  handleAjaxErrors(xhr, '#form-errors');
              },
              complete: function() {
                hidePreloader();
                $submitButton.prop('disabled', false);
              }
          });
          return false;
      }
  });

  function handleAjaxErrors(xhr, errorDivClass='') {
    errorDivClass = errorDivClass !='' ?errorDivClass:"#form-errors";

    if (xhr.responseJSON) {
        var response = xhr.responseJSON;
        var statusCode = xhr.status;
        var errors = response.errors || {};
        if (statusCode === 422) {
              if(response.status=='error'){
                  $(errorDivClass).html('<div class="error">'+response.message+'</div>');

              }else{
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
        }else if(statusCode === 419){
              $(errorDivClass).html('<div class="error">'+response.message+', Please relaod the page</div>');
        }
    } else {
        $(errorDivClass).html('<div class="error">An unexpected error occurred.</div>');
    }
  }
});
