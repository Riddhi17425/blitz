<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ $metatitle ?? 'Terrapreta' }}</title> 
        <meta name="description" content="{!! $metadescription ?? ''!!}">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/front/images/favicon.png')}}">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- Slick Slider CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" /> -->
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400..700;1,400..700&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Mozilla+Text:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poltawski+Nowy:ital,wght@0,400..700;1,400..700&family=Sacramento&display=swap"
        rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('public/front/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/responsive.css')}}">
    <style>
        @media (max-width: 991.98px) {
            .offcanvas-body {
                padding: 0;
                overflow: hidden;
            }
            
            .mobile-menu-container {
                position: relative;
                height: 100%;
                overflow: hidden;
            }
            
            .mobile-menu-level {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: white;
                transform: translateX(100%);
                transition: transform 0.3s ease-in-out;
                overflow-y: auto;
                padding: 1rem;
            }
            
            .mobile-menu-level.active {
                transform: translateX(0);
            }
            
            .mobile-menu-level.main {
                transform: translateX(0);
                position: relative;
            }
            
            .mobile-back-button {
                display: flex;
                align-items: center;
                background: none;
                border: none;
                padding: 12px 0;
                margin-bottom: 20px;
                color: #333;
                font-size: 16px;
                width: 100%;
                text-align: left;
            }
            
            .mobile-back-button:hover {
                color: #40ac44;
            }
            
            .mobile-back-button i {
                margin-right: 8px;
            }
            
            .mobile-menu-item {
                padding: 12px 0;
                border-bottom: 1px solid #f0f0f0;
            }
            
            .mobile-menu-item:last-child {
                border-bottom: none;
            }
            
            .mobile-menu-item a {
                text-decoration: none;
                color: #333;
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 16px;
                width: 100%;
            }
            
            .mobile-menu-item a:hover {
                color: #40ac44;
            }
            
            .mobile-menu-arrow {
                width: 12px;
                height: 7px;
                opacity: 0.7;
               transform: rotate(-90deg);
            }
            
            .mobile-category-title {
                font-size: 20px;
                font-weight: 600;
                color: #333;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid #40ac44;
            }
            
            .mobile-product-item a {
                font-size: 15px;
                color: #555;
            }
            
            .mobile-lang-controls {
                margin-top: auto;
                padding: 20px 0;
                border-top: 1px solid #f0f0f0;
            }
            
            .mobile-lang-controls .lang-select {
                margin-bottom: 16px;
            }
            
            .mobile-lang-controls .comman_btn {
                width: 100%;
                text-align: center;
                display: block;
            }
            
            /* Hide desktop mega menu on mobile */
            .mega_menu {
                display: none;
            }
            
        }
    </style>
</head>
@php
    use App\Models\Category;

    $categories = Category::with(['products' => function($q) {
        $q->where('product_status', 'Active');
    }])
    ->where('status', 'Active')
    ->orderBy('index_id' , 'ASC')
    ->get();
@endphp

