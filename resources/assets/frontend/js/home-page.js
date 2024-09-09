$(document).ready(function() {
    $('#phone-validator-form').on('submit', function(e) {
        e.preventDefault();

        var phoneNumber = $('#phoneNumber').val();
        var regex = /^\d{6,15}$/;


        if (regex.test(phoneNumber)) {
            $('#error-message').hide();

            $.ajax({
                url:  $('#phone-validator-form').data('route'),
                type: 'POST',
                data: {
                    phone: phoneNumber,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    // Show the loader before sending the request
                    $('#loader').show();
                },
                success: function(response) {
                    // Hide the loader when request completes successfully
                    $('#loader').hide();
                    if(response.status == 'valid'){
                        const phoneContainer = document.getElementById('phone-response-data');
                        var responseData = response.data;
                        var associated_email_addresses = '';
                        for (let key in responseData) {
                            if (responseData.hasOwnProperty(key)) {
                                let div = document.createElement('div');
                                div.className = 'col-md-6';
                                if (key == 'associated_email_addresses') {
                                    associated_email_addresses = responseData[key];
                                } else {
                                    let formattedKey = formatKeyName(key);
                                    div.innerHTML = `<strong>${formattedKey}</strong>: ${responseData[key]}`;
                                    phoneContainer.appendChild(div);
                                }
                            }
                        }

                        if (associated_email_addresses != '') {
                            const emailContainer = document.getElementById('email-response-data');
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
                    }else{
                        alert("upgrade");
                        $('#error-message').text(response.data.message).show();
                        $('#validPhoneModel').modal('hide');
                    }
                },
                error: function(xhr) {
                    // Hide the loader if there's an error
                    $('#loader').hide();
                    if (xhr.status === 429) {
                        $('#error-message').html(
                            "Daily limit is expired. Please try again tomorrow or <a href='" + $('#login-nav').data('login') + "' id='upgrade-btn' class='btn btn-success'>Upgrade Now</a>"
                        ).show();


                    } else {
                        var errorMessage = xhr.responseJSON.message || 'Please enter a valid phone number: An error occurred while validating the phone number.';
                        $('#error-message').text(errorMessage).show();
                    }
                    $('#validPhoneModel').modal('hide');
                }
            });

        } else {
            $('#error-message').text('Please enter a valid US/Canada phone number without spaces or special characters.').show();
        }
    });
});

function formatKeyName(key) {
    // Capitalize the first letter and replace underscores with spaces
    return key.charAt(0).toUpperCase() + key.slice(1).replace(/_/g, ' ');
}
