$(document).ready(function () {
  var userId = $('#walletTransactionsTable').data('user-id');
  var url = $('#walletTransactionsTable').data('url');

  $('#walletTransactionsTable').DataTable({
    processing: true,
    serverSide: true,
    pageLength: 15,
    lengthMenu: [[5, 10, 15, 25, 50, 100, 200, 500, 1000], [5, 10, 15, 25, 50, 100, 200, 500, 1000]],
    ajax: {
      url: url,
      type: 'GET'
    },
    columns: [
      { data: 'id', name: 'id' },
      (userId === undefined || userId === '') ? { data: 'user', name: 'user' } : null,
      { data: 'amount', name: 'amount' },
      { data: 'added_by', name: 'added_by' },
      { data: 'memo', name: 'memo' },
      { data: 'created_at', name: 'created_at' },
      // { data: 'action', name: 'action', orderable: false, searchable: false }
    ].filter(Boolean)
  });
});

$(document).on('click', 'button[id^="transaction_id_"]', function () {
  var rowData = $(this).data('array');
  $('#transaction_id').val(rowData.id);
  $('#wallet_id').val(rowData.wallet_id);
  $('#old_amount').val(rowData.amount);
  $('#amount').val(rowData.amount);
  $('#memo').val(rowData.memo);
  $('#addAmountModal').modal('show');
});

$('#updateAmountForm').validate({
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
        setTimeout(function () {
          location.reload();
        }, 2000);

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
  $('#updateAmountForm').submit();
});


