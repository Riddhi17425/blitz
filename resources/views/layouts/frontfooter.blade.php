   @php
       use App\Models\Category;
       $categorys = Category::where('status' , 'Active')->get();
   @endphp
   
   <footer class="footer">
       <div class="container">
           <div class="row">
               <div class="col-md-3 mb-3">
                  <a href="{{ route('front.home') }}">
                    <img src="{{ asset('public/front/images/ft_logo.svg')}}" alt="ft_logo" class="img-fluid ft_log">
                  </a>
                   <div class="d-flex">
                       <a href="{{ route('front.terms.condition') }}" class="">Terms and condition</a><span class="mx-2">|</span><a
                           href="{{ route('front.privacy.policy') }}" class="">Privacy Policy</a>
                   </div>
                   <div>
                       <P>© {{ date('Y') }} Terrapreta International Pvt Ltd.</P>
                   </div> 
               </div>
               <div class="col-md-9 row ft_items">
                   <div class="ft_menu col-md-3 col-6 mb-3 mb-md-0">
                       <h3 class="ft_menu_title">Quick Links</h3>
                       <ul class="ft_list">
                           <li><a href="{{ route('front.home') }}">Home</a></li>
                           
                           <li><a href="{{ route('front.about') }}">About Us</a></li>
                           <li><a href="{{ route('front.joureny') }}">Our Terrapreta Journey</a></li>
                           <li><a href="{{ route('front.blogs') }}">Blogs</a></li>
                            <li><a class="nav-link" href="{{ route('front.career') }}">Career</a></li>
                           <li><a href="{{ route('front.contact') }}">Contact Us</a></li>
                       </ul>
                   </div>
                   <div class="ft_menu col-md-3 col-6 mb-3 mb-md-0">
                       <a href="{{ route('front.category') }}"><h3 class="ft_menu_title">Products</h3></a>
                       <ul class="ft_list">
                           @foreach ($categorys as $category)
                                <li><a href="{{ route('front.product' ,['category_url' => $category->url]) }}">{{ $category->title }}</a></li>
                           @endforeach
                       </ul>
                   </div>
                   <div class="col-xxl-4 col-lg-4 ft_menu">
                       <h3 class="ft_menu_title">Contact</h3>
                       <p class="mb-0"><b>Registred Office
</b></p>
                       <ul class="ft_list">
                           <li>
                               <b>A: </b>
                               <a href="https://maps.app.goo.gl/mHEpTQFkCzbt3h578" target="_blank">Reg. A-1011, WTT (World Trade Tower), Makaraba, Ahmedabad, Gujarat, India-380051.</a>
                           </li>
                           <li class="mt-2"><b>E: </b><a href="mailto:kalpesh@terrapreta.cloud"> kalpesh@terrapreta.cloud</a></li>
                           <li class="mt-2"><b>M: </b><a href="tel:+919898641591"> +919898641591</a></li>

                       </ul>
                   </div>
                   <div class="ft_menu col-md-2 col-6 mb-3 mb-md-0">
                       <h3 class="ft_menu_title">Follow Us</h3>
                       <div class="social_items">
                           <a href="javascript:void(0);" target="_blank"><img src="{{ asset('public/front/images/facebook_icon.svg')}}" alt="facebook" class="img-fluid"></a>
                           <a href="javascript:void(0);" target="_blank"><img src="{{ asset('public/front/images/insta_icon.svg')}}" alt="instagram" class="img-fluid"></a>
                           <a href="https://in.linkedin.com/company/terrapreta-international-pvt-ltd" target="_blank"><img src="{{ asset('public/front/images/linkedin_icon.svg')}}" alt="linkedin" class="img-fluid"></a>
                       </div>
                   </div>
               </div>
           </div>
       </div> 
   </footer>
   
   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Enquiry Now</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal_form career_form_wrapper mt-0">
                        <form id="enquireForm" action="{{ route('product.inquiry') }}" method="post">
                            @csrf 
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name" id="full_name" placeholder=""
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" maxlength="70">
                                        <label class="fw-normal"  for="full_name">Full Name* :</label>
                                    </div>
                                    <small id="full_name_error" class="text-danger" style="display:none;">Please enter your name.</small>
                                </div>


                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="number" name="contact" class="form-control" id="contact_number" placeholder=""
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" maxlength="12" minlength="10">
                                        <label class="fw-normal" for="contact_number">Contact Number* :</label>
                                    </div>
                                    <small id="contact_number_error" class="text-danger" style="display:none;">Please enter a valid contact number.</small>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="email" class="form-control" id="email_address" placeholder="">
                                        <label class="fw-normal" for="email_address">Email Address* :</label>
                                    </div>
                                    <small id="email_address_error" class="text-danger" style="display:none;">Please enter a valid email.</small>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="product_name" id="ProductName" placeholder="" readonly>
                                        <label class="fw-normal" for="ProductName" sty>Product :</label>
                                    </div>
                                </div> 

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="message" id="message" placeholder=""></textarea>
                                        <label class="fw-normal" for="message">Message :</label>
                                    </div>
                                    <small id="message_error" class="text-danger" style="display:none;">Please enter a message.</small>
                                </div>

                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <img id="captcha-image" src="{{ route('captcha.image') }}" alt="CAPTCHA Image" style="border: 1px solid #ccc; height: 40px;">
                                    </div>
                                    <div class="col-auto">
                                        <svg id="reload-button" style="cursor: pointer;" width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.539 9.54947C19.539 4.46972 15.5667 0.755859 10.4869 0.755859C5.40715 0.755859 1.34335 4.81966 1.34335 9.89941C1.34335 14.9792 5.40715 19.043 10.4869 19.043C12.9252 19.043 14.9571 18.027 16.5826 16.6047" stroke="#333" stroke-miterlimit="10" stroke-linecap="round"></path>
                                    <path d="M21.5833 5.86837L19.589 9.66244L15.4799 8.32953" stroke="#333" stroke-miterlimit="10" stroke-linecap="round"></path>
                                </svg>
                                    </div>
                                    <div class="col-auto mt-3 mt-md-0">
                                        <input class="form-control" type="text" id="custom_captcha" placeholder="Enter captcha" autocomplete="off">
                                    </div>
                                    <small id="custom_captcha_error" class="text-danger" style="display:none;">Please verify captcha.</small>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn-shine">
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
       integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
   </script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
   <!-- Swiper JS -->
   <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
   <script src="{{ asset('public/front/js/main.js')}}"></script>
   </body> 

   </html>
   
   <script>
    var modal = document.getElementById('staticBackdrop');

    modal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        var productName = button.getAttribute('data-product');

        // Update the modal input field
        var input = modal.querySelector('#ProductName');
        input.value = productName;
    });