<body>
    
        <div id="page-loader" class="loader-overlay" aria-hidden="false" role="status" aria-label="Loading">
        <div class="loader-box">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="118" height="118" rx="59" stroke="#40AC44" stroke-width="2" />
                <path
                    d="M79 39.6172C79 59.7713 73.0526 72.7347 59.9395 80.5127C55.4111 83.0259 47.4851 86.0157 43.4707 83.3496C52.4258 76.3823 67.3375 62.4619 73.3037 53.5137C78.3925 45.8814 51.0327 75.6392 41.2725 80.0557C41.1251 79.4716 41.0303 78.8192 41 78.0918L41.0488 76.3057C41.3894 60.2242 51.3142 54.6365 60.0742 49.7041L60.1338 49.6699C62.3762 48.398 64.5988 46.8208 66.5 45.5C68.9999 43.5001 68.0002 44.5 71.3955 41.6475C74.7904 38.7953 73.9788 39.1524 75.7334 37.9053L79 35.6064V39.6172Z"
                    fill="#40AC44" />
            </svg>
        </div>
    </div>
    
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('front.home') }}">
                    <img src="{{ asset('public/front/images/logo.svg')}}" alt="logo">
                </a>
                <!-- Offcanvas Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                        <!-- Desktop/Tablet View - Original Structure -->
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 d-lg-flex d-none">
                            <!-- Mega Menu Item -->
                            <li class="nav-item dropdown_down">
                                <a class="nav-link" href="#">Products
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7"
                                        fill="none">
                                        <path
                                            d="M11 1L6.26923 5.87978C6.2347 5.91773 6.19299 5.94798 6.14669 5.96865C6.10038 5.98933 6.05046 6 6 6C5.94954 6 5.89962 5.98933 5.85331 5.96865C5.80701 5.94798 5.7653 5.91773 5.73077 5.87978L1 1"
                                            stroke="#333333" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <div class="mega_menu">
                                    <div class="container">
                                        <!--<div class="row">-->
                                        <!--    @foreach ($categories as $category)-->
                                        <!--        <div class="col-md-3">-->
                                        <!--            <h6 class="title_24">{{ $category->title }}</h6>-->
                                        <!--            <ul class="list-unstyled">-->
                                        <!--                @forelse ($category->products as $product)-->
                                        <!--                    <li>-->
                                        <!--                        <a href="{{ route('front.product.deatils', ['product_url' => $product->product_url]) }}">-->
                                        <!--                            {{ $product->product_name }}-->
                                        <!--                        </a>-->

                                        <!--                    </li>-->
                                        <!--                @empty-->
                                        <!--                    <li><em>No products</em></li>-->
                                        <!--                @endforelse-->
                                        <!--            </ul>-->
                                        <!--        </div>-->
                                        <!--    @endforeach-->
                                        <!--</div>-->
                                        <div class="mega_menu_wrapper">

                                            <div class="row">
                                                <!-- Left Side -->
                                                <div class="col-md-3 menu_titles">
                                                    @foreach($categories as $index => $category)
                                                        <h6 class="category_item">
                                                            <a 
                                                                class="title_24 {{ $index == 0 ? 'active' : '' }}" 
                                                                data-target="menu{{ $category->id }}"
                                                            >
                                                                {{ $category->title }}
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                </div>

                                                <!-- Right Side -->
                                                <div class="col-md-7 menu_links">
                                                    @foreach($categories as $index => $category)
                                                        <div id="menu{{ $category->id }}" class="submenu {{ $index == 0 ? 'active' : '' }}">
                                                            <div class="row">
                                                                @forelse($category->products->chunk(12) as $chunk)
                                                                    <div class="col-md-12"> {{-- you can adjust col-md-4 for 3 columns --}}
                                                                        <ul class="two-col-product">
                                                                            @foreach($chunk as $product)
                                                                                <li>
                                                                                    <a href="{{ route('front.product.deatils', $product->product_url) }}">
                                                                                        {{ $product->product_name }}
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @empty
                                                                    <div class="col-md-12">
                                                                        <ul>
                                                                            <li><span>No Products Found</span></li>
                                                                        </ul>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.about') }}">About us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.joureny') }}">Our Terrapreta Journey</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.blogs') }}">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.career') }}">Career</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.contact') }}">Contact Us</a>
                            </li>
                        </ul>

                        <!-- Mobile View - 3 Level Menu -->
                        <div class="mobile-menu-container d-lg-none">

                            <!-- Main Menu Level -->
                            <div class="mobile-menu-level main active" id="mobileMainMenu">
                                <div class="mobile-menu-item">
                                    <a href="#" class="mobile-products-trigger">
                                        Products
                                        <svg class="mobile-menu-arrow" viewBox="0 0 12 7" fill="none">
                                            <path d="m1 1 5 5 5-5" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="mobile-menu-item">
                                    <a href="{{ route('front.about') }}">About us</a>
                                </div>
                                <div class="mobile-menu-item">
                                    <a href="{{ route('front.joureny') }}">Our Terrapreta Journey</a>
                                </div>
                                <div class="mobile-menu-item">
                                    <a href="{{ route('front.blogs') }}">Blogs</a>
                                </div>
                                <div class="mobile-menu-item">
                                    <a href="{{ route('front.career') }}">Career</a>
                                </div>
                                <div class="mobile-menu-item">
                                    <a href="{{ route('front.contact') }}">Contact Us</a>
                                </div>

                                <div class="mobile-lang-controls">
                                    <div class="lang-select">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M21 12C21 16.9705 16.9705 21 12 21M21 12C21 7.02943 16.9705 3 12 3M21 12H3M12 21C7.02943 21 3 16.9705 3 12M12 21C14.227 18.7274 15.6 15.433 15.6 11.9999C15.6 8.56673 14.227 5.27256 12 3M12 21C9.77307 18.7274 8.4 15.433 8.4 11.9999C8.4 8.56673 9.77307 5.27256 12 3M12 3C7.02943 3 3 7.02943 3 12"
                                                    stroke="#333333" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <!--<select>-->
                                        <!--    <option selected>Select Language</option>-->
                                        <!--    <option>English</option>-->
                                        <!--    <option>हिन्दी</option>-->
                                        <!--    <option>العربية</option>-->
                                        <!--</select>-->
                                        <div id="google_translate_element_mobile"></div>
                                         <!--this is  for language translater use for workinng both mobile-->
                                        <div id="google_translate_master" style="display:none;"></div>

                                    </div>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#staticBackdropRequest" class="comman_btn btn">Request a Quote</a>
                                </div>
                            </div>

                            <!-- Categories Menu Level -->
                            <div class="mobile-menu-level" id="mobileCategoriesMenu">
                                <button class="mobile-back-button" id="mobileBackToMain">
                                    <i class="fas fa-arrow-left"></i>
                                    Back
                                </button>
                                <h6 class="mobile-category-title">Product Categories</h6>

                                @foreach ($categories as $category)    
                                    <div class="mobile-menu-item">
                                        <a href="#" class="category-trigger" data-mobile-target="mobile-{{ $category->title }}-Menu">
                                            {{ $category->title }}
                                            <svg class="mobile-menu-arrow" viewBox="0 0 12 7" fill="none">
                                                <path d="m1 1 5 5 5-5" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            @foreach ($categories as $category)
                                <div class="mobile-menu-level" id="mobile-{{ $category->title }}-Menu">
                                    <button class="mobile-back-button mobile-back-to-categories">
                                        <i class="fas fa-arrow-left"></i>
                                        Back
                                    </button>
                                    <h6 class="mobile-category-title">{{ $category->title }}</h6>
                                    @forelse ($category->products as $product)

                                        <div class="mobile-menu-item mobile-product-item">
                                            <a href="{{ route('front.product.deatils', ['product_url' => $product->product_url]) }}">
                                                {{ $product->product_name }}
                                            </a>
                                        </div>
                
                                    @empty
                                        <li><em>No products</em></li>
                                    @endforelse
                                    
                                </div>
                            @endforeach

                        </div>

                        <!-- Desktop controls (shown only on larger screens) -->
                        <div class="d-none d-lg-flex align-items-center">
                            <div class="lang-select">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 12C21 16.9705 16.9705 21 12 21M21 12C21 7.02943 16.9705 3 12 3M21 12H3M12 21C7.02943 21 3 16.9705 3 12M12 21C14.227 18.7274 15.6 15.433 15.6 11.9999C15.6 8.56673 14.227 5.27256 12 3M12 21C9.77307 18.7274 8.4 15.433 8.4 11.9999C8.4 8.56673 9.77307 5.27256 12 3M12 3C7.02943 3 3 7.02943 3 12"
                                            stroke="#333333" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <!--<select>-->
                                <!--    <option selected>Select Language</option>-->
                                <!--    <option>English</option>-->
                                <!--    <option>हिन्दी</option>-->
                                <!--    <option>العربية</option>-->
                                <!--</select>-->
                                
                                <div id="google_translate_element"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
                                        <path d="M11 1L6.26923 5.87978C6.2347 5.91773 6.19299 5.94798 6.14669 5.96865C6.10038 5.98933 6.05046 6 6 6C5.94954 6 5.89962 5.98933 5.85331 5.96865C5.80701 5.94798 5.7653 5.91773 5.73077 5.87978L1 1" stroke="#333333" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                
                            </div>
                           <span>
                                <a href="javascript:void(0);" class="comman_btn btn" data-bs-toggle="modal" data-bs-target="#staticBackdropRequest">Request a Quote</a>
                           </span>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </header>
    
     <div class="modal fade" id="staticBackdropRequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Request a Quote</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal_form career_form_wrapper mt-0">
                        <form id="requestForm" action="{{ route('request_quate') }}" method="post">
                            @csrf 
                            <div class="row"> 
                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name" id="full_name_request_quate" placeholder=""
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" maxlength="70">
                                        <label class="fw-normal"  for="full_name_request_quate">Full Name* :</label>
                                    </div>
                                    <small id="full_name_request_quate_error" class="text-danger" style="display:none;">Please enter your name.</small>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="company" id="company_request_quate" placeholder="">
                                        <label class="fw-normal" for="company_request_quate">Company Name* :</label>
                                    </div>
                                    <small id="company_request_quate_error" class="text-danger" style="display:none;">Please enter Company name.</small>
                                </div>
                                
                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">

                                        <select name="category" id="category_select_request_quate" aria-label="Default select example">
                                            <option value="" selected disabled hidden>Select Category*</option>
                                            @foreach ($categories as $categories)
                                                <option value="{{ $categories->title }}">{{ $categories->title }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                    <small id="category_select_request_quate_error" class="text-danger" style="display:none;"> Please select a category.</small>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="number" name="contact" class="form-control" id="contact_number_request_quate" placeholder=""
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" maxlength="12" minlength="10">
                                        <label class="fw-normal" for="contact_number_request_quate">Contact Number* :</label>
                                    </div>
                                    <small id="contact_number_request_quate_error" class="text-danger" style="display:none;">Please enter a valid contact number.</small>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="email" class="form-control" id="email_address_request_quate" placeholder="">
                                        <label class="fw-normal" for="email_address_request_quate">Email Address* :</label>
                                    </div>
                                    <small id="email_address_request_quate_error" class="text-danger" style="display:none;">Please enter a valid email.</small>
                                </div>

                                

                                <div class="col-lg-12 mb-4">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="message" id="message_request_quate" placeholder=""></textarea>
                                        <label class="fw-normal" for="message">Message :</label>
                                    </div>
                                    <small id="message_request_quate_error" class="text-danger" style="display:none;">Please enter a message.</small>
                                </div>
 
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <img id="captcha-image-request-quate" src="{{ route('captcha.image') }}" alt="CAPTCHA Image" style="border: 1px solid #ccc; height: 40px;">
                                    </div>
                                    <div class="col-auto">
                                         <svg id="reload-button-request-quate" style="cursor: pointer;" width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.539 9.54947C19.539 4.46972 15.5667 0.755859 10.4869 0.755859C5.40715 0.755859 1.34335 4.81966 1.34335 9.89941C1.34335 14.9792 5.40715 19.043 10.4869 19.043C12.9252 19.043 14.9571 18.027 16.5826 16.6047" stroke="#333" stroke-miterlimit="10" stroke-linecap="round"></path>
                                        <path d="M21.5833 5.86837L19.589 9.66244L15.4799 8.32953" stroke="#333" stroke-miterlimit="10" stroke-linecap="round"></path>
                                    </svg>
                                    </div>
                                    <div class="col-auto mt-3 mt-md-0">
                                        <input class="form-control" type="text" id="custom_captcha_request_quate" placeholder="Enter captcha" autocomplete="off">
                                    </div>
                                    <small id="custom_captcha_request_quate_error" class="text-danger" style="display:none;">Please verify captcha.</small>
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
    
    <script>
        // Complete 3-level mobile menu
        document.addEventListener('DOMContentLoaded', function() {
            // Only run mobile menu logic if we're on a mobile device
            if (window.innerWidth < 992) {
                initializeMobileMenu();
            }
            
            // Re-initialize mobile menu on resize
            window.addEventListener('resize', function() {
                if (window.innerWidth < 992) {
                    initializeMobileMenu();
                }
            });
            
            function initializeMobileMenu() {
                // Show categories menu when Products clicked
                const productsTriggger = document.querySelector('.mobile-products-trigger');
                if (productsTriggger) {
                    productsTriggger.addEventListener('click', function(e) {
                        e.preventDefault();
                        showMobileMenu('mobileCategoriesMenu');
                    });
                }
                
                // Back to main menu
                const backToMainBtn = document.getElementById('mobileBackToMain');
                if (backToMainBtn) {
                    backToMainBtn.addEventListener('click', function() {
                        showMobileMenu('mobileMainMenu');
                    });
                }
                
                // Category links - show specific product menu
                document.querySelectorAll('.category-trigger').forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const targetMenu = this.getAttribute('data-mobile-target');
                        showMobileMenu(targetMenu);
                    });
                });
                
                // All back to categories buttons
                document.querySelectorAll('.mobile-back-to-categories').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        showMobileMenu('mobileCategoriesMenu');
                    });
                });
                
                function showMobileMenu(menuId) {
                    // Remove active class from all mobile menus
                    document.querySelectorAll('.mobile-menu-level').forEach(menu => menu.classList.remove('active'));
                    
                    // Show the requested mobile menu
                    const targetMenu = document.getElementById(menuId);
                    if (targetMenu) {
                        targetMenu.classList.add('active');
                    }
                }
                
                // Close offcanvas when clicking on a mobile product link
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.mobile-product-item a')) {
                        // Close the offcanvas
                        const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasNavbar'));
                        if (offcanvas) {
                            offcanvas.hide();
                        }
                        
                        // Reset to main menu when closed
                        setTimeout(() => {
                            showMobileMenu('mobileMainMenu');
                        }, 300);
                    }
                });
                
                // Reset to main menu when offcanvas is hidden
                const offcanvasElement = document.getElementById('offcanvasNavbar');
                if (offcanvasElement) {
                    offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
                        showMobileMenu('mobileMainMenu');
                    });
                }
            }
        });
    </script>
    
