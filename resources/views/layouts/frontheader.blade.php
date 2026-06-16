<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $metaTitle ?? 'Blitz - Control the Current' }}</title>
    <meta name="description" content="{{ $metaDescription ?? '' }}"> 
    {{-- ADD ROBOTS LINK HERE --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    <!--OG Tags-->
    <meta property="og:site_name" content="Blitz">
    <meta property="og:title" content="{{ $metaTitle ?? 'Blitz - Control the Current' }}" />
    <meta property="og:description" content="{{ $metaDescription ?? '' }}" />
    <meta property="og:image" content="">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!--Twitter X Card Tags-->
    <meta name="twitter:card" content="Blitz">
    <meta name="twitter:title" content="{{ $metaTitle ?? 'Blitz - Control the Current' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? '' }}">
    <meta name="twitter:image" content="">


    <link rel="icon" href="{{ asset('public/front/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rufina:wght@400;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="{{ asset('public/front/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">

</head>

<body>
    <!-- Global Custom Cursor -->
    <!-- <div class="custom-cursor" id="customCursor">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="4" fill="white"/>
            <circle cx="20" cy="4" r="3" fill="white"/>
            <circle cx="20" cy="36" r="3" fill="white"/>
            <circle cx="4" cy="20" r="3" fill="white"/>
            <circle cx="36" cy="20" r="3" fill="white"/>
        </svg>
    </div> -->

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route("front.home") }}">
                <img src="{{ asset('public/front/assets/images/logo.svg') }}" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Mobile Offcanvas Header -->
                <div class="mobile-offcanvas-header d-flex justify-content-between align-items-center d-xl-none">
                    <a class="navbar-brand m-0" href="{{ route('front.home') }}">
                        <img src="{{ asset('public/front/assets/images/logo.svg') }}" alt="logo" style="width:120px;">
                    </a>
                    <button type="button" class="btn-close mobile-menu-close" aria-label="Close"></button>
                </div>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.about') }}">About</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0);">
                            Products
                            <span class="submenu-toggle d-flex align-items-center justify-content-end" style="width: 30px; height: 30px;">
                                <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="dropdown-icon">
                                    <path d="M0.5 0.5L5.5 5.5L10.5 0.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>


                          <!-- @if(isset($categoriesHF) && count($categoriesHF) > 0)
                                @foreach($categoriesHF as $category)
                                    <li><a href="{{ route('front.category.details', $category->category_url) }}">{{ $category->title }}</a></li>
                                @endforeach
                            @else
                                <li><a href="#">No categories available</a></li>
                            @endif -->

                        <!-- Premium Dropdown Menu -->
                        <ul class="dropdown-menu">
                            @if(isset($categoriesHF) && $categoriesHF->count() > 0)
                                @foreach($categoriesHF as $category)
                                    <li class="dropdown-submenu position-relative">
                                        @if($category->category_url == 'solar-accessories')
                                            <a class="dropdown-item d-flex justify-content-between align-items-center gap-3" href="javascript:void(0);">
                                        @else
                                            <a class="dropdown-item d-flex justify-content-between align-items-center gap-3" href="{{ $category->category_url ? route('front.category.details', $category->category_url) : '#' }}">
                                        @endif
                                            {{ $category->title }}
                                            @if($category->subCategories->count() > 0 || $category->products->count() > 0)
                                                <span class="submenu-toggle d-flex align-items-center justify-content-end" style="width: 30px; height: 30px;">
                                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </span>
                                            @endif
                                        </a>
                                        @if($category->subCategories->count() > 0)
                                            <ul class="dropdown-menu submenu">
                                                @foreach($category->subCategories as $subCategory)
                                                    <li class="dropdown-submenu position-relative">
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center gap-3" href="{{ route('front.product.list', ['cat_url' => $category->category_url, 'sub_cat_url' => $subCategory->sub_category_url]) }}">
                                                            {{ $subCategory->title }}
                                                            @if($subCategory->products->count() > 0)
                                                                <span class="submenu-toggle d-flex align-items-center justify-content-end" style="width: 30px; height: 30px;">
                                                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                </span>
                                                            @endif
                                                        </a>
                                                        @if($subCategory->products->count() > 0)
                                                            <ul class="dropdown-menu submenu">
                                                                @foreach($subCategory->products as $product)
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('front.product.details', $product->product_url) }}">{{ $product->product_name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif($category->products->count() > 0)
                                            <ul class="dropdown-menu submenu">
                                                @foreach($category->products as $product)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('front.product.details', $product->product_url) }}">{{ $product->product_name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li><a class="dropdown-item" href="#">No categories available</a></li>
                            @endif
                        </ul>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#">Catalogue</a></li> --}}
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route("front.blogs") }}">Blog</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route("front.contact") }}">Contact</a></li>
                </ul>
                <div class="d-flex gap-3 justify-content-center mt-4 mt-lg-0">
                    <a href="{{ asset('public/brochure.pdf') }}" target="_blank" class="com_btn com_btn_b_b">Download Catalogue</a>

                    <a href="#getInTouchForm" class="com_btn ">Request Quote</a>
                </div>
            </div>
        </div>
    </nav>

    <main  data-scroll-container>
