$(document).ready(function () {
  $('#planForm').validate({
    rules: {
      name: {
        required: true,
        maxlength: 255
      },
      plan_tags: {
        required: true,
        maxlength: 255
      },
      plan_cost: {
        required: true,
        digits: true,
      },
      features: {
        required: true,
      },
    },
    messages: {
      name: {
        required: "Name is required.",
        maxlength: "Name cannot exceed 255 characters."
      },
      plan_tags: {
        required: "Plan tag is required.",
        maxlength: "Plan tag cannot exceed 255 characters."
      },
      plan_cost: {
        required: "Please enter price",
        digits: "Please enter digits only.",
      }
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      var formData = new FormData(form);
      formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
      $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          $(form)[0].reset();
          location.href = plansRoute;
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
      $(errorDivClass).html('<div class="error">Unauthorized access. Please log in</div > ');
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

$('#is_free').on('change', function () {
  if (this.value == 0) {
    $("#plan_cost_div").show();
  } else {
    $("#plan_cost_div").hide();
  }
});