<script type="text/javascript">
    function googleTranslateElementInit() {
        // Create the widget in hidden container
        new google.translate.TranslateElement(
            {
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
            },
            'google_translate_master'
        );

        // Wait until Google creates the select box
        setTimeout(function () {
            let widget = document.querySelector('#google_translate_master select');
            if (widget) {
                // Clone for Desktop
                let desktopClone = widget.cloneNode(true);
                document.querySelector('#google_translate_element').appendChild(desktopClone);

                // Clone for Mobile
                let mobileClone = widget.cloneNode(true);
                document.querySelector('#google_translate_element_mobile').appendChild(mobileClone);

                // Sync changes (when user selects language)
                function syncLanguageSelect(e) {
                    let val = e.target.value;
                    // Set value on original widget
                    widget.value = val;
                    widget.dispatchEvent(new Event('change'));
                    // Sync other clone
                    if (e.target !== desktopClone) desktopClone.value = val;
                    if (e.target !== mobileClone) mobileClone.value = val;
                }

                desktopClone.addEventListener('change', syncLanguageSelect);
                mobileClone.addEventListener('change', syncLanguageSelect);
            }
        }, 1500); // give time for Google Translate to load
    }
</script>

<!-- Google Translate Script -->
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<style>
    #google_translate_element
    {
            width: 115px;
           overflow: hidden;
    }
