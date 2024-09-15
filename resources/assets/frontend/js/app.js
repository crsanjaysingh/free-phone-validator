$(document).ready(function() {
  $('#subscribeForm').on('submit', function(e) {
      e.preventDefault();
      $('#form-errors').empty();

      var formData = $(this).serialize();

      $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: formData,
          success: function(response) {
              $('#form-errors').html('<div class="text-white">Thank you for subscribing!</div>');

              $('#subscribeForm')[0].reset();
          },
          error: function(xhr) {
              if (xhr.responseJSON && xhr.responseJSON.errors) {
                $('#form-errors').html('');
                      var errors = xhr.responseJSON.errors;
                      console.log(errors);

                      var allMessages = '';

                      $.each(errors, function(field, messages) {
                          allMessages += '<div class="text-white">' + messages.join(' ') + '</div>';
                      });
                      $('#form-errors').html(allMessages);
              } else {
                  $('#form-errors').html('<div class="text-white">An unexpected error occurred. Please try again.</div>');
              }
          }
      });
  });
});

function showPreloader() {
  $('.preloader').show();
}

function hidePreloader() {
  $('.preloader').hide();
}

$.validator.addMethod("valueNotEquals", function(value, element, arg) {
  return value !== arg;
}, "Value must not equal arg.");