$(document).ready(function() {
    $('#reload-button').click(function() {
        // Add a random query string to prevent caching
        let timestamp = new Date().getTime();
        $('#captcha-image').attr('src', '{{ route("captcha.image") }}?t=' + timestamp);
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('enquireForm');
    const submitButton = form.querySelector('button[type="submit"]');

    const fullName = document.getElementById('full_name');
    // const experience = document.getElementById('experience');
    const contactNumber = document.getElementById('contact_number');
    const emailAddress = document.getElementById('email_address');
    const productName = document.getElementById('ProductName');
    const message = document.getElementById('message');
    const customCaptcha = document.getElementById('custom_captcha');

    const fullNameError = document.getElementById('full_name_error');
    // const experienceError = document.getElementById('experience_error');
    const contactNumberError = document.getElementById('contact_number_error');
    const emailAddressError = document.getElementById('email_address_error');
    const messageError = document.getElementById('message_error');
    const customCaptchaError = document.getElementById('custom_captcha_error');

    function isValidEmail(email) {
        const re = /^[a-zA-Z0-9._%+-]{2,64}@[a-zA-Z0-9.-]+\.[A-Za-z]{2,10}$/;
        return re.test(email);
    } 

    // Full Name validation: letters and spaces only
    fullName.addEventListener('input', function() {
        const value = fullName.value.trim();
        const valid = /^[A-Za-z\s]*$/.test(value);
        if (value === '' || !valid) {
            fullNameError.style.display = 'block';
        } else {
            fullNameError.style.display = 'none';
        }
    });

   

    // Contact number validation: digits only
    contactNumber.addEventListener('input', function() {
        const value = contactNumber.value.trim();
        if (value === '' || !/^\d{7,}$/.test(value)) {
            contactNumberError.style.display = 'block';
        } else {
            contactNumberError.style.display = 'none';
        }
    });

    // Email validation
    emailAddress.addEventListener('input', function() {
        const value = emailAddress.value.trim();
        if (!isValidEmail(value)) {
            emailAddressError.style.display = 'block';
        } else {
            emailAddressError.style.display = 'none';
        }
    });

    customCaptcha.addEventListener('input', () => {
        const value = customCaptcha.value.trim();

        if (value.length === 4) {
            customCaptchaError.style.display = 'none'; // hide error if 4 digits entered
        } else if (value === '') {
            customCaptchaError.style.display = 'block';
            customCaptchaError.textContent = "Please enter the captcha.";
        } else {
            customCaptchaError.style.display = 'block';
            customCaptchaError.textContent = "Captcha must be 4 digits.";
        }
    }); 

    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true; 

        if (fullName.value.trim() === '' || !/^[A-Za-z\s]+$/.test(fullName.value.trim())) { fullNameError.style.display = 'block'; isValid = false; } else { fullNameError.style.display = 'none'; }
        // if (experience.value.trim() === '' || !/^\d+$/.test(experience.value.trim())) { experienceError.style.display = 'block'; isValid = false; } else { experienceError.style.display = 'none'; }
        if (contactNumber.value.trim() === '' || !/^\d{7,}$/.test(contactNumber.value.trim())) { contactNumberError.style.display = 'block'; isValid = false; } else { contactNumberError.style.display = 'none'; }
        if (!isValidEmail(emailAddress.value.trim())) { emailAddressError.style.display = 'block'; isValid = false; } else { emailAddressError.style.display = 'none'; }
        // if (message.value.trim() === '') { messageError.style.display = 'block'; isValid = false; } else { messageError.style.display = 'none'; }
        if (customCaptcha.value.trim() === '') { customCaptchaError.style.display = 'block'; isValid = false; } else { customCaptchaError.style.display = 'none'; }

        if (!isValid) return;

        submitButton.textContent = 'Verifying captcha...';
        submitButton.disabled = true;

        // AJAX captcha verification
        $.ajax({
            url: '{{ route("captcha.verify") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                custom_captcha: customCaptcha.value.trim()
            },
            success: function(response) {
                if (response.success) {
                    submitButton.textContent = 'Submitting...';
                    form.submit();
                } else {
                    customCaptchaError.style.display = 'block';
                    customCaptchaError.textContent = response.message;
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