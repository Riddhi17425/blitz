$(document).ready(function () {

    // CSRF token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Message field ko 500 character se zyada type hone se rokna
    $('#waMessage').on('input', function () {
        if ($(this).val().length > 500) {
            $(this).val($(this).val().substring(0, 500));
        }
    });

    $('#waForm').on('submit', function (e) {
        e.preventDefault();

        let isValid = true;

        const phone = $('#waPhone').val().replace(/\s/g, '').trim();
        const message = $('#waMessage').val().trim();

        // pehle purane errors clear karo
        $('#waPhoneError').removeClass('active').text('');
        $('#waMessageError').removeClass('active').text('');

        const phoneRegex = /^[0-9]{8,15}$/;

        if (phone === '') {
            $('#waPhoneError').addClass('active').text('Phone number is required.');
            isValid = false;
        } else if (!phoneRegex.test(phone)) {
            $('#waPhoneError').addClass('active').text('Enter a valid phone number (8 to 15 digits only).');
            isValid = false;
        }

        if (message.length > 500) {
            $('#waMessageError').addClass('active').text('Message cannot exceed 500 characters.');
            isValid = false;
        }

        if (!isValid) {
            return false;
        }

        // Country code ke saath poora phone number banao
        const dialCode = window.itiWA ? window.itiWA.getSelectedCountryData().dialCode : '91';
        const fullPhone = '+' + dialCode + phone;

        // Sab sahi hai — ab hi button hide hoga aur submitting text dikhega
        $('#waSubmitBtn').hide();
        $('#waSubmittingText').show();

        // Backend ko data bhejo (full phone number with country code)
        $.ajax({
            url: sitePath + '/whatsapp-inquiry/submit',
            method: 'POST',
            data: {
                phone: fullPhone,
                message: message
            },
            success: function (response) {
                // Form reset karo
                $('#waForm')[0].reset();

                // Submitting text ko success message se replace karo
                $('#waSubmittingText').text('Message sent successfully!');

                // 2 second baad modal band karo aur sab wapas normal karo
                setTimeout(function () {
                    $('#waModal').removeClass('active');
                    $('#waSubmitBtn').show();
                    $('#waSubmittingText').hide().text('Submitting your message...');
                }, 2000);
            },
            error: function (xhr) {
                // Agar fail ho jaye, button wapas dikhado
                $('#waSubmitBtn').show();
                $('#waSubmittingText').hide();

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors.phone) {
                        $('#waPhoneError').addClass('active').text(errors.phone[0]);
                    }
                    if (errors.message) {
                        $('#waMessageError').addClass('active').text(errors.message[0]);
                    }
                } else {
                    $('#waMessageError').addClass('active').text('Something went wrong. Please try again.');
                }
            }
        });

    });

});