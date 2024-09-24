$(document).ready(function () {
  $('#usersTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: usersRoute,
    columns: [
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'phone_number', name: 'phone_number' },
      {
        data: 'status',
        name: 'status',
        render: function (data, type, row) {
          return data == 1 ? '<span class="badge rounded-pill bg-success">Active</span>' : '<span class="badge rounded-pill bg-danger">Inactive</span>';
        }
      },
      {
        data: 'is_deleted',
        name: 'is_deleted',
        render: function (data, type, row) {
          return data == 0 ? '<span class="badge rounded-pill bg-success">No</span>' : '<span class="badge rounded-pill bg-danger">Yes</span>';
        }
      },
      {
        data: 'is_blocked',
        name: 'is_blocked',
        render: function (data, type, row) {
          return data == 0 ? '<span class="badge rounded-pill bg-success">No</span>' : '<span class="badge rounded-pill bg-danger">Yes</span>';
        }
      },
      { data: 'action', name: 'action', orderable: false, searchable: true }
    ],
    order: [[0, 'desc']],
    language: {
      emptyTable: "No data found"  // Custom message for no data
    }
  });


  $(document).on('click', 'button[id^="add_amount_"]', function () {
    var userId = $(this).data('user_id');
    $('#user_id').val(userId);
    $('#addAmountModal').modal('show');
  });
});
$('#addAmountForm').validate({
  rules: {
    amount: {
      required: true,
      maxlength: 255
    },
    memo: {
      required: true,
      maxlength: 255
    },
  },
  messages: {
    amount: {
      required: "Please enter amount",
      maxlength: "Amount cannot exceed 255 characters."
    },
    memo: {
      required: "Please enter memo",
      maxlength: "Memo cannot exceed 255 characters."
    }
  },
  submitHandler: function (form, event) {

    event.preventDefault();
    var formData = $(form).serialize();

    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData,
      success: function (response) {
        $(form)[0].reset();
        $('#addAmountModal').modal('hide');
        toastr.success(response.message, 'Success');
      },
      error: function (xhr, status, error) {
        $('.error').remove();
        console.log(xhr.responseJSON);
        handleAjaxErrors(xhr, '#form-errors');
      },
      complete: function () {

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

$('#submitAddAmount').on('click', function () {
  $('#addAmountForm').submit();
});

$(document).on('click', 'button[id^="block_user_"]', function () {
  var blockButton = $(this);
  var userId = blockButton.data('user_id');
  var blockUrl = blockButton.data('block_url');
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  if (confirm('Are you sure you want to change the block status of this user?')) {
    $.ajax({
      url: blockUrl,
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      data: {
        user_id: userId
      },
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          alert(response.message);
          // Toggle the button text based on the response
          if (response.is_blocked) {
            blockButton.removeClass('btn-danger').addClass('btn-warning').text('Unblock');
          } else {
            blockButton.removeClass('btn-warning').addClass('btn-danger').text('Block');
          }
        } else {
          alert('Failed to change the block status. Please try again.');
        }
      },
      error: function (xhr, status, error) {
        alert('Error: ' + error + '. Please try again.');
      }
    });
  }
});

