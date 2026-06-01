$(document).ready(function(){
    function showNewsletterMessage(message, isSuccess) {
        var messageContainer = $('#newsletter-message');
        messageContainer
            .removeClass('text-success text-danger')
            .addClass(isSuccess ? 'text-success' : 'text-danger')
            .text(message)
            .show();
    }

    $('#newsletter-form').validate({
        rules: {
            email: {
                required: true,
                email: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            }
        },
        messages: {
            email: {
                required: 'Email is required.',
                email: 'Please enter a valid email address.'
            }
        },
        submitHandler: function(form) {
            var emailField = $('#newsletter-email');
            var email = $.trim(emailField.val());
            var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();
            var submitButton = $(form).find('button[type="submit"]');

            submitButton.prop('disabled', true).text('Subscribing...');
            showNewsletterMessage('', true);

            $.ajax({
                url: '/newsletter/subscribe',
                method: 'POST',
                data: { email: email, _token: csrfToken },
                success: function(res){
                    showNewsletterMessage(res.message || 'Subscribed successfully.', true);
                    emailField.val('');
                },
                error: function(xhr){
                    var msg = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        msg = Object.values(xhr.responseJSON.errors)
                            .flat()
                            .join(' ');
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    showNewsletterMessage(msg, false);
                },
                complete: function(){
                    submitButton.prop('disabled', false).text('Subscribe');
                }
            });

            return false;
        }
    });
});
