<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
            action: recaptchaAction
        }).then(function(token) {
            if (token) {
                $("#g-recaptcha-response").val(token);
            }
        });
    });
</script>