</style>
    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
       integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#reload-button-request-quate').click(function() {
        // Add a random query string to prevent caching
        let timestamp = new Date().getTime();
        $('#captcha-image-request-quate').attr('src', '{{ route("captcha.image") }}?t=' + timestamp);
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('requestForm'); 
    const submitButton = form.querySelector('button[type="submit"]');

    const fullName = document.getElementById('full_name_request_quate');
    const company = document.getElementById('company_request_quate');
    const contactNumber = document.getElementById('contact_number_request_quate');
    const emailAddress = document.getElementById('email_address_request_quate');
    const message = document.getElementById('message_request_quate');
    const customCaptcha = document.getElementById('custom_captcha_request_quate');
    const categorySelect = document.getElementById('category_select_request_quate');

    // Error spans
    const fullNameError = document.getElementById('full_name_request_quate_error');
    const companyError = document.getElementById('company_request_quate_error');
    const contactNumberError = document.getElementById('contact_number_request_quate_error');
    const emailAddressError = document.getElementById('email_address_request_quate_error');
    const messageError = document.getElementById('message_request_quate_error');
    const customCaptchaError = document.getElementById('custom_captcha_request_quate_error');
    const categorySelectError = document.getElementById('category_select_request_quate_error');

    function isValidEmail(email) {
        const re = /^[a-zA-Z0-9._%+-]{2,64}@[a-zA-Z0-9.-]+\.[A-Za-z]{2,10}$/;
        return re.test(email);
    } 

    // Full Name validation
    fullName.addEventListener('input', function() {
        const value = fullName.value.trim();
        const valid = /^[A-Za-z\s]+$/.test(value);
        fullNameError.style.display = (value === '' || !valid) ? 'block' : 'none';
    });

    // Company validation
    company.addEventListener('input', function() {
        const value = company.value.trim();
        // const valid = /^[A-Za-z\s]+$/.test(value);
        companyError.style.display = (value === '') ? 'block' : 'none';
    });

    // Category select validation
    categorySelect.addEventListener('change', function () {
        categorySelectError.style.display = categorySelect.value.trim() === '' ? 'block' : 'none';
    });

    // Contact number validation (exactly 10 digits)
    contactNumber.addEventListener('input', function() {
        const value = contactNumber.value.trim();
        const valid = /^\d{10}$/.test(value);
        contactNumberError.style.display = valid ? 'none' : 'block';
    });

    // Email validation
    emailAddress.addEventListener('input', function() {
        const value = emailAddress.value.trim();
        emailAddressError.style.display = !isValidEmail(value) ? 'block' : 'none';
    });

    // Captcha validation
    customCaptcha.addEventListener('input', () => {
        const value = customCaptcha.value.trim();
        if (value === '') {
            customCaptchaError.style.display = 'block';
            customCaptchaError.textContent = "Please enter the captcha.";
        } else if (!/^\d{4}$/.test(value)) {
            customCaptchaError.style.display = 'block';
            customCaptchaError.textContent = "Captcha must be 4 digits.";
        } else {
            customCaptchaError.style.display = 'none';
        }
    });

    // Form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true; 

        // Full name
        if (fullName.value.trim() === '' || !/^[A-Za-z\s]+$/.test(fullName.value.trim())) { 
            fullNameError.style.display = 'block'; 
            isValid = false; 
        }

        // Company
        if (company.value.trim() === '') { 
            companyError.style.display = 'block'; 
            isValid = false; 
        } 

        // Contact
        if (contactNumber.value.trim() === '' || !/^\d{10}$/.test(contactNumber.value.trim())) { 
            contactNumberError.style.display = 'block'; 
            isValid = false; 
        }

        // Email
        if (!isValidEmail(emailAddress.value.trim())) { 
            emailAddressError.style.display = 'block'; 
            isValid = false; 
        }

        // Captcha
        if (!/^\d{4}$/.test(customCaptcha.value.trim())) {
            customCaptchaError.style.display = 'block'; 
            isValid = false;
        }

        // Category
        if (categorySelect.value.trim() === '') {
            categorySelectError.style.display = 'block';
            isValid = false;
        }

        if (!isValid) return;

        // Captcha Ajax Verify
        submitButton.textContent = 'Verifying captcha...';
        submitButton.disabled = true;

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