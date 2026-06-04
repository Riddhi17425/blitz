@include('layouts.frontheader')

<section class="thank-you-section">
        <div class="image-text-wrapper">
            <!-- <img class="img-fluid" src="{{ asset('public/front/assets/images/Thank-You.webp') }}" alt="thank-you"> -->

          <picture>
            <source media="(max-width: 767px)" srcset="{{ asset('public/front/assets/images/Thank-You-m.webp') }}">
            <source media="(min-width: 768px)" srcset="{{ asset('public/front/assets/images/Thank-You.webp') }}">
            <img src="{{ asset('public/front/assets/images/Thank-You.webp') }}" alt="Banner Image" class=" img-fluid">
        </picture>

            <div class="thank_you_text">
                <h2 class="title_44">Thank You!</h1>
                <p class="my-3 my-lg-4">
                    We appreciate your interest. Your request has been received successfully. <br>
                    Our team will review the details and get back to you shortly.
                </p>
                <a href="{{ url('/') }}" class="com_btn com_btn_w_b"> 
                    <svg class="me-2" width="24" height="11" viewBox="0 0 24 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.668 5.33398L0.667969 5.33398" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.33594 10L0.669271 5.33333L5.33594 0.666666" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> Back to Home
                </a>
            </div>
        </div>
</section>

<style>
    .image-text-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }



    .thank_you_text {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    width: 100%;
}

.thank_you_text *
{
    color: var(--white);
}

@media (max-width:767px) {
    

        .thank_you_text {
        position: absolute;
        top: 24%;
        left: 0%;
        width: 100%;
        padding: 20px;
    }
    
}

</style>


@include('layouts.frontfooter')