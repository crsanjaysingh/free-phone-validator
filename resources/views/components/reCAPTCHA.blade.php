<script src="https://www.google.com/recaptcha/api.js?onload=vCallback&render=explicit" async defer></script>

<script>
    function vCallback() {
        var recaptchaElement = grecaptcha.render('recaptcha-container', {
            'sitekey': '{{ env('RECAPTCHA_SITE_KEY') }}',
            'callback': function(response) {
                console.log('reCAPTCHA verified', response);
            },
            'expiredCallback': function() {
                console.log('reCAPTCHA expired');
            },
        });
    }
</script>
