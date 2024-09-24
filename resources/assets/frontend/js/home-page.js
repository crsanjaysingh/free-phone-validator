$(document).ready(function () {
  $('#phone-validator-form').on('submit', function (e) {
    e.preventDefault();
    var phoneNumber = $('#phoneNumber').val();
    var regex = /^\d{6,15}$/;
    var $submitButton = $(this).find('button[type="submit"]'); // Declaring submit button

    if (regex.test(phoneNumber)) {
      $('#error-message').hide();
      $submitButton.prop('disabled', true);

      $.ajax({
        url: $('#phone-validator-form').data('route'),
        type: 'POST',
        data: {
          phone: phoneNumber,
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
          // showPreloader(); // Only one instance here
        },
        success: function (response) {
          // hidePreloader();

          if (response.status === 'valid') {
            const phoneContainer = document.getElementById('phone-response-data');
            const emailContainer = document.getElementById('email-response-data');
            var responseData = response.data;
            var associated_email_addresses = '';

            // Clear existing data
            phoneContainer.innerHTML = '';
            emailContainer.innerHTML = '';

            for (let key in responseData) {
              if (responseData.hasOwnProperty(key)) {
                let div = document.createElement('div');
                div.className = 'col-md-6';
                if (key === 'associated_email_addresses') {
                  associated_email_addresses = responseData[key];
                } else {
                  let formattedKey = formatKeyName(key);
                  div.innerHTML = `<strong>${formattedKey}</strong>: ${responseData[key]}`;
                  phoneContainer.appendChild(div);
                }
              }
            }

            if (associated_email_addresses !== '') {
              for (let key in associated_email_addresses) {
                if (associated_email_addresses.hasOwnProperty(key)) {
                  let div = document.createElement('div');
                  div.className = 'col-md-6';
                  let formattedKey = formatKeyName(key);
                  div.innerHTML = `<strong>${formattedKey}</strong>: ${associated_email_addresses[key]}`;
                  emailContainer.appendChild(div);
                }
              }
            }

            $('#validPhoneModel').modal('show');
            $('#phoneNumber').val('');
          } else {
            $('#error-message').text(response.data.message || 'An error occurred').show();
            $('#validPhoneModel').modal('hide');
          }
        },
        error: function (xhr) {
          // hidePreloader();
          if (xhr.status === 429) {
            $('#error-message').html(
              "Daily limit expired. Please try again tomorrow or <a href='" + $('#login-nav').data('login') + "' id='upgrade-btn' class='btn btn-success'>Upgrade Now</a>"
            ).show();
          } else {
            var errorMessage = xhr.responseJSON.message || 'Please enter a valid phone number. An error occurred during validation.';
            $('#error-message').text(errorMessage).show();
          }
          $('#validPhoneModel').modal('hide');
        },
        complete: function () {
          // hidePreloader();
          $submitButton.prop('disabled', false);
        }
      });

    } else {
      $submitButton.prop('disabled', false); // Ensure $submitButton exists here
      $('#error-message').text('Please enter a valid phone number without spaces or special characters.').show();
    }
  });
});

function formatKeyName(key) {
  return key.charAt(0).toUpperCase() + key.slice(1).replace(/_/g, ' ');
}
