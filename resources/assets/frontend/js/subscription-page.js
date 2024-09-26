$(document).ready(function () {
  $('button').on('click', function (e) {
    e.preventDefault()

    var action = $(this).data('action');
    var originalButton = $(this);

    if (action === 'subscribe') {
      handleAjaxRequest(originalButton);
    } else if (action === 'upgrade' || action === 'downgrade') {
      $('#modalAction').text(action === 'upgrade' ? 'upgrade' : 'downgrade');
      $('#confirmationModal').modal('show');
      $('#confirmAction').off('click').on('click', function () {
        $('#confirmationModal').modal('hide');
        handleAjaxRequest(originalButton);
      });
    }

  });
});

function handleAjaxRequest(button) {

  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  var url = button.data('url');
  var planId = button.data('plan-id');

  $.ajax({
    url: url,
    method: 'POST',
    data: {
      plan_id: planId,
      _token: csrfToken
    },
    success: function (response) {
      if (response.status == 'success') {
        toastr.success(response.message, 'Success');
        setTimeout(function () {
          window.location.replace(response.route);
        }, 3000);
      }
    },
    error: function (xhr, status, error) {
      handleAjaxErrors(xhr, error, '#form-errors');
    }
  });
}

function handleAjaxErrors(xhr, error, errorDivClass = '') {
  errorDivClass = errorDivClass != '' ? errorDivClass : "#form-errors";

  if (xhr.responseJSON) {
    var response = xhr.responseJSON;
    var statusCode = xhr.status;
    var errors = response.errors || {};
    if (statusCode === 422) {
      if (response.status == 'error') {
        toastr.error(response.message, 'Error');
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
    } else if (statusCode === 400) {
      if (response.error) {
        toastr.error(response.error, 'Error');
      } else {
        toastr.error(error ?? "Bad Request", 'Error');
      }
    } else if (statusCode === 401) {
      toastr.error(error ?? "Unauthorized access. Please log in.", 'Error');
    } else if (statusCode === 403) {
      toastr.error(error ?? "Access forbidden. You do not have permission.", 'Error');
    } else if (statusCode === 404) {
      toastr.error(error ?? "Resource not found.", 'Error');
    } else if (statusCode === 500) {
      toastr.error(error ?? "Server error. Try again later.", 'Error');
    } else if (statusCode === 419) {
      toastr.error(error ?? response.message + ', Please relaod the page', 'Error');
    }
  } else {
    toastr.error("An unexpected error occurred.", 'Error');
  }
}
