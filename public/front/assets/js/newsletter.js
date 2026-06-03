$(document).ready(function(){
    var isNewsletterSubmitting = false;

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

        errorElement: 'div',
        errorClass: 'text-danger',

        highlight: function(element) {
            $(element).addClass('is-invalid');
        },

        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
            $('#newsletter-email-error').empty();
        },

        errorPlacement: function(error, element) {
            if (element.attr('name') === 'email') {
                $('#newsletter-email-error').html(error);
            } else {
                error.insertAfter(element);
            }
        },
        success: function(label) {
            label.remove();
            $('#newsletter-email-error').empty();
        },

        submitHandler: function(form) {
            var emailField = $('#newsletter-email');
            var email = $.trim(emailField.val());
            var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();
            var submitButton = $(form).find('button[type="submit"]');

            if (isNewsletterSubmitting) {
                return false;
            }
            isNewsletterSubmitting = true;
            submitButton.prop('disabled', true).text('Subscribing...');
            $.ajax({
                url: sitePath + '/newsletter/subscribe',
                method: 'POST',
                data: {
                    email: email,
                    _token: csrfToken
                },

                success: function(res) {
                    // $('#newsletter-email-error').empty();
                    // emailField.val('');
                    window.location.href = sitePath + '/thank-you';
                    // showNewsletterMessage(res.message || 'Subscribed successfully.', true);
                },

                error: function(xhr) {
                    // Handle AJAX errors here
                },

                complete: function() {
                    submitButton.prop('disabled', false).text('Subscribe');
                }
            });

            return false;
        }
    });
});
