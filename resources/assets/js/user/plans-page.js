$(document).ready(function () {

  $('.pause-subscription').on('click', function () {
    var subscriptionId = $(this).data('id');
    var planStatusROute = $("#planStatusROute").val();
    var status = 2
    handleAjax(subscriptionId, status, planStatusROute)
  });

  $('.continue-subscription').on('click', function () {
    var subscriptionId = $(this).data('id');
    var planStatusROute = $("#planStatusROute").val();
    var status = 1
    handleAjax(subscriptionId, status, planStatusROute)
  });

  $('.cancel-subscription').on('click', function () {
    var subscriptionId = $(this).data('id');
    var planStatusROute = $("#planStatusROute").val();
    var status = 3
    handleAjax(subscriptionId, status, planStatusROute)
  });

  function handleAjax(subscriptionId, status, route) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      url: route,
      type: 'POST',
      data: {
        subscriptionId: subscriptionId,
        subscriptionStatus: status,
        _token: token
      },
      success: function (response) {
        if (response.status == 'success') {
          setTimeout(() => {
            location.reload();
          }, 300);
          toastr.success(response.message, 'Success');
        } else {
          toastr.error(response.message, 'Error');
        }
      },
      error: function (xhr, status, error) {
        toastr.error('An error occurred while updating subscription status.', 'Error');
      }
    });
  }
});
