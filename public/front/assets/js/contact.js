$(document).ready(function(){
    $('#contact-form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            email: {
                required: true,
                email: true,
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            phone: {
                required: true,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            company: {
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            country: {
                required: true,
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            product: {
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            requirement_details: {
                normalizer: function(value) {
                    return $.trim(value);
                }
            }
        },
        messages: {
            name: {
                required: 'Full name is required.',
                maxlength: 'Full name must not exceed 255 characters.'
            },
            email: {
                required: 'Email is required.',
                email: 'Please enter a valid email address.',
                maxlength: 'Email must not exceed 255 characters.'
            },
            phone: {
                required: 'Phone number is required.',
                maxlength: 'Phone number must not exceed 50 characters.'
            },
            company: {
                maxlength: 'Company name must not exceed 255 characters.'
            },
            country: {
                required: 'Country is required.',
                maxlength: 'Country must not exceed 255 characters.'
            },
            product: {
                maxlength: 'Product must not exceed 255 characters.'
            }
        },
        errorPlacement: function(error, element) {
            error.addClass('text-danger');
            element.closest('.form-group').append(error);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
