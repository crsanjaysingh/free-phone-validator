$(document).ready(function() {
    $('#email-verification-form').on('submit', function(event) {
        event.preventDefault();
        $('#email-verification').prop('disabled', true);
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                $('#success-message').text(' A new verification link has been sent to the email address you provided during registration!').show();
                $('#email-verification').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                $('#success-message').text('An error occurred. Please try again.').show();
                $('#email-verification').prop('disabled', false);
            }
        });
    });
});
