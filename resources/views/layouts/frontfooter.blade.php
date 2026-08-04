   <footer class="site-footer">
       <div class="container">
           <div class="footer-top">

               <div class="footer-brand">
                   <div class="logo">
                       <img src="{{ asset('public/front/assets/images/footer-logo.svg') }}" alt="Blitz Protection Logo">
                   </div>
                   <p>We do not just make protection devices. We make sure the systems that power your world never stop
                       running. It is the Blitz standard, and we never compromise on it. </p>
                   <div class="contact-info">
                       <span><svg class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                               xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" clip-rule="evenodd"
                                   d="M3.57495 1.78507C4.86403 0.500097 7.0254 0.859428 7.938 2.37559L7.9444 2.38614L10.0481 5.98116C10.6675 7.06187 10.5113 8.45113 9.58707 9.3724L9.23813 9.7202C10.4735 11.6579 12.3503 13.575 14.2473 14.7248L14.5941 14.4175C15.5184 13.5164 16.898 13.3683 17.9731 13.9807L17.9809 13.9851L21.5408 16.0553C22.4222 16.4771 22.8861 17.2924 22.9811 18.1063C23.0759 18.9196 22.8156 19.8023 22.1826 20.4332L20.9831 21.629C19.7376 22.8705 17.7101 23.4199 15.9799 22.636C13.7025 21.7053 10.2867 19.9491 7.17367 16.8459C4.05248 13.7347 2.29312 10.2235 1.36877 8.07567C0.580207 6.3562 1.1236 4.34015 2.36039 3.0955L3.54727 1.8138C3.55631 1.80404 3.56553 1.79446 3.57495 1.78507ZM4.99956 3.18371L3.81678 4.46098C3.80775 4.47074 3.79851 4.48031 3.78909 4.48971C3.04036 5.23605 2.79125 6.39219 3.19015 7.25373C3.194 7.26207 3.19773 7.2704 3.20134 7.2788C4.07772 9.3172 5.71644 12.5749 8.5874 15.4367C11.4635 18.3037 14.635 19.9343 16.7561 20.7993C16.7697 20.8048 16.7831 20.8107 16.7965 20.8168C17.6608 21.2145 18.8206 20.9661 19.5693 20.2198L20.7689 19.024C20.9356 18.8578 21.0252 18.5945 20.9951 18.3365C20.9669 18.0949 20.8471 17.9295 20.6623 17.8457C20.6315 17.8317 20.6014 17.8162 20.5722 17.7993L16.9781 15.7093C16.6631 15.5317 16.2593 15.5759 15.9848 15.8495C15.9709 15.8633 15.9567 15.8767 15.9421 15.8896L15.0424 16.6868C14.7325 16.9613 14.2849 17.0168 13.9171 16.8261C11.2199 15.4281 8.5882 12.6858 7.10834 10.0515C6.8896 9.6622 6.95713 9.17547 7.27367 8.86L8.17334 7.9632C8.4478 7.6896 8.49207 7.287 8.31393 6.97307L6.22104 3.39667C5.93617 2.92942 5.31277 2.88679 4.99956 3.18371Z"
                                   fill="#E5EEFF" />
                               <path fill-rule="evenodd" clip-rule="evenodd"
                                   d="M16.2554 7.7446C15.754 7.2432 14.9795 7.06347 14.4319 7.246C13.862 7.43593 13.2461 7.12793 13.0561 6.55811C12.8661 5.98827 13.1741 5.37233 13.744 5.18237C15.1541 4.71235 16.7723 5.18519 17.7935 6.20645C18.8148 7.22773 19.2877 8.84593 18.8176 10.256C18.6277 10.8259 18.0117 11.1339 17.4419 10.9439C16.872 10.7539 16.5641 10.138 16.754 9.56813C16.9365 9.02047 16.7568 8.246 16.2554 7.7446Z"
                                   fill="#E5EEFF" />
                               <path fill-rule="evenodd" clip-rule="evenodd"
                                   d="M18.9493 5.05067C17.1752 3.27653 14.5963 2.65215 12.2855 3.27429C11.7415 3.42074 11.1818 3.09848 11.0353 2.5545C10.8889 2.01052 11.2111 1.45081 11.7551 1.30435C14.7485 0.498424 18.0859 1.3021 20.3919 3.60812C22.6979 5.91414 23.5016 9.25147 22.6957 12.2449C22.5492 12.7889 21.9895 13.1111 21.4455 12.9647C20.9015 12.8182 20.5793 12.2585 20.7257 11.7145C21.3479 9.40374 20.7235 6.8248 18.9493 5.05067Z"
                                   fill="#E5EEFF" />
                           </svg>
                           <a
                               href="tel:{{ $settings->phone ?? '+91 97252 01620' }}">{{ $settings->phone ?? '+91 97252 01620' }}</a></span>
                       <span class="divider">|</span>
                       <span><svg class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                               xmlns="http://www.w3.org/2000/svg">
                               <path fill-rule="evenodd" clip-rule="evenodd"
                                   d="M5.61728 5C4.24604 5 3 6.22761 3 7.9724V16.0276C3 17.7724 4.24604 19 5.61728 19H18.4787C19.8543 19 21.0741 17.7763 20.9966 16.0731C20.9959 16.0579 20.9955 16.0427 20.9955 16.0276V7.9724C20.9955 6.22761 19.7495 5 18.3783 5H5.61728ZM1 7.9724C1 5.30343 2.96932 3 5.61728 3H18.3783C21.0262 3 22.9955 5.30343 22.9955 7.9724V16.0061C23.1061 18.7062 21.1146 21 18.4787 21H5.61728C2.96932 21 1 18.6966 1 16.0276V7.9724Z"
                                   fill="#E5EEFF" />
                               <path fill-rule="evenodd" clip-rule="evenodd"
                                   d="M5.13017 7.50712C5.40247 7.02665 6.01273 6.85785 6.49322 7.13019L11.172 9.78172C11.7137 10.073 12.2867 10.073 12.8283 9.78172L17.5071 7.13019C17.9876 6.85785 18.5979 7.02665 18.8702 7.50712C19.1425 7.98759 18.9737 8.59785 18.4932 8.87019L13.8057 11.5267L13.7897 11.5355C12.6485 12.1551 11.3519 12.1551 10.2106 11.5355L10.1946 11.5267L5.50713 8.87019C5.02664 8.59785 4.85787 7.98759 5.13017 7.50712Z"
                                   fill="#E5EEFF" />
                           </svg><a
                               href="mailto:{{ $settings->email ?? 'sales@blitzenergyindia.com' }}">{{ $settings->email ?? 'sales@blitzenergyindia.com' }}</a>
                       </span>
                   </div>
                   <div class="socials">
                       <a href="https://www.linkedin.com/company/blitz-protection" target="_blanck"><svg width="24"
                               height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <g clip-path="url(#clip0_1_135025)">
                                   <path
                                       d="M22.2234 0H1.77187C0.792187 0 0 0.773438 0 1.72969V22.2656C0 23.2219 0.792187 24 1.77187 24H22.2234C23.2031 24 24 23.2219 24 22.2703V1.72969C24 0.773438 23.2031 0 22.2234 0ZM7.12031 20.4516H3.55781V8.99531H7.12031V20.4516ZM5.33906 7.43437C4.19531 7.43437 3.27187 6.51094 3.27187 5.37187C3.27187 4.23281 4.19531 3.30937 5.33906 3.30937C6.47812 3.30937 7.40156 4.23281 7.40156 5.37187C7.40156 6.50625 6.47812 7.43437 5.33906 7.43437ZM20.4516 20.4516H16.8937V14.8828C16.8937 13.5562 16.8703 11.8453 15.0422 11.8453C13.1906 11.8453 12.9094 13.2937 12.9094 14.7891V20.4516H9.35625V8.99531H12.7687V10.5609H12.8156C13.2891 9.66094 14.4516 8.70937 16.1812 8.70937C19.7859 8.70937 20.4516 11.0813 20.4516 14.1656V20.4516Z"
                                       fill="#E5EEFF" />
                               </g>
                               <defs>
                                   <clipPath id="clip0_1_135025">
                                       <rect width="24" height="24" fill="white" />
                                   </clipPath>
                               </defs>
                           </svg>
                       </a>
                       <!--<a href="#"  target="_blanck"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"-->
                       <!--        xmlns="http://www.w3.org/2000/svg">-->
                       <!--        <g clip-path="url(#clip0_1_135026)">-->
                       <!--            <path fill-rule="evenodd" clip-rule="evenodd"-->
                       <!--                d="M15.9455 23L10.396 15.0901L3.44886 23H0.509766L9.09209 13.2311L0.509766 1H8.05571L13.286 8.45502L19.8393 1H22.7784L14.5943 10.3165L23.4914 23H15.9455ZM19.2185 20.77H17.2397L4.71811 3.23H6.6971L11.7121 10.2532L12.5793 11.4719L19.2185 20.77Z"-->
                       <!--                fill="#E5EEFF" />-->
                       <!--        </g>-->
                       <!--        <defs>-->
                       <!--            <clipPath id="clip0_1_135026">-->
                       <!--                <rect width="24" height="24" fill="white" />-->
                       <!--            </clipPath>-->
                       <!--        </defs>-->
                       <!--    </svg>-->
                       <!--</a>-->
                       <a href="https://www.facebook.com/BlitzEnergyIndia" target="_blanck"><svg width="24"
                               height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <g clip-path="url(#clip0_1_135027)">
                                   <path
                                       d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 17.9895 4.3882 22.954 10.125 23.8542V15.4687H7.07812V12H10.125V9.35625C10.125 6.34875 11.9166 4.6875 14.6576 4.6875C15.9701 4.6875 17.3437 4.92187 17.3437 4.92187V7.875H15.8306C14.34 7.875 13.875 8.80008 13.875 9.75V12H17.2031L16.6711 15.4687H13.875V23.8542C19.6118 22.954 24 17.9895 24 12Z"
                                       fill="#E5EEFF" />
                               </g>
                               <defs>
                                   <clipPath id="clip0_1_135027">
                                       <rect width="24" height="24" fill="white" />
                                   </clipPath>
                               </defs>
                           </svg>
                       </a>
                       <a href="https://www.instagram.com/blitz_energy_india" target="_blanck"><svg width="24"
                               height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <g clip-path="url(#clip0_1_135028)">
                                   <path
                                       d="M12 2.16094C15.2063 2.16094 15.5859 2.175 16.8469 2.23125C18.0187 2.28281 18.6516 2.47969 19.0734 2.64375C19.6313 2.85938 20.0344 3.12187 20.4516 3.53906C20.8734 3.96094 21.1313 4.35938 21.3469 4.91719C21.5109 5.33906 21.7078 5.97656 21.7594 7.14375C21.8156 8.40937 21.8297 8.78906 21.8297 11.9906C21.8297 15.1969 21.8156 15.5766 21.7594 16.8375C21.7078 18.0094 21.5109 18.6422 21.3469 19.0641C21.1313 19.6219 20.8687 20.025 20.4516 20.4422C20.0297 20.8641 19.6313 21.1219 19.0734 21.3375C18.6516 21.5016 18.0141 21.6984 16.8469 21.75C15.5813 21.8062 15.2016 21.8203 12 21.8203C8.79375 21.8203 8.41406 21.8062 7.15313 21.75C5.98125 21.6984 5.34844 21.5016 4.92656 21.3375C4.36875 21.1219 3.96562 20.8594 3.54844 20.4422C3.12656 20.0203 2.86875 19.6219 2.65312 19.0641C2.48906 18.6422 2.29219 18.0047 2.24062 16.8375C2.18438 15.5719 2.17031 15.1922 2.17031 11.9906C2.17031 8.78437 2.18438 8.40469 2.24062 7.14375C2.29219 5.97187 2.48906 5.33906 2.65312 4.91719C2.86875 4.35938 3.13125 3.95625 3.54844 3.53906C3.97031 3.11719 4.36875 2.85938 4.92656 2.64375C5.34844 2.47969 5.98594 2.28281 7.15313 2.23125C8.41406 2.175 8.79375 2.16094 12 2.16094ZM12 0C8.74219 0 8.33438 0.0140625 7.05469 0.0703125C5.77969 0.126562 4.90312 0.332812 4.14375 0.628125C3.35156 0.9375 2.68125 1.34531 2.01562 2.01562C1.34531 2.68125 0.9375 3.35156 0.628125 4.13906C0.332812 4.90313 0.126563 5.775 0.0703125 7.05C0.0140625 8.33437 0 8.74219 0 12C0 15.2578 0.0140625 15.6656 0.0703125 16.9453C0.126563 18.2203 0.332812 19.0969 0.628125 19.8562C0.9375 20.6484 1.34531 21.3187 2.01562 21.9844C2.68125 22.65 3.35156 23.0625 4.13906 23.3672C4.90313 23.6625 5.775 23.8687 7.05 23.925C8.32969 23.9812 8.7375 23.9953 11.9953 23.9953C15.2531 23.9953 15.6609 23.9812 16.9406 23.925C18.2156 23.8687 19.0922 23.6625 19.8516 23.3672C20.6391 23.0625 21.3094 22.65 21.975 21.9844C22.6406 21.3187 23.0531 20.6484 23.3578 19.8609C23.6531 19.0969 23.8594 18.225 23.9156 16.95C23.9719 15.6703 23.9859 15.2625 23.9859 12.0047C23.9859 8.74687 23.9719 8.33906 23.9156 7.05937C23.8594 5.78437 23.6531 4.90781 23.3578 4.14844C23.0625 3.35156 22.6547 2.68125 21.9844 2.01562C21.3188 1.35 20.6484 0.9375 19.8609 0.632812C19.0969 0.3375 18.225 0.13125 16.95 0.075C15.6656 0.0140625 15.2578 0 12 0Z"
                                       fill="#E5EEFF" />
                                   <path
                                       d="M12 5.83594C8.59687 5.83594 5.83594 8.59687 5.83594 12C5.83594 15.4031 8.59687 18.1641 12 18.1641C15.4031 18.1641 18.1641 15.4031 18.1641 12C18.1641 8.59687 15.4031 5.83594 12 5.83594ZM12 15.9984C9.79219 15.9984 8.00156 14.2078 8.00156 12C8.00156 9.79219 9.79219 8.00156 12 8.00156C14.2078 8.00156 15.9984 9.79219 15.9984 12C15.9984 14.2078 14.2078 15.9984 12 15.9984Z"
                                       fill="#E5EEFF" />
                                   <path
                                       d="M19.8469 5.59238C19.8469 6.38926 19.2 7.03145 18.4078 7.03145C17.6109 7.03145 16.9688 6.38457 16.9688 5.59238C16.9688 4.79551 17.6156 4.15332 18.4078 4.15332C19.2 4.15332 19.8469 4.8002 19.8469 5.59238Z"
                                       fill="#E5EEFF" />
                               </g>
                               <defs>
                                   <clipPath id="clip0_1_135028">
                                       <rect width="24" height="24" fill="white" />
                                   </clipPath>
                               </defs>
                           </svg>
                       </a>
                   </div>
               </div>

               <div class="footer_right">
                   <div class="footer-links">
                       <p class="title_24 line_left">Company</p>
                       <ul>
                           <li><a href="{{ route('front.home') }}">Home</a></li>
                           <li><a href="{{ route('front.about') }}">About</a></li>
                           {{-- <li><a href="#">FAQs</a></li>
                       <li><a href="#">Catalogues</a></li> --}}
                           <li><a href="{{ route('front.blogs') }}">Blogs</a></li>
                           <li><a href="{{ route('front.contact') }}">Contact Us</a></li>
                       </ul>
                   </div>

                   <div class="footer-links-product">
                       <p class="title_24 line_left">Product</p>
                       <ul>
                           @if (isset($categoriesHF) && count($categoriesHF) > 0)
                               @foreach ($categoriesHF as $category)
                                    @continue($category->category_url == 'solar-accessories')
                                   <li>
                                       <!-- @if ($category->category_url == 'solar-accessories')
                                           <a href="javascript:void(0);">{{ $category->title }}</a>
                                       @else -->
                                           <a
                                               href="{{ route('front.category.details', $category->category_url) }}">{{ $category->title }}</a>
                                       <!-- @endif -->
                                   </li>
                               @endforeach
                           @else
                               <li><a href="#">No categories available</a></li>
                           @endif
                           {{-- <li><a href="#">Surge Protection Devices</a></li>
                       <li><a href="#">Miniature Circuit Breakers</a></li>
                       <li><a href="#">Fuses & Fuse Holders</a></li>
                       <li><a href="#">Solar Accessories</a></li> --}}
                       </ul>
                   </div>

                   <div class="footer-newsletter">
                       <p class="title_24 line_left">Subscribe to our newsletter
                       </p>
                       <p>Be the first to receive exciting news, insider tips, and special promotions.</p>
                       <form class="subscribe-box" id="newsletter-form">
                           <input type="email" name="email" id="newsletter-email"
                               placeholder="Enter your email">
                           <button type="submit">Subscribe</button>
                       </form>
                       <div id="newsletter-email-error" class="error-message"></div>
                       {{-- <div id="newsletter-message" style="display:none;margin-top:8px;"></div> --}}
                   </div>
               </div>

           </div>
       </div>
       <div class="footer-bottom-wrapper">
           <div class="container">
               <div class="footer-bottom">
                   {{-- Privacy Policy --}}
                   <a href="#"></a>
                   <p>&copy; {{ date('Y') }} Blitz Protection. All rights reserved.</p>
                   {{-- Terms & Conditions --}}
                   <a href="#"></a>
               </div>
           </div>
       </div>

       <svg width="100%" height="100%" viewBox="0 0 1963 608" fill="none" xmlns="http://www.w3.org/2000/svg">
           <defs>
               <clipPath id="clip0_1_134778">
                   <rect width="100%" height="608" fill="none" />
               </clipPath>

               <linearGradient id="skyGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                   <stop offset="0%" stop-color="#02030A">
                       <animate attributeName="stop-color" values="#02030A;#090A24;#02030A" dur="20s"
                           repeatCount="indefinite" />
                   </stop>
                   <stop offset="100%" stop-color="#12143B">
                       <animate attributeName="stop-color" values="#12143B;#181A4A;#12143B" dur="20s"
                           repeatCount="indefinite" />
                   </stop>
               </linearGradient>

               <linearGradient id="cityGlow" x1="0%" y1="100%" x2="0%" y2="0%">
                   <stop offset="0%" stop-color="#2D327D" stop-opacity="0.8" />
                   <stop offset="70%" stop-color="#1E225E" stop-opacity="0.2" />
                   <stop offset="100%" stop-color="#12143B" stop-opacity="0" />
               </linearGradient>

               <linearGradient id="trailGrad" x1="100%" y1="0%" x2="0%" y2="0%">
                   <stop offset="0%" stop-color="#ffffff" stop-opacity="1" />
                   <stop offset="30%" stop-color="#D2E3FF" stop-opacity="0.8" />
                   <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
               </linearGradient>

               <linearGradient id="searchlightGrad" x1="50%" y1="0%" x2="50%" y2="100%">
                   <stop offset="0%" stop-color="#E2F2FF" stop-opacity="0.8" />
                   <stop offset="30%" stop-color="#E2F2FF" stop-opacity="0.25" />
                   <stop offset="100%" stop-color="#E2F2FF" stop-opacity="0" />
               </linearGradient>
           </defs>

           <style>
               /* 1. Refined Twinkling Stars */
               .star {
                   fill: #ffffff;
                   animation: gentleTwinkle 4s infinite ease-in-out;
                   transform-origin: center;
                   transform-box: fill-box;
               }

               .star:nth-child(1) {
                   animation-duration: 6s;
                   animation-delay: 0.5s;
               }

               .star:nth-child(2) {
                   animation-duration: 4.5s;
                   animation-delay: 2s;
               }

               .star:nth-child(3) {
                   animation-duration: 7s;
                   animation-delay: 1s;
               }

               .star:nth-child(4) {
                   animation-duration: 5.5s;
                   animation-delay: 3s;
               }

               .star:nth-child(5) {
                   animation-duration: 8s;
                   animation-delay: 0s;
               }

               .star:nth-child(even) {
                   animation-direction: alternate-reverse;
               }

               @keyframes gentleTwinkle {

                   0%,
                   100% {
                       opacity: 0.15;
                       transform: scale(0.8);
                   }

                   50% {
                       opacity: 0.9;
                       transform: scale(1.2);
                       filter: drop-shadow(0px 0px 4px rgba(255, 255, 255, 0.8));
                   }
               }

               /* 2. Fast Shooting Stars */
               .shooting-star {
                   stroke-dasharray: 300;
                   stroke-dashoffset: 300;
                   animation: shootStar 15s infinite ease-out;
                   opacity: 0;
               }

               .shooting-star-2 {
                   stroke-dasharray: 200;
                   stroke-dashoffset: 200;
                   animation: shootStar 22s infinite ease-out 8s;
                   opacity: 0;
               }

               @keyframes shootStar {
                   0% {
                       transform: translate(1600px, -50px) rotate(-30deg);
                       stroke-dashoffset: 300;
                       opacity: 1;
                   }

                   15% {
                       transform: translate(600px, 500px) rotate(-30deg);
                       stroke-dashoffset: 0;
                       opacity: 0;
                   }

                   100% {
                       transform: translate(600px, 500px) rotate(-30deg);
                       opacity: 0;
                   }
               }

               /* 3. High Altitude Airplane */
               .airplane-path {
                   animation: planeFly 40s infinite linear 5s;
               }

               .strobe-red {
                   fill: #ff3333;
                   animation: strobeBlink 1.2s infinite;
               }

               .strobe-white {
                   fill: #ffffff;
                   animation: strobeBlink 0.8s infinite 0.4s;
               }

               @keyframes planeFly {
                   0% {
                       transform: translate(-100px, 150px) scale(0.8);
                   }

                   100% {
                       transform: translate(2100px, 50px) scale(0.8);
                   }
               }

               @keyframes strobeBlink {

                   0%,
                   48%,
                   52%,
                   100% {
                       opacity: 0;
                       filter: none;
                   }

                   50% {
                       opacity: 1;
                       filter: drop-shadow(0 0 4px currentColor);
                   }
               }

               /* 4. Helicopter Search Animation */
               .heli-container {
                   animation: heliFlight 35s infinite ease-in-out;
               }

               .heli-rotor {
                   animation: rotorSpin 0.1s infinite linear;
               }

               .search-beam {
                   transform-origin: 0px 5px;
                   animation: beamSweep 6s infinite ease-in-out;
               }

               @keyframes heliFlight {
                   0% {
                       transform: translate(2100px, 120px) rotate(5deg);
                   }

                   20% {
                       transform: translate(1300px, 160px) rotate(-2deg);
                   }

                   /* Arrive & Hover */
                   30% {
                       transform: translate(1280px, 165px) rotate(2deg);
                   }

                   /* Slight drift */
                   45% {
                       transform: translate(800px, 140px) rotate(-5deg);
                   }

                   /* Move to new spot */
                   55% {
                       transform: translate(780px, 145px) rotate(1deg);
                   }

                   /* Hover again */
                   75% {
                       transform: translate(-200px, 90px) rotate(-8deg);
                   }

                   /* Fly away */
                   100% {
                       transform: translate(-200px, 90px);
                   }
               }

               @keyframes rotorSpin {
                   0% {
                       opacity: 0.8;
                       transform: scaleX(1);
                   }

                   50% {
                       opacity: 0.3;
                       transform: scaleX(0.1);
                   }

                   100% {
                       opacity: 0.8;
                       transform: scaleX(1);
                   }
               }

               @keyframes beamSweep {
                   0% {
                       transform: rotate(-35deg);
                       opacity: 0.9;
                   }

                   50% {
                       transform: rotate(35deg);
                       opacity: 0.5;
                   }

                   100% {
                       transform: rotate(-35deg);
                       opacity: 0.9;
                   }
               }

               /* 5. Moon & Environment */
               .moon {
                   animation: moonPulse 6s infinite alternate ease-in-out;
                   transform-origin: center;
               }

               @keyframes moonPulse {
                   0% {
                       filter: drop-shadow(0px 0px 15px rgba(255, 251, 234, 0.4));
                   }

                   100% {
                       filter: drop-shadow(0px 0px 35px rgba(255, 251, 234, 0.9));
                   }
               }

               .horizon-glow {
                   animation: ambientGlow 12s infinite alternate ease-in-out;
               }

               @keyframes ambientGlow {
                   0% {
                       opacity: 0.6;
                   }

                   100% {
                       opacity: 1;
                   }
               }

               .cloud-back {
                   fill: #ffffff;
                   opacity: 0.04;
                   animation: drift 100s infinite linear;
               }

               @keyframes drift {
                   0% {
                       transform: translateX(-400px);
                   }

                   100% {
                       transform: translateX(2100px);
                   }
               }

               /* 6. Window Groups */
               .win-off {
                   fill: #202256;
               }

               .win-sync-a {
                   fill: #FFCC00;
                   animation: syncA 7s infinite;
               }

               @keyframes syncA {

                   0%,
                   85% {
                       opacity: 0.1;
                   }

                   86%,
                   88% {
                       opacity: 1;
                       filter: drop-shadow(0 0 6px rgba(255, 204, 0, 0.8));
                   }

                   89%,
                   91% {
                       opacity: 0.3;
                   }

                   92%,
                   96% {
                       opacity: 1;
                       filter: drop-shadow(0 0 8px rgba(255, 204, 0, 1));
                   }

                   97%,
                   100% {
                       opacity: 0.1;
                   }
               }

               .win-sync-b {
                   fill: #FFCC00;
                   animation: syncB 11s infinite;
               }

               @keyframes syncB {

                   0%,
                   40% {
                       opacity: 0.1;
                   }

                   41%,
                   43% {
                       opacity: 1;
                       filter: drop-shadow(0 0 6px rgba(255, 204, 0, 0.8));
                   }

                   44%,
                   45% {
                       opacity: 0.1;
                   }

                   46%,
                   49% {
                       opacity: 1;
                       filter: drop-shadow(0 0 6px rgba(255, 204, 0, 0.8));
                   }

                   50%,
                   100% {
                       opacity: 0.1;
                   }
               }

               .win-spark-1 {
                   fill: #FFCC00;
                   animation: spark1 15s infinite;
               }

               @keyframes spark1 {

                   0%,
                   70% {
                       opacity: 0.1;
                   }

                   71%,
                   78% {
                       opacity: 1;
                       filter: drop-shadow(0 0 4px rgba(255, 204, 0, 0.6));
                   }

                   79%,
                   100% {
                       opacity: 0.1;
                   }
               }

               .win-spark-2 {
                   fill: #FFCC00;
                   animation: spark2 9s infinite 2s;
               }

               @keyframes spark2 {

                   0%,
                   10% {
                       opacity: 0.1;
                   }

                   11%,
                   13% {
                       opacity: 1;
                       filter: drop-shadow(0 0 8px rgba(255, 204, 0, 0.9));
                   }

                   14%,
                   100% {
                       opacity: 0.1;
                   }
               }
           </style>

           <rect width="1963" height="608" fill="url()" />
           <rect x="0" y="150" width="1963" height="458" fill="url(#cityGlow)" class="horizon-glow" />

           <circle cx="1750" cy="120" r="35" fill="#FFFBEA" class="moon" />
           <circle cx="1740" cy="110" r="6" fill="#E6E0C8" opacity="0.4" />
           <circle cx="1765" cy="130" r="8" fill="#E6E0C8" opacity="0.3" />
           <circle cx="1745" cy="135" r="4" fill="#E6E0C8" opacity="0.5" />

           <g class="cloud-back" style="animation-delay: -30s;">
               <ellipse cx="200" cy="180" rx="120" ry="40" />
               <ellipse cx="800" cy="220" rx="150" ry="45" />
               <ellipse cx="1500" cy="160" rx="180" ry="50" />
           </g>

           <g class="stars-container">
               <circle cx="150" cy="80" r="1.5" class="star" />
               <circle cx="320" cy="120" r="2" class="star" />
               <circle cx="480" cy="50" r="1.2" class="star" />
               <circle cx="700" cy="90" r="2.5" class="star" />
               <circle cx="950" cy="40" r="1.5" class="star" />
               <circle cx="1200" cy="130" r="2" class="star" />
               <circle cx="1450" cy="70" r="1" class="star" />
               <circle cx="1680" cy="220" r="1.5" class="star" />
               <circle cx="1850" cy="50" r="2" class="star" />
               <circle cx="85" cy="190" r="1" class="star" />
               <circle cx="620" cy="150" r="1.8" class="star" />
               <circle cx="1080" cy="80" r="1.2" class="star" />
               <circle cx="1320" cy="45" r="2.2" class="star" />
           </g>

           <line x1="0" y1="0" x2="200" y2="0" stroke="url(#trailGrad)"
               stroke-width="2.5" stroke-linecap="round" class="shooting-star" />
           <line x1="0" y1="0" x2="120" y2="0" stroke="url(#trailGrad)"
               stroke-width="1.5" stroke-linecap="round" class="shooting-star-2"
               style="transform: translate(1200px, -20px) rotate(-25deg);" />

           <g class="airplane-path">
               <circle cx="0" cy="0" r="2.5" class="strobe-red" />
               <circle cx="-15" cy="2" r="2" class="strobe-white" />
           </g>

           <g clip-path="url(#clip0_1_134778)">
               <path
                   d="M1962.67 223.211V608.001H0V205.457L38.9224 177.265L66.8082 157.067L89.4422 140.678V270.882H162.654V109.612H173.187V103.358H191.23V92.8348H220.196V80.8021H244.254V70.8538H279.608V54.5083H284.745V35.6038H293.148V54.5083H313.077V319.761H334.891V164.212L437.931 222.076H458.982V341.555H473.27V227.84H515.401V252.883H540.971V235.603H550.741V275.425H558.08V257.397H567.663V206.794H607.909V164.212H653.033V317.202H665.825V117.633H677.854V92.0872H689.135V67.6623H774.879V92.0872H786.16V114.241H797.441V280.687H836.551V265.908H856.609V30.4571H967.419V395.853H1016.05V206.794H1039.12V51.8774H1043.32V41.9148H1051.91V30.4571H1056.11V41.9148H1072.27V51.8774H1083.12V59.3961H1111.7V67.6623H1123.35V211.552H1144.92V178.315H1176.51V149.189H1183.28V178.315H1208.09V250.641H1216.12V230.342H1242.7V250.641H1263V300.224H1319.4V211.552H1322.92V183.749H1327.68V211.552H1333.45V199.031H1343.74V211.552H1349.25V187.257H1383.84V230.342H1381.84V300.224H1387.48V260.776H1396.87V247.622H1404.03V223.211H1418.69V44.9338H1432.23V18.1943H1488.63V361.092H1506.69V328.401H1527.74V338.177H1547.3V240.117H1592.62L1648.84 201.546V369.171H1681.94V223.211H1785.72V336.293H1799.26V316.382H1886.51V406.563H1893.28V379.881H1905.31V278.444H1948.94V379.881H1960.22V223.211H1962.67Z"
                   fill="#15174A" />

               <path d="M885.435 44.8818H871.723V431.513H885.435V44.8818Z" fill="#303281" />
               <path d="M917.937 44.8818H904.225V431.513H917.937V44.8818Z" fill="#303281" />
               <path d="M950.438 44.8818H936.727V431.513H950.438V44.8818Z" fill="#303281" />
               <path d="M788.182 127.334H674.932V134.437H788.182V127.334Z" fill="#303281" />
               <path d="M788.182 155.494H674.932V162.598H788.182V155.494Z" fill="#303281" />
               <path d="M788.182 183.654H674.932V190.758H788.182V183.654Z" fill="#303281" />
               <path d="M788.182 211.814H674.932V218.918H788.182V211.814Z" fill="#303281" />
               <path d="M788.182 239.975H674.932V247.078H788.182V239.975Z" fill="#303281" />
               <path d="M788.182 268.134H674.932V275.237H788.182V268.134Z" fill="#303281" />
               <path d="M192.39 122.258H178.17V153.97H192.39V122.258Z" fill="#303281" />
               <path d="M192.39 218.323H178.17V250.035H192.39V218.323Z" fill="#303281" />
               <path d="M218.798 218.323H204.578V250.035H218.798V218.323Z" fill="#303281" />
               <path d="M219.634 264.168H205.414V295.88H219.634V264.168Z" fill="#303281" />
               <path d="M245.206 218.323H230.986V250.035H245.206V218.323Z" fill="#303281" />
               <path d="M218.798 166.274H204.578V197.986H218.798V166.274Z" fill="#303281" />
               <path d="M245.206 122.258H230.986V153.97H245.206V122.258Z" fill="#303281" />
               <path d="M271.614 166.274H257.395V197.986H271.614V166.274Z" fill="#303281" />
               <path d="M298.022 122.258H283.803V153.97H298.022V122.258Z" fill="#303281" />
               <path d="M298.858 260.109H284.639V291.821H298.858V260.109Z" fill="#303281" />
               <path
                   d="M1962.67 224.088V608H0.345703V236.035L66.9238 280.284V280.701H105.501V329.148H113.055V259.266H116.825V329.148H124.394V407.153H151.46V425.396H163.431V442.374H179.792V359.338H190.08V339.628H244.442V359.338H251.579V398.973H263.162V380.773H266.932V398.973H271.551V355.615H275.335V398.973H348.546V431.678H366.173V310.474H387.267V296.745H437.01V310.474H452.637V414.068H471.947V324.217L473.271 325.065L520.021 355.255V386.178H525.158V378.056H527.834V367.202H531.863V363.838H580.93V367.202H585.707V378.056H588.441V386.178H591.793V407.986H598.829V353.041H607.952V407.986H656.861V449.188H682.674V391.885H690.013V379.551H692.646V374.433H696.733V367.044H698.459V357.915H704.92V339.671H724.417V322.751H728.187V339.671H732.806V297.578H736.59V339.671H758.591V357.915H762.692V367.044H764.261V374.433H768.361V379.551H772.606V391.885H778.793V423.498H786.564V350.295H795.168V320.12H821.615L891.287 276.503V451.186H904.827V410.603H981.334V393.093H984.96V386.077H988.571V378.918L1016.05 367.604L1051.15 353.171V386.077H1054.85V393.093H1059.62V433.777H1100.33V450.971H1110.84V293.697H1130.25V276.302H1189.74V293.697H1205.49V460.617H1224.7V448.671L1303.09 399.591V448.671H1323.23V379.781H1397.21V494.588H1405.29V474.663H1413.48V451.603H1446.85V382.613H1469.63V352.107H1577.29V449.921H1594.39V341.929H1613.29V255.126H1691.78V331.031H1705.64V295.796H1724.95V116.325L1769.95 182.469L1832.82 274.864V358.705H1843.74V371.284H1855.48V276.086H1880.46V232.886H1884.45V224.088H1887.4V213.608H1917.3V189.01H1921.08V213.608H1925.7V163.852H1929.47V213.608H1935.98V180.212H1939.76V213.608H1961.2V224.088H1962.67Z"
                   fill="#1A1A2D" />

               <path d="M360.954 205.344H344.449V221.834H360.954V205.344Z" fill="#303281" />
               <path d="M389.013 205.344H372.508V221.834H389.013V205.344Z" fill="#303281" />
               <path d="M360.954 232.87H344.449V249.36H360.954V232.87Z" fill="#303281" />
               <path d="M360.954 275.33H344.449V291.82H360.954V275.33Z" fill="#303281" />
               <path d="M389.013 232.87H372.508V249.36H389.013V232.87Z" fill="#303281" />
               <path d="M444.114 232.87H427.609V249.36H444.114V232.87Z" fill="#303281" />
               <path d="M415.927 253.419H399.422V269.909H415.927V253.419Z" fill="#303281" />
               <path d="M389.14 275.965H372.635V292.455H389.14V275.965Z" fill="#303281" />
               <path d="M449.827 275.965H433.322V292.455H449.827V275.965Z" fill="#303281" />
               <path d="M360.954 296.515H344.449V313.005H360.954V296.515Z" fill="#303281" />
               <path d="M1479.19 26.6162H1474.46V349.316H1479.19V26.6162Z" fill="#303281" />
               <path d="M1463.28 26.6162H1458.54V349.316H1463.28V26.6162Z" fill="#303281" />
               <path d="M1447.37 26.6162H1442.63V349.316H1447.37V26.6162Z" fill="#303281" />
               <path d="M1431.46 55.0303H1426.72V349.316H1431.46V55.0303Z" fill="#303281" />
               <path d="M1056.58 66.6992H1044.9V82.9357H1056.58V66.6992Z" fill="#303281" />
               <path d="M1103.56 66.6992H1091.88V82.9357H1103.56V66.6992Z" fill="#303281" />
               <path d="M1056.58 94.8594H1044.9V111.096H1056.58V94.8594Z" fill="#303281" />
               <path d="M1086.41 94.8594H1074.73V111.096H1086.41V94.8594Z" fill="#303281" />
               <path d="M1118.03 94.8594H1106.35V111.096H1118.03V94.8594Z" fill="#303281" />
               <path d="M1118.03 123.02H1106.35V139.256H1118.03V123.02Z" fill="#303281" />
               <path d="M1056.58 123.02H1044.9V139.256H1056.58V123.02Z" fill="#303281" />
               <path d="M1076.39 123.02H1064.71V139.256H1076.39V123.02Z" fill="#303281" />

               <path d="M23.2613 314.114H10.8086V353.909H23.2613V314.114Z" class="win-off" />
               <path d="M40.7729 314.114H28.3203V330.504H40.7729V314.114Z" class="win-off" />
               <path d="M40.7729 337.521H28.3203V353.91H40.7729V337.521Z" class="win-off" />
               <path d="M75.9584 314.114H63.5059V353.909H75.9584V314.114Z" class="win-sync-a" />
               <path d="M93.47 314.114H81.0176V330.504H93.47V314.114Z" class="win-off" />
               <path d="M93.47 337.521H81.0176V353.91H93.47V337.521Z" class="win-off" />
               <path d="M23.2613 383.761H10.8086V423.556H23.2613V383.761Z" class="win-off" />
               <path d="M40.7729 383.761H28.3203V400.151H40.7729V383.761Z" class="win-sync-b" />
               <path d="M40.7729 407.167H28.3203V423.557H40.7729V407.167Z" class="win-off" />
               <path d="M75.9584 383.761H63.5059V423.556H75.9584V383.761Z" class="win-off" />
               <path d="M93.47 383.761H81.0176V400.151H93.47V383.761Z" class="win-off" />
               <path d="M93.47 407.167H81.0176V423.557H93.47V407.167Z" class="win-off" />
               <path d="M23.2613 453.409H10.8086V493.204H23.2613V453.409Z" class="win-off" />
               <path d="M40.7729 453.409H28.3203V469.799H40.7729V453.409Z" class="win-off" />
               <path d="M40.7729 476.814H28.3203V493.204H40.7729V476.814Z" class="win-off" />
               <path d="M75.9584 453.409H63.5059V493.204H75.9584V453.409Z" class="win-off" />
               <path d="M93.47 453.409H81.0176V469.799H93.47V453.409Z" class="win-off" />
               <path d="M93.47 476.814H81.0176V493.204H93.47V476.814Z" class="win-sync-a" />

               <path d="M430.141 332.481H439.916V322.715H430.141V332.481Z" class="win-off" />
               <path d="M393.67 332.481H403.445V322.715H393.67V332.481Z" class="win-spark-1" />
               <path d="M375.436 332.481H385.211V322.715H375.436V332.481Z" class="win-off" />
               <path d="M430.141 351.526H439.916V341.76H430.141V351.526Z" class="win-off" />
               <path d="M411.905 351.526H421.68V341.76H411.905V351.526Z" class="win-off" />
               <path d="M393.67 351.526H403.445V341.76H393.67V351.526Z" class="win-off" />
               <path d="M375.436 351.526H385.211V341.76H375.436V351.526Z" class="win-off" />
               <path d="M430.141 370.571H439.916V360.805H430.141V370.571Z" class="win-off" />
               <path d="M411.905 370.571H421.68V360.805H411.905V370.571Z" class="win-off" />
               <path d="M393.67 370.571H403.445V360.805H393.67V370.571Z" class="win-off" />
               <path d="M411.905 389.616H421.68V379.85H411.905V389.616Z" class="win-off" />
               <path d="M393.67 389.616H403.445V379.85H393.67V389.616Z" class="win-off" />
               <path d="M375.436 389.616H385.211V379.85H375.436V389.616Z" class="win-off" />

               <path d="M196.053 368.771H189.818V390.623H196.053V368.771Z" class="win-off" />
               <path d="M219.403 368.771H213.168V390.623H219.403V368.771Z" class="win-off" />
               <path d="M242.751 368.771H236.516V390.623H242.751V368.771Z" class="win-off" />
               <path d="M196.053 404.452H189.818V426.303H196.053V404.452Z" class="win-off" />
               <path d="M219.403 404.452H213.168V426.303H219.403V404.452Z" class="win-off" />
               <path d="M242.751 404.452H236.516V426.303H242.751V404.452Z" class="win-off" />

               <path d="M491.663 357.931H479.01V370.572H491.663V357.931Z" class="win-off" />
               <path d="M515.282 357.931H502.629V370.572H515.282V357.931Z" class="win-sync-b" />
               <path d="M491.663 379.936H479.01V392.577H491.663V379.936Z" class="win-off" />
               <path d="M515.282 379.936H502.629V392.577H515.282V379.936Z" class="win-off" />
               <path d="M491.663 401.94H479.01V414.582H491.663V401.94Z" class="win-off" />
               <path d="M515.282 401.94H502.629V414.582H515.282V401.94Z" class="win-off" />
               <path d="M491.663 423.945H479.01V436.587H491.663V423.945Z" class="win-off" />
               <path d="M515.282 423.945H502.629V436.587H515.282V423.945Z" class="win-off" />

               <path d="M862.033 357.191H869.646V338.255H862.033V357.191Z" class="win-off" />
               <path d="M849.613 345.861H857.227V338.254H849.613V345.861Z" class="win-off" />
               <path d="M849.613 357.191H857.227V349.585H849.613V357.191Z" class="win-off" />
               <path d="M827.806 357.191H835.42V338.255H827.806V357.191Z" class="win-spark-2" />
               <path d="M815.386 345.861H823V338.254H815.386V345.861Z" class="win-off" />
               <path d="M815.386 357.191H823V349.585H815.386V357.191Z" class="win-off" />
               <path d="M862.033 389.606H869.646V370.67H862.033V389.606Z" class="win-off" />
               <path d="M849.613 378.279H857.227V370.672H849.613V378.279Z" class="win-off" />
               <path d="M849.613 389.606H857.227V382H849.613V389.606Z" class="win-off" />
               <path d="M827.806 389.606H835.42V370.67H827.806V389.606Z" class="win-off" />
               <path d="M815.386 378.279H823V370.672H815.386V378.279Z" class="win-off" />
               <path d="M815.386 389.606H823V382H815.386V389.606Z" class="win-off" />
               <path d="M862.033 422.024H869.646V403.088H862.033V422.024Z" class="win-off" />
               <path d="M849.613 410.694H857.227V403.088H849.613V410.694Z" class="win-off" />
               <path d="M849.613 422.024H857.227V414.418H849.613V422.024Z" class="win-off" />
               <path d="M827.806 422.024H835.42V403.088H827.806V422.024Z" class="win-off" />
               <path d="M815.386 410.694H823V403.088H815.386V410.694Z" class="win-off" />
               <path d="M815.386 422.024H823V414.418H815.386V422.024Z" class="win-off" />
               <path d="M862.033 454.44H869.646V435.504H862.033V454.44Z" class="win-off" />
               <path d="M849.613 443.11H857.227V435.504H849.613V443.11Z" class="win-off" />
               <path d="M849.613 454.44H857.227V446.834H849.613V454.44Z" class="win-off" />
               <path d="M827.806 454.44H835.42V435.504H827.806V454.44Z" class="win-off" />
               <path d="M815.386 443.11H823V435.504H815.386V443.11Z" class="win-off" />
               <path d="M815.386 454.44H823V446.834H815.386V454.44Z" class="win-off" />

               <path d="M1134.38 308.525H1127.63V332.176H1134.38V308.525Z" class="win-off" />
               <path d="M1159.65 308.525H1152.9V332.176H1159.65V308.525Z" class="win-off" />
               <path d="M1184.92 308.525H1178.17V332.176H1184.92V308.525Z" class="win-off" />
               <path d="M1134.38 347.146H1127.63V370.796H1134.38V347.146Z" class="win-sync-a" />
               <path d="M1159.65 347.146H1152.9V370.796H1159.65V347.146Z" class="win-off" />
               <path d="M1184.92 347.146H1178.17V370.796H1184.92V347.146Z" class="win-off" />
               <path d="M1134.38 385.763H1127.63V409.413H1134.38V385.763Z" class="win-off" />
               <path d="M1159.65 385.763H1152.9V409.413H1159.65V385.763Z" class="win-off" />
               <path d="M1184.92 385.763H1178.17V409.413H1184.92V385.763Z" class="win-off" />
               <path d="M1134.38 424.382H1127.63V448.032H1134.38V424.382Z" class="win-off" />
               <path d="M1159.65 424.382H1152.9V448.032H1159.65V424.382Z" class="win-off" />
               <path d="M1184.92 424.382H1178.17V448.032H1184.92V424.382Z" class="win-off" />

               <path d="M1630.48 348.793H1616.28V362.979H1630.48V348.793Z" class="win-off" />
               <path d="M1659.47 348.793H1645.27V362.979H1659.47V348.793Z" class="win-off" />
               <path d="M1688.46 348.793H1674.26V362.979H1688.46V348.793Z" class="win-off" />
               <path d="M1659.47 381.535H1645.27V395.722H1659.47V381.535Z" class="win-off" />
               <path d="M1688.46 381.535H1674.26V395.722H1688.46V381.535Z" class="win-spark-1" />
               <path d="M1630.48 414.277H1616.28V428.464H1630.48V414.277Z" class="win-off" />
               <path d="M1659.47 414.277H1645.27V428.464H1659.47V414.277Z" class="win-off" />
               <path d="M1688.46 414.277H1674.26V428.464H1688.46V414.277Z" class="win-off" />
               <path d="M1659.47 447.021H1645.27V461.208H1659.47V447.021Z" class="win-off" />
               <path d="M1688.46 447.021H1674.26V461.208H1688.46V447.021Z" class="win-off" />

               <path d="M1483.99 369.011H1475.84V377.152H1483.99V369.011Z" class="win-off" />
               <path d="M1494.54 369.011H1486.39V377.152H1494.54V369.011Z" class="win-off" />
               <path d="M1483.99 379.239H1475.84V387.38H1483.99V379.239Z" class="win-sync-b" />
               <path d="M1494.54 379.239H1486.39V387.38H1494.54V379.239Z" class="win-off" />
               <path d="M1510.15 395.152H1502V403.293H1510.15V395.152Z" class="win-off" />
               <path d="M1520.7 395.152H1512.56V403.293H1520.7V395.152Z" class="win-off" />
               <path d="M1510.15 405.382H1502.01V413.523H1510.15V405.382Z" class="win-off" />
               <path d="M1520.7 405.382H1512.56V413.523H1520.7V405.382Z" class="win-off" />
               <path d="M1536.32 421.296H1528.17V429.437H1536.32V421.296Z" class="win-off" />
               <path d="M1546.87 421.296H1538.72V429.437H1546.87V421.296Z" class="win-off" />
               <path d="M1536.32 431.525H1528.17V439.666H1536.32V431.525Z" class="win-off" />
               <path d="M1546.87 431.525H1538.72V439.666H1546.87V431.525Z" class="win-off" />
               <path d="M1562.49 421.296H1554.34V429.437H1562.49V421.296Z" class="win-spark-2" />
               <path d="M1573.04 421.296H1564.89V429.437H1573.04V421.296Z" class="win-off" />
               <path d="M1562.49 431.525H1554.34V439.666H1562.49V431.525Z" class="win-off" />
               <path d="M1573.04 431.525H1564.89V439.666H1573.04V431.525Z" class="win-off" />
               <path d="M1562.49 447.439H1554.34V455.58H1562.49V447.439Z" class="win-off" />
               <path d="M1573.04 447.439H1564.89V455.58H1573.04V447.439Z" class="win-off" />
               <path d="M1562.49 457.667H1554.34V465.808H1562.49V457.667Z" class="win-off" />
               <path d="M1573.04 457.667H1564.89V465.808H1573.04V457.667Z" class="win-off" />
               <path d="M1537.21 472.695H1529.06V480.836H1537.21V472.695Z" class="win-off" />
               <path d="M1547.76 472.695H1539.61V480.836H1547.76V472.695Z" class="win-off" />
               <path d="M1537.21 482.923H1529.06V491.064H1537.21V482.923Z" class="win-off" />
               <path d="M1547.76 482.923H1539.61V491.064H1547.76V482.923Z" class="win-off" />
               <path d="M1511.93 497.952H1503.78V506.093H1511.93V497.952Z" class="win-off" />
               <path d="M1522.48 497.952H1514.33V506.093H1522.48V497.952Z" class="win-off" />
               <path d="M1511.93 508.182H1503.78V516.322H1511.93V508.182Z" class="win-off" />
               <path d="M1522.48 508.182H1514.33V516.322H1522.48V508.182Z" class="win-off" />
               <path d="M1486.65 497.952H1478.5V506.093H1486.65V497.952Z" class="win-off" />
               <path d="M1497.2 497.952H1489.05V506.093H1497.2V497.952Z" class="win-off" />
               <path d="M1486.65 508.182H1478.5V516.322H1486.65V508.182Z" class="win-off" />
               <path d="M1497.2 508.182H1489.05V516.322H1497.2V508.182Z" class="win-off" />
               <path d="M1486.65 523.209H1478.5V531.35H1486.65V523.209Z" class="win-off" />
               <path d="M1497.2 523.209H1489.05V531.35H1497.2V523.209Z" class="win-off" />
               <path d="M1486.65 533.438H1478.5V541.578H1486.65V533.438Z" class="win-off" />
               <path d="M1497.2 533.438H1489.05V541.578H1497.2V533.438Z" class="win-off" />

               <path d="M1884.13 289.142H1873.6V299.661H1884.13V289.142Z" class="win-off" />
               <path d="M1906.29 289.142H1895.77V299.661H1906.29V289.142Z" class="win-off" />
               <path d="M1928.46 289.142H1917.93V299.661H1928.46V289.142Z" class="win-off" />
               <path d="M1950.63 289.142H1940.1V299.661H1950.63V289.142Z" class="win-off" />
               <path d="M1884.13 321.437H1873.6V331.956H1884.13V321.437Z" class="win-off" />
               <path d="M1906.29 321.437H1895.77V331.956H1906.29V321.437Z" class="win-off" />
               <path d="M1928.46 321.437H1917.93V331.956H1928.46V321.437Z" class="win-off" />
               <path d="M1950.63 321.437H1940.1V331.956H1950.63V321.437Z" class="win-off" />
               <path d="M1884.13 353.73H1873.6V364.25H1884.13V353.73Z" class="win-off" />
               <path d="M1906.29 353.73H1895.77V364.25H1906.29V353.73Z" class="win-off" />
               <path d="M1928.46 353.73H1917.93V364.25H1928.46V353.73Z" class="win-off" />
               <path d="M1950.63 353.73H1940.1V364.25H1950.63V353.73Z" class="win-off" />
               <path d="M1884.13 386.026H1873.6V396.546H1884.13V386.026Z" class="win-off" />
               <path d="M1906.29 386.026H1895.77V396.546H1906.29V386.026Z" class="win-off" />
               <path d="M1928.46 386.026H1917.93V396.546H1928.46V386.026Z" class="win-off" />
               <path d="M1950.63 386.026H1940.1V396.546H1950.63V386.026Z" class="win-off" />

               <path d="M550.943 418.221H542.795V426.362H550.943V418.221Z" class="win-off" />
               <path d="M561.494 418.221H553.346V426.362H561.494V418.221Z" class="win-sync-a" />
               <path d="M550.943 428.449H542.795V436.59H550.943V428.449Z" class="win-off" />
               <path d="M561.494 428.449H553.346V436.59H561.494V428.449Z" class="win-off" />
               <path d="M577.424 418.221H569.275V426.362H577.424V418.221Z" class="win-off" />
               <path d="M587.974 418.221H579.826V426.362H587.974V418.221Z" class="win-off" />
               <path d="M577.424 428.449H569.275V436.59H577.424V428.449Z" class="win-off" />
               <path d="M587.974 428.449H579.826V436.59H587.974V428.449Z" class="win-off" />
               <path d="M603.907 418.221H595.758V426.362H603.907V418.221Z" class="win-sync-a" />
               <path d="M614.457 418.221H606.309V426.362H614.457V418.221Z" class="win-off" />
               <path d="M603.907 428.449H595.758V436.59H603.907V428.449Z" class="win-off" />
               <path d="M614.457 428.449H606.309V436.59H614.457V428.449Z" class="win-off" />
               <path d="M630.387 418.221H622.238V426.362H630.387V418.221Z" class="win-off" />
               <path d="M640.937 418.221H632.789V426.362H640.937V418.221Z" class="win-off" />
               <path d="M630.387 428.449H622.238V436.59H630.387V428.449Z" class="win-off" />
               <path d="M640.937 428.449H632.789V436.59H640.937V428.449Z" class="win-off" />
           </g>

           <g class="heli-container">
               <g transform="scale(0.8)">
                   <rect x="15" y="-2" width="20" height="2" fill="#0A0C27" />
                   <ellipse cx="35" cy="-2" rx="1.5" ry="5" fill="#ffffff"
                       class="heli-rotor" />
                   <path d="M-12,2 C-12,-4 -5,-8 3,-8 C12,-8 18,-4 18,2 C18,7 10,8 3,8 C-5,8 -12,7 -12,2 Z"
                       fill="#0A0C27" />
                   <path d="M-12,2 C-12,-2 -5,-6 0,-6 L0,2 Z" fill="#D2E3FF" opacity="0.6" />
                   <ellipse cx="3" cy="-10" rx="22" ry="1.5" fill="#ffffff"
                       class="heli-rotor" />
                   <rect x="2" y="-10" width="2" height="2" fill="#0A0C27" />
                   <polygon points="0,5 -100,280 100,280" fill="url(#searchlightGrad)" class="search-beam" />
               </g>
           </g>

       </svg>

       <button class="sticky-inquiry-btn" type="button" data-bs-toggle="offcanvas"
           data-bs-target="#inquiryOffcanvas" aria-controls="inquiryOffcanvas">Inquiry Now</button>
       @include('layouts.offcanvas-form')
       @include('layouts.whatsappinquiry')
   </footer>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js"></script> -->
   <script src="{{ asset('public/front/assets/js/script.js') }}"></script>
   <script src="{{ asset('public/front/assets/js/newsletter.js') }}"></script>
   <script src="{{ asset('public/front/assets/js/contact.js') }}"></script>
   <script src="{{ asset('public/front/assets/js/wa-inquiry.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.2.1/js/intlTelInput.min.js"></script>
   <script>
       var sitePath = "{{ url('/') }}";
       Fancybox.bind("[data-fancybox]", {
           animated: true,
           showClass: "fancybox-zoomInUp",
           hideClass: "fancybox-zoomOutDown",
       });
       // For Redirecting Request Quote button to Request Quote Form
       document.querySelectorAll('a[href="#getInTouchForm"]').forEach(function(link) {
           link.addEventListener("click", function(e) {
               e.preventDefault();

               document.querySelector("#getInTouchForm").scrollIntoView({
                   behavior: "smooth"
               });
           });
       });
   </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('phone');
    const countrySelect = document.getElementById('country');
    const phoneInputOffcanvas = document.getElementById('phone-offcanvas');
    const countrySelectOffcanvas = document.getElementById('country-offcanvas');
    const phoneInputWA = document.getElementById('waPhone');


    const geoLookupPromise = fetch('https://ipwho.is/')
        .then(res => res.json())
        .catch(() => null);

    function applyCountryToSelect(countrySel, countryName) {
        if (!countrySel || !countryName) return;
        [...countrySel.options].forEach(opt => {
            if (opt.text.trim().toLowerCase() === countryName.trim().toLowerCase()) {
                opt.selected = true;
            }
        });
    }

    geoLookupPromise.then(data => {
        if (!data || data.success === false) return;
        applyCountryToSelect(countrySelect, data.country);
        applyCountryToSelect(countrySelectOffcanvas, data.country);
    });

    function setupIti(input) {
        return window.intlTelInput(input, {
            initialCountry: "auto",
            dropdownParent: document.body, 
            geoIpLookup: function (callback) {
                geoLookupPromise.then(data => {
                    if (!data || data.success === false) {
                        callback('in');
                        return;
                    }
                    callback(data.country_code ? data.country_code.toLowerCase() : 'in');
                });
            },
            separateDialCode: true,
            preferredCountries: ["in", "ae", "sa", "us", "gb"],
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.2.1/build/js/utils.js"
        });
    }

    if (phoneInput) {
        const iti = setupIti(phoneInput);
        const mainForm = document.getElementById('contact-form');
        if (mainForm) {
            mainForm.addEventListener('submit', function () {
                const dialCode = iti.getSelectedCountryData().dialCode;
                const nationalNumber = phoneInput.value.replace(/[^0-9]/g, '');
                document.getElementById('phone_number').value = '+' + dialCode + nationalNumber;
            });
        }
    }

    if (phoneInputOffcanvas) {
        const itiOffcanvas = setupIti(phoneInputOffcanvas);
        const offcanvasForm = document.getElementById('contact-form-offcanvas');
        if (offcanvasForm) {
            offcanvasForm.addEventListener('submit', function () {
                const dialCode = itiOffcanvas.getSelectedCountryData().dialCode;
                const nationalNumber = phoneInputOffcanvas.value.replace(/[^0-9]/g, '');
                document.getElementById('phone_number-offcanvas').value = '+' + dialCode + nationalNumber;
            });
        }
    }

    // WhatsApp inquiry form phone country code setup
    if (phoneInputWA) {
        window.itiWA = setupIti(phoneInputWA);
    }

});
</script>

</main>

</body>

</html>
