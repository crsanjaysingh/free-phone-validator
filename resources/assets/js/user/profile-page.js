$(document).ready(function () {
  $('#userProfileForm').validate({
    rules: {
      firstName: {
        required: true,
        maxlength: 255
      },
      lastName: {
        required: true,
        maxlength: 255
      },
      email: {
        required: true,
        email: true,
        maxlength: 255
      },
      phoneNumber: {
        required: true,
        digits: true,
        minlength: 10,
        maxlength: 15
      },
      country: {
        required: true,
      },
      upload: {
        accept: "image/jpeg,image/png",
        filesize: 800000 // 800KB
      }
    },
    messages: {
      firstName: {
        required: "First name is required.",
        maxlength: "First name cannot exceed 255 characters."
      },
      lastName: {
        required: "Last name is required.",
        maxlength: "Last name cannot exceed 255 characters."
      },
      email: {
        required: "Email is required.",
        email: "Please enter a valid email.",
        maxlength: "Email cannot exceed 255 characters."
      },
      phoneNumber: {
        required: "Please enter your phone number.",
        digits: "Please enter a valid phone number with digits only.",
        minlength: "Phone number must be at least 10 digits long.",
        maxlength: "Phone number cannot exceed 15 digits."
      },
      country: {
        required: "Please select your country."
      },
      upload: {
        accept: "Only JPG and PNG images are allowed.",
        filesize: "File size must be less than 800KB."
      }
    },
    errorPlacement: function (error, element) {
      error.insertAfter(element.closest('.error-messages'));
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      var formData = new FormData(form);
      $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.status == "success") {
            var newImageUrl = baseStorageUrl + '/' + response.data.profile_image;
            //alert(newImageUrl);

            newImageUrl = newImageUrl + '?t=' + new Date().getTime();

            // Debug: Log the constructed image URL
            console.log(newImageUrl);

            // Update the image src dynamically
            $('#uploadedAvatar').attr('src', newImageUrl);
          } else {
            toastr.success("Failed to update the profile", 'Error');
          }
        },
        error: function (xhr) {
          handleAjaxErrors(xhr, '#form-errors');
        }
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
        toastr.success(response.message, 'Error');
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
      toastr.success("Unauthorized access. Please log in.", 'Error');
    } else if (statusCode === 403) {
      toastr.success("Access forbidden. You do not have permission.", 'Error');
      $(errorDivClass).html('<div class="error">Access forbidden. You do not have permission.</div>');
    } else if (statusCode === 404) {
      toastr.success("Resource not found.", 'Error');
      $(errorDivClass).html('<div class="error">Resource not found.</div>');
    } else if (statusCode === 500) {
      toastr.success("Server error. Try again later.", 'Error');
      $(errorDivClass).html('<div class="error">Server error. Try again later.</div>');
    } else if (statusCode === 419) {
      toastr.success(response.message + ', Please relaod the page', 'Error');
      $(errorDivClass).html('<div class="error">' + response.message + ', Please relaod the page</div>');
    }
  } else {
    toastr.success("An unexpected error occurred.", 'Error');
    $(errorDivClass).html('<div class="error">An unexpected error occurred.</div>');
  }
}
