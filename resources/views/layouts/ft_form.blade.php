<section class="section_mt section_pb ft_bg">
       <div class="container">
           <div class="row justify-content-center">
               <div class="col-md-11">
                   <div class="farming_form_bg">
                       <div class="row">
                           <div class="col-md-3">
                               <h2 class="main_head text-start">Ready to Transform Your Farming with</h2>
                               <img src="{{ asset('public/front/images/logo_white.png')}}" alt="logo">
                           </div>
                           <div class="col-md-9">
                                <form class="farming_form row" id="contact_form" action="{{ route('contact.store') }}" method="post">
                                   @csrf
                                    <div class="mb-3 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" class="form-control" id="Name" placeholder="" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" maxlength="70" >
                                            <label class="fw-normal" for="Name">Full Name*</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="">
                                            <label class="fw-normal" for="email">Email Address*</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" name="contact" class="form-control" id="number" placeholder=""
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" maxlength="12" minlength="10" placeholder=" ">
                                            <label class="fw-normal" for="number">Contact Number*</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="company" class="form-control" id="companyname" placeholder="">
                                            <label class="fw-normal" for="companyname">Company Name*</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <select name="interest" id="interest-select" class="form-select" aria-label="Default select example">
                                            <option value="" selected disabled hidden>What is main interest?*</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <select name="activity" id="activity-select" class="form-select" aria-label="Default select example">
                                            <option value=""  selected disabled hidden>Activity*</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <select name="country" id="country-select" class="form-select" aria-label="Default select example">
                                            <option selected disabled hidden>Select Country*</option>
                                        </select>
                                    </div>
                                   <div class="mb-3 col-md-12">
                                       <div class="form-check">
                                           <input class="form-check-input" type="checkbox" value=""
                                               id="flexCheckDefault">
                                           <label class="form-check-label text-white" for="flexCheckDefault">
                                               Join the Terrapreta community and Stay up to date.
                                           </label>
                                       </div>
                                   </div>  
                                   <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <img id="captcha-image-comman-form" src="{{ route('captcha.image') }}" alt="CAPTCHA Image" style="border: 1px solid #ccc; height: 40px;">
                                        </div>
                                        <div class="col-auto">
                                            <svg id="reload-button-comman-form" style="cursor: pointer;" id="reload-button" width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.539 9.54947C19.539 4.46972 15.5667 0.755859 10.4869 0.755859C5.40715 0.755859 1.34335 4.81966 1.34335 9.89941C1.34335 14.9792 5.40715 19.043 10.4869 19.043C12.9252 19.043 14.9571 18.027 16.5826 16.6047" stroke="#fff" stroke-miterlimit="10" stroke-linecap="round"></path>
                                                <path d="M21.5833 5.86837L19.589 9.66244L15.4799 8.32953" stroke="#fff" stroke-miterlimit="10" stroke-linecap="round"></path>
                                            </svg>
                                        </div>
                                        <div class="col-auto mt-3 mt-md-0">
                                            <input class="form-control" type="text" id="custom_captcha_comman_form" placeholder="Enter captcha" autocomplete="off">
                                        </div>
                                        <small id="custom_captcha_error_comman_form" class="text-danger" style="display:none;">Please verify captcha.</small>
                                    </div>
                                   <div>
                                       <button type="submit" class="btn_0 comman_btn2 mt-3">
                                           submit
                                       </button> 
                                   </div> 
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    function toTitleCase(str) {
        return str
            .toLowerCase()
            .split(' ')
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join(' ');
    }

    const $countrySelect = $('#country-select');

    // Initially load all countries without filtering
    $.ajax({
        url: '{{ route("get.countries") }}',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.results && data.results.length > 0) {
                $countrySelect.empty().append('<option selected disabled>Select Country*</option>');
                data.results.forEach(function(item) {
                    const name = item.name || item.text;
                    const option = $('<option></option>')
                        .attr('value', name)
                        .text(toTitleCase(name));
                    $countrySelect.append(option);
                });

                // After loading, detect user country and pre-select
                detectUserCountry();
            }
        },
        error: function() {
            console.error('Failed to load countries');
        }
    });

    function detectUserCountry() {
        $.get('https://ipapi.co/json/', function(location) {
            const detectedCountry = location.country_name;
            const formattedCountry = toTitleCase(detectedCountry);

            // Try to match one of the loaded countries
            let found = false;
            $countrySelect.find('option').each(function() {
                if ($(this).text() === formattedCountry) {
                    $(this).prop('selected', true);
                    found = true;
                }
            });

            // If not found, optionally fetch using exact parameter and append
            if (!found) {
                $.get('{{ route("get.countries") }}', { exact: formattedCountry }, function(data) {
                    if (data.results.length > 0) {
                        const country = data.results[0];
                        const name = country.name || country.text;
                        const option = $('<option></option>')
                            .attr('value', name)
                            .text(toTitleCase(name))
                            .prop('selected', true);
                        $countrySelect.append(option);
                    }
                });
            }
        }); 
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contact_form');
    const submitButton = form.querySelector('button[type="submit"]');

    const fullName = document.getElementById('Name');
    const emailAddress = document.getElementById('email');
    const contactNumber = document.getElementById('number');
    const companyName = document.getElementById('companyname');
    const interestSelect = document.getElementById('interest-select');
    const activitySelect = document.getElementById('activity-select');
    const countrySelect = document.getElementById('country-select');
    const captchaInput = document.getElementById('custom_captcha_comman_form'); 

    const captchaError = document.getElementById('custom_captcha_error_comman_form');
    const captchaImage = document.getElementById('captcha-image-comman-form');
    const reloadButton = document.getElementById('reload-button-comman-form');

    const fullNameError = createErrorElement(fullName, "Please enter a valid name (letters and spaces only).");
    const emailError = createErrorElement(emailAddress, "Please enter a valid email.");
    const contactError = createErrorElement(contactNumber, "Please enter a valid contact number (at least 12 digits).");
    const companyError = createErrorElement(companyName, "Please enter your company name.");
    const interestError = createErrorElement(interestSelect, "Please select your main interest.");
    const activityError = createErrorElement(activitySelect, "Please select an activity.");
    const countryError = createErrorElement(countrySelect, "Please select a country.");

    // Reload CAPTCHA image
    reloadButton.addEventListener('click', function () {
        captchaImage.src = '{{ route("captcha.image") }}?' + Date.now();
    });

    // Utility functions
    function createErrorElement(input, message) {
        let error = document.createElement('small');
        error.className = "text-danger";
        error.style.display = "none";
        error.textContent = message;
        input.parentNode.appendChild(error);
        return error;
    }

    // function isValidEmail(email) {
    //     const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //     return re.test(email);
    // }
 
    function isValidEmail(email) {
        const re = /^[a-zA-Z0-9._%+-]{2,64}@[a-zA-Z0-9.-]+\.[A-Za-z]{2,10}$/;
        return re.test(email);
    }

    function isValidName(name) {
        // only alphabets (upper/lower) and spaces allowed
        return /^[A-Za-z\s]+$/.test(name);
    }

    function isValidContact(number) {
        return /^\d{10,}$/.test(number);
    }

    // Real-time validation
    fullName.addEventListener('input', () => {
        fullNameError.style.display = isValidName(fullName.value.trim()) ? 'none' : 'block';
    });

    emailAddress.addEventListener('input', () => {
        emailError.style.display = isValidEmail(emailAddress.value.trim()) ? 'none' : 'block';
    });

    contactNumber.addEventListener('input', () => {
        contactError.style.display = isValidContact(contactNumber.value.trim()) ? 'none' : 'block';
    }); 

    companyName.addEventListener('input', () => {
        companyError.style.display = companyName.value.trim() !== '' ? 'none' : 'block';
    });

    interestSelect.addEventListener('change', () => {
        interestError.style.display = interestSelect.value.trim() !== '' ? 'none' : 'block';
    });

    activitySelect.addEventListener('change', () => {
        activityError.style.display = activitySelect.value.trim() !== '' ? 'none' : 'block';
    });

    countrySelect.addEventListener('change', () => {
        countryError.style.display = countrySelect.value.trim() !== '' ? 'none' : 'block';
    });

    captchaInput.addEventListener('input', () => {
        const value = captchaInput.value.trim();

        if (value.length === 4) {
            captchaError.style.display = 'none'; // hide error if 4 digits entered
        } else if (value === '') {
            captchaError.style.display = 'block';
            captchaError.textContent = "Please enter the captcha.";
        } else {
            captchaError.style.display = 'block';
            captchaError.textContent = "Captcha must be 4 digits.";
        }
    });


    // On form submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let isValid = true;

        // Validate Full Name
        if (!isValidName(fullName.value.trim())) {
            fullNameError.style.display = 'block';
            isValid = false;
        } else {
            fullNameError.style.display = 'none';
        }

        // Validate Email
        if (!isValidEmail(emailAddress.value.trim())) {
            emailError.style.display = 'block';
            isValid = false;
        } else {
            emailError.style.display = 'none';
        }

        // Validate Contact
        if (!isValidContact(contactNumber.value.trim())) {
            contactError.style.display = 'block';
            isValid = false;
        } else {
            contactError.style.display = 'none';
        }

        // Validate Company Name
        if (companyName.value.trim() === '') {
            companyError.style.display = 'block';
            isValid = false;
        } else {
            companyError.style.display = 'none';
        }

        // Validate Interest Select
        if (interestSelect.value.trim() === "") {
            interestError.style.display = 'block';
            isValid = false;
        } else {
            interestError.style.display = 'none';
        }

        // Validate Activity Select
        if (activitySelect.value.trim() === "") {
            activityError.style.display = 'block';
            isValid = false;
        } else {
            activityError.style.display = 'none';
        }

        // Validate Country Select
        if (countrySelect.value.trim() === "") {
            countryError.style.display = 'block';
            isValid = false;
        } else {
            countryError.style.display = 'none';
        }

        // Validate CAPTCHA
        if (captchaInput.value.trim() === '') {
            captchaError.style.display = 'block';
            captchaError.textContent = "Please enter the captcha.";
            isValid = false;
        } else {
            captchaError.style.display = 'none';
        }

        if (!isValid) return;

        submitButton.textContent = 'Verifying captcha...';
        submitButton.disabled = true;

        // AJAX CAPTCHA verification
        $.ajax({
            url: '{{ route("captcha.verify") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                custom_captcha: captchaInput.value.trim()
            },
            success: function(response) {
                if (response.success) {
                    submitButton.textContent = 'Submitting...';
                    form.submit();
                } else {
                    captchaError.style.display = 'block';
                    captchaError.textContent = response.message;
                    submitButton.textContent = 'Submit';
                    submitButton.disabled = false;
                }
            },
            error: function() {
                alert('Something went wrong. Please try again.');
                submitButton.textContent = 'Submit';
                submitButton.disabled = false;
            }
        });
    });
});

</script>
