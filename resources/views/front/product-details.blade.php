@include('layouts.frontheader')

@php
    $detailImages = collect($product->detail_images ?? [])
        ->filter()
        ->map(fn ($image) => asset('public/images/product_detail_images/' . $image));

    if ($detailImages->isEmpty() && $product->list_image) {
        $detailImages = collect([asset('public/images/product_list_images/' . $product->list_image)]);
    }

    if ($detailImages->isEmpty()) {
        $detailImages = collect([asset('public/front/assets/images/Background+Border.webp')]);
    }

    $mainImage = $detailImages->first();
    $technicalSpecifications = $product->technicalSpecifications ?? collect();
    $visibleFeatures = $technicalSpecifications->where('is_show_on_list', 1)->take(4);

    if ($visibleFeatures->isEmpty()) {
        $visibleFeatures = $technicalSpecifications->take(4);
    }

    $breadcrumSchema = [
        '@context' => 'https://schema.org/',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => $product->category->title ?? '',
                'item' => $product->category->category_url ? route('front.category.details', $product->category->category_url) : '',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $product->subCategory->title ?? '',
                'item' => $product->subCategory->sub_category_url ? route('front.product.list', ['cat_url' => $product->category->category_url, 'sub_cat_url' => $product->subCategory->sub_category_url]) : '',
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $product->product_name ?? '',
                'item' => $product->subCategory->sub_category_url ? route('front.product.details', $product->product_url) : '',
            ]
        ]
    ];

    $productSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->product_name ?? '',
        'image' => $product->list_image ? asset('public/images/product_list_images/' . $product->list_image) : asset('public/front/assets/images/Background+Border.webp'),
        'description' => $product->description ? strip_tags($product->description) : '',
    ];

@endphp

<section class="py_80">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('front.home') }}">Home</a>
            @if($product->category)
                <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg></span>
                <a href="{{ route('front.category.details', $product->category->category_url) }}">{{ $product->category->title }}</a>
            @endif
            @if($product->subCategory)
                <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg></span>
                <a href="javascript:void(0);">{{ $product->subCategory->title }}</a>
            @endif
        </div>
        <!-- <div class="row xl-gx-5"> -->

        <div class="row gx-md-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="image-gallery">
                    <div class="main-image-container" id="zoomContainer">
                        <img src="{{ $mainImage }}" id="mainImage" alt="{{ $product->product_name }}">
                    </div>

                    @if($detailImages->count() > 1)
                        <div class="thumbnail-row">
                            @foreach($detailImages as $image)
                                <div class="thumb {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ $image }}" alt="{{ $product->product_name }} image {{ $loop->iteration }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-7">
                <h2 class="product-title">{{ $product->product_name }}</h2>
                @if($product->product_modal)
                    <div class="product-sku">{{ $product->product_modal }}</div>
                @endif

                @if($product->description)
                    <div class="product-desc">{!! $product->description !!}</div>
                @endif

                <div class="pb_40">
                    <a href="javascript:void(0);" class="com_btn product-enquire-button" data-product-name="{{ $product->product_name }}">
                        Enquire Now<span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="11" viewBox="0 0 24 11" fill="none">
                            <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg></span>
                    </a>
                    {{-- @if($product->datasheet)
                        <a href="{{ route('products.datasheet.download', $product->id) }}" target="_blank" class="com_btn com_btn_b_b">
                            Download Datasheet <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="11" viewBox="0 0 24 11" fill="none">
                                <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg></span>
                        </a>
                    @endif --}}
                </div>

                @if($product->features)
                    <!-- <hr class="dashed-divider"> -->
                    <div class="product-desc">{!! $product->features !!}</div>
                @endif
                <hr class="dashed-divider">
                <div class="bottom-features">
                    <div class="bottom-feature-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_127_2770)">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.76567 1.06971L8.75017 1.81521C8.57125 1.95795 8.3817 2.08682 8.18317 2.20071C8.04947 2.27179 7.90934 2.33005 7.76467 2.37471C7.60117 2.42421 7.43167 2.44971 7.09117 2.50221L5.84617 2.69271C4.86367 2.84271 4.37167 2.91921 3.98617 3.14871C3.64117 3.35121 3.35467 3.63921 3.15067 3.98421C2.92117 4.37421 2.84617 4.86621 2.69467 5.84421L2.50417 7.08922C2.45167 7.42972 2.42617 7.60071 2.37667 7.76421C2.33167 7.90921 2.27367 8.04821 2.20267 8.18121C2.12167 8.33121 2.02117 8.47071 1.81717 8.74821L1.07167 9.76372C0.483667 10.5647 0.189667 10.9652 0.0756675 11.3987C-0.0226183 11.7861 -0.0226183 12.1919 0.0756675 12.5792C0.188167 13.0172 0.483667 13.4192 1.07167 14.2142L1.81717 15.2297C2.02117 15.5072 2.12317 15.6467 2.20267 15.7967C2.27267 15.9307 2.33067 16.0707 2.37667 16.2167C2.42617 16.3787 2.45167 16.5482 2.50417 16.8887L2.69467 18.1337C2.84467 19.1162 2.92117 19.6067 3.15067 19.9937C3.35317 20.3387 3.64117 20.6267 3.98617 20.8292C4.37617 21.0587 4.86817 21.1337 5.84617 21.2852L7.09117 21.4757C7.43167 21.5282 7.60267 21.5552 7.76467 21.6047C7.90967 21.6487 8.04917 21.7067 8.18317 21.7787C8.33317 21.8582 8.47267 21.9587 8.75017 22.1642L9.76567 22.9097C10.5667 23.4977 10.9672 23.7917 11.4007 23.9057C11.7877 24.0062 12.1942 24.0062 12.5812 23.9057C13.0192 23.7917 13.4212 23.4977 14.2162 22.9097L15.2317 22.1642C15.5092 21.9602 15.6487 21.8582 15.7987 21.7787C15.9327 21.7067 16.0722 21.6487 16.2172 21.6047C16.3807 21.5552 16.5502 21.5297 16.8907 21.4757L18.1357 21.2852C19.1182 21.1352 19.6087 21.0602 19.9957 20.8292C20.3407 20.6267 20.6287 20.3387 20.8312 19.9937C21.0607 19.6037 21.1357 19.1117 21.2872 18.1337L21.4777 16.8887C21.5302 16.5482 21.5557 16.3787 21.6052 16.2152C21.6502 16.0702 21.7082 15.9307 21.7792 15.7967C21.8602 15.6467 21.9607 15.5072 22.1647 15.2297L22.9102 14.2142C23.4982 13.4132 23.7922 13.0142 23.9062 12.5792C24.0045 12.1919 24.0045 11.7861 23.9062 11.3987C23.7937 10.9607 23.4982 10.5587 22.9102 9.76372L22.1647 8.74821C22.0219 8.56929 21.8931 8.37974 21.7792 8.18121C21.7081 8.04752 21.6498 7.90739 21.6052 7.76271C21.5456 7.54178 21.503 7.31663 21.4777 7.08922L21.2872 5.84421C21.1372 4.86171 21.0607 4.36971 20.8312 3.98421C20.6266 3.64044 20.3394 3.35324 19.9957 3.14871C19.6057 2.91921 19.1137 2.84421 18.1357 2.69271L16.8907 2.50221C16.6633 2.4769 16.4381 2.43428 16.2172 2.37471C16.0722 2.33095 15.932 2.27265 15.7987 2.20071C15.6001 2.08682 15.4106 1.95795 15.2317 1.81521L14.2162 1.06971C13.4152 0.481714 13.0147 0.187714 12.5812 0.0737143C12.1938 -0.0245714 11.788 -0.0245714 11.4007 0.0737143C10.9627 0.187714 10.5607 0.481714 9.76567 1.06971ZM17.7607 9.18471C17.8475 9.07882 17.9122 8.9566 17.9509 8.82527C17.9897 8.69395 18.0018 8.55618 17.9864 8.42012C17.971 8.28406 17.9285 8.15246 17.8614 8.03311C17.7943 7.91375 17.7039 7.80906 17.5957 7.72521C17.3755 7.55294 17.0967 7.47346 16.8187 7.50372C16.5408 7.53398 16.2856 7.67159 16.1077 7.88721L11.1427 13.9772L8.48767 11.9372C8.27079 11.7607 7.99354 11.6759 7.71502 11.7008C7.43651 11.7257 7.17874 11.8585 6.99667 12.0707C6.90772 12.1748 6.84053 12.2957 6.79908 12.4262C6.75763 12.5567 6.74276 12.6941 6.75535 12.8305C6.76793 12.9668 6.80772 13.0992 6.87235 13.2199C6.93699 13.3406 7.02517 13.4472 7.13167 13.5332L10.6117 16.2482C10.8314 16.427 11.113 16.5115 11.3948 16.4834C11.6767 16.4553 11.936 16.3168 12.1162 16.0982L17.7562 9.16821L17.7607 9.18471Z"
                                    fill="#303281" />
                            </g>
                            <defs>
                                <clipPath id="clip0_127_2770">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        IEC Certified
                    </div>
                    <div class="bottom-feature-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 3V1.75C1.31 1.75 0.75 2.31 0.75 3H2ZM13 3H14.25C14.25 2.31 13.69 1.75 13 1.75V3ZM13 9V7.75C12.6685 7.75 12.3505 7.8817 12.1161 8.11612C11.8817 8.35054 11.75 8.66848 11.75 9H13ZM2 4.25H13V1.75H2V4.25ZM11.75 3V19H14.25V3H11.75ZM3.25 17V3H0.75V17H3.25ZM13 10.25H18V7.75H13V10.25ZM20.75 13V17H23.25V13H20.75ZM14.25 19V9H11.75V19H14.25ZM18.53 19.53C18.3894 19.6705 18.1988 19.7493 18 19.7493C17.8012 19.7493 17.6106 19.6705 17.47 19.53L15.702 21.298C16.3115 21.9074 17.1381 22.2498 18 22.2498C18.8619 22.2498 19.6885 21.9074 20.298 21.298L18.53 19.53ZM17.47 18.47C17.6106 18.3295 17.8012 18.2507 18 18.2507C18.1988 18.2507 18.3894 18.3295 18.53 18.47L20.298 16.702C19.6885 16.0926 18.8619 15.7502 18 15.7502C17.1381 15.7502 16.3115 16.0926 15.702 16.702L17.47 18.47ZM6.53 19.53C6.38937 19.6705 6.19875 19.7493 6 19.7493C5.80125 19.7493 5.61063 19.6705 5.47 19.53L3.702 21.298C4.31149 21.9074 5.13809 22.2498 6 22.2498C6.86191 22.2498 7.68852 21.9074 8.298 21.298L6.53 19.53ZM5.47 18.47C5.61063 18.3295 5.80125 18.2507 6 18.2507C6.19875 18.2507 6.38937 18.3295 6.53 18.47L8.298 16.702C7.68852 16.0926 6.86191 15.7502 6 15.7502C5.13809 15.7502 4.31149 16.0926 3.702 16.702L5.47 18.47ZM18.53 18.47C18.6001 18.5392 18.6557 18.6218 18.6935 18.7128C18.7312 18.8038 18.7505 18.9015 18.75 19H21.25C21.2505 18.5731 21.1667 18.1504 21.0033 17.756C20.8399 17.3616 20.6002 17.0034 20.298 16.702L18.53 18.47ZM18.75 19C18.7505 19.0985 18.7312 19.1962 18.6935 19.2872C18.6557 19.3782 18.6001 19.4608 18.53 19.53L20.298 21.298C20.6002 20.9966 20.8399 20.6384 21.0033 20.244C21.1667 19.8496 21.2505 19.4269 21.25 19H18.75ZM16 17.75H13V20.25H16V17.75ZM17.47 19.53C17.3999 19.4608 17.3443 19.3782 17.3065 19.2872C17.2688 19.1962 17.2495 19.0985 17.25 19H14.75C14.75 19.83 15.068 20.664 15.702 21.298L17.47 19.53ZM17.25 19C17.2495 18.9015 17.2688 18.8038 17.3065 18.7128C17.3443 18.6218 17.3999 18.5392 17.47 18.47L15.702 16.702C15.3998 17.0034 15.1601 17.3616 14.9967 17.756C14.8333 18.1504 14.7495 18.5731 14.75 19H17.25ZM5.47 19.53C5.39989 19.4608 5.34431 19.3782 5.30653 19.2872C5.26876 19.1962 5.24953 19.0985 5.25 19H2.75C2.75 19.83 3.068 20.664 3.702 21.298L5.47 19.53ZM5.25 19C5.24953 18.9015 5.26876 18.8038 5.30653 18.7128C5.34431 18.6218 5.39989 18.5392 5.47 18.47L3.702 16.702C3.39976 17.0034 3.16007 17.3616 2.99669 17.756C2.83332 18.1504 2.74948 18.5731 2.75 19H5.25ZM13 17.75H8V20.25H13V17.75ZM6.53 18.47C6.60011 18.5392 6.65569 18.6218 6.69347 18.7128C6.73124 18.8038 6.75047 18.9015 6.75 19H9.25C9.25 18.17 8.932 17.336 8.298 16.702L6.53 18.47ZM6.75 19C6.75047 19.0985 6.73124 19.1962 6.69347 19.2872C6.65569 19.3782 6.60011 19.4608 6.53 19.53L8.298 21.298C8.60024 20.9966 8.83993 20.6384 9.00331 20.244C9.16668 19.8496 9.25052 19.4269 9.25 19H6.75ZM20.75 17C20.75 17.1989 20.671 17.3897 20.5303 17.5303C20.3897 17.671 20.1989 17.75 20 17.75V20.25C20.862 20.25 21.6886 19.9076 22.2981 19.2981C22.9076 18.6886 23.25 17.862 23.25 17H20.75ZM18 10.25C18.7293 10.25 19.4288 10.5397 19.9445 11.0555C20.4603 11.5712 20.75 12.2707 20.75 13H23.25C23.25 10.1 20.9 7.75 18 7.75V10.25ZM0.75 17C0.75 17.862 1.09241 18.6886 1.7019 19.2981C2.3114 19.9076 3.13805 20.25 4 20.25V17.75C3.80109 17.75 3.61032 17.671 3.46967 17.5303C3.32902 17.3897 3.25 17.1989 3.25 17H0.75Z"
                                fill="#303281" />
                            <path d="M2 8H5M2 12H7" stroke="#303281" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Fast Delivery
                    </div>
                    <div class="bottom-feature-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.76367 19.4612V17.8452H7.78567L5.19867 9.38022C4.76134 9.16889 4.41301 8.86622 4.15367 8.47222C3.89367 8.07889 3.76367 7.62655 3.76367 7.11522C3.76367 6.42255 4.00734 5.83255 4.49467 5.34522C4.98201 4.85789 5.57201 4.61455 6.26467 4.61522C6.87601 4.61522 7.40067 4.80255 7.83867 5.17722C8.27667 5.55189 8.57001 6.03122 8.71867 6.61522H12.3787V5.11522C12.3787 4.97255 12.4267 4.85355 12.5227 4.75822C12.6187 4.66289 12.7377 4.61522 12.8797 4.61522C12.991 4.61522 13.0887 4.64855 13.1727 4.71522C13.2567 4.78189 13.31 4.86889 13.3327 4.97622V5.24622L15.1487 3.56822C15.286 3.43089 15.4393 3.34789 15.6087 3.31922C15.7793 3.29055 15.9453 3.31989 16.1067 3.40722L19.8907 5.16822C20.014 5.23022 20.1067 5.31855 20.1687 5.43322C20.2307 5.54789 20.233 5.66455 20.1757 5.78322C20.1143 5.90655 20.0263 5.98455 19.9117 6.01722C19.797 6.04989 19.6797 6.03755 19.5597 5.98022L15.7677 4.21422L13.3797 6.41422V7.81422L15.7677 9.96422L19.5597 8.19922C19.679 8.14189 19.797 8.13055 19.9137 8.16522C20.0297 8.19922 20.1167 8.27589 20.1747 8.39522C20.236 8.51855 20.2347 8.63655 20.1707 8.74922C20.1067 8.86255 20.0133 8.94989 19.8907 9.01122L16.1057 10.7842C15.9437 10.8709 15.778 10.8999 15.6087 10.8712C15.4387 10.8426 15.285 10.7596 15.1477 10.6222L13.3327 8.98422V9.25322C13.3093 9.35322 13.2557 9.43855 13.1717 9.50922C13.0877 9.57989 12.99 9.61522 12.8787 9.61522C12.736 9.61522 12.617 9.56722 12.5217 9.47122C12.4263 9.37589 12.3787 9.25722 12.3787 9.11522V7.61522H8.71667C8.66667 7.83789 8.58367 8.05889 8.46767 8.27822C8.35167 8.49755 8.22434 8.68022 8.08567 8.82622L12.9327 17.8462H16.7627V19.4602L4.76367 19.4612ZM7.32067 8.17322C7.61534 7.87922 7.76267 7.52622 7.76267 7.11422C7.76267 6.70222 7.61534 6.34955 7.32067 6.05622C7.02601 5.76289 6.67334 5.61555 6.26267 5.61422C5.85201 5.61289 5.49867 5.76022 5.20267 6.05622C4.90934 6.35022 4.76267 6.70289 4.76267 7.11422C4.76267 7.52622 4.90934 7.87922 5.20267 8.17322C5.49734 8.46789 5.85067 8.61522 6.26267 8.61522C6.67467 8.61522 7.02734 8.46789 7.32067 8.17322Z"
                                fill="#303281" />
                        </svg>
                        Made in India
                    </div>
                    <div class="bottom-feature-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 22.5008C19.25 22.5008 22 21.0008 22 15.5008M3.4015 17.8923C2.5595 17.6818 2 16.9133 2 16.0458V12.9568C2 12.0888 2.5595 11.3198 3.4015 11.1093C4.2145 10.9058 5.2825 10.6773 6.3325 10.5673C7.0515 10.4918 7.6845 10.9133 7.804 11.6258C7.909 12.2478 8 13.1713 8 14.5008C8 15.8308 7.9085 16.7543 7.804 17.3758C7.684 18.0883 7.0515 18.5098 6.3325 18.4348C5.2825 18.3248 4.2145 18.0958 3.4015 17.8923Z"
                                stroke="#303281" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M20.5985 17.8923C21.4405 17.6818 22 16.9133 22 16.0458V12.9568C22 12.0888 21.4405 11.3198 20.5985 11.1093C19.7855 10.9058 18.7175 10.6773 17.6675 10.5673C16.9485 10.4918 16.3155 10.9133 16.196 11.6258C16.091 12.2478 16 13.1713 16 14.5008C16 15.8308 16.0915 16.7543 16.196 17.3758C16.316 18.0883 16.9485 18.5098 17.6675 18.4348C18.7175 18.3248 19.7855 18.0958 20.5985 17.8923Z"
                                stroke="#303281" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M22 12.9555V11.5C22 5.977 17.523 1.5 12 1.5C6.477 1.5 2 5.977 2 11.5V12.9555M18.978 10.7565C18.693 7.255 15.678 4.5 12 4.5C8.322 4.5 5.307 7.255 5.022 10.7565"
                                stroke="#303281" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Warranty Support
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@if(isset($technicalSpecifications) && $technicalSpecifications->isNotEmpty())
@php
    $chunkSize = 7;
    $chunks = $technicalSpecifications->chunk($chunkSize);
    $tableCount = $chunks->count();

    $colClass = $tableCount == 1 ? 'col-md-12' : 'col-md-6';
@endphp
<section class="py_80">
    <div class="container">
        <div class="text-center mb_40">
            <h2 class="title_44">Technical Specifications</h2>
            <p>
                Each product is designed to international standards with rigorous quality control at every stage.
            </p>
        </div>

        <div class="row g-4">
            @foreach($chunks as $index => $chunk)
                <div class="{{ $colClass }}">
                    <table class="table-dark">
                        <thead>
                            <tr>
                                <th>Parameters</th>
                                <th>Specifications</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chunk as $specification)
                                <tr>
                                    <td>{{ $specification->parameter }}</td>
                                    <td>{{ $specification->specifications }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<div id="product-enquiry-modal" class="product-modal">
    <div class="product-modal-overlay" data-close-modal></div>
    <div class="product-modal-content">
        <button type="button" class="product-modal-close" data-close-modal>&times;</button>
        <div class="product-modal-body d-block">
            <div class="modal-form-header w-100 mb-4">
                <h2 class="title_44 mb-2">Product Enquiry</h2>
                <p>Please provide your details and we will contact you about this product.</p>
            </div>
            <form id="product-enquiry-form" action="{{ route('contact.submit') }}" method="POST" class="quote-form w-100">
                @csrf
                <input type="hidden" name="inquiry_type" value="popup">
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Product</label>
                        <input type="text" name="product" id="popup-product-name" readonly>
                    </div>
                    <div class="form-group">
                        <label>Country <span class="text-danger">*</span></label>
                        <select name="country">
                            <option value="" disabled selected>Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-chevron-down select-icon"></i>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" placeholder="John Doe">
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" name="company" placeholder="Company name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" placeholder="john@company.com">
                    </div>
                    <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" placeholder="+91 98765 43210">
                    </div>
                </div>

                <div class="form-group">
                    <label>Requirement Details</label>
                    <textarea name="requirement_details" placeholder="Describe your project requirements, product types, quantities, and any specifications..."></textarea>
                </div>
                <div class="product-modal-submit">
                    <button type="submit" class="com_btn" id="productSubmitBtn">Send Enquiry</button>
                </div>
                <div id="popup-enquiry-message" class="text-success mt-3" style="display:none;"></div>
            </form>
        </div>
    </div>
</div>

@include('layouts.form')

<style>
.product-modal { display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center; }
.product-modal.active { display:flex; }
.product-modal-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.6); }
.product-modal-content { position:relative; background:#fff; border-radius:0px; max-width:900px; width:100%; max-height:90vh; overflow-y:auto; padding:30px; z-index:1; }
.product-modal-close { position:absolute; top:18px; right:18px; background:none; border:none; color:#020844; font-size:32px; cursor:pointer; }
.product-modal-body { display:flex; flex-wrap:wrap; gap:30px; }
.product-modal-body.d-block { display:block !important; }
.product-modal-image img { width:100%; max-width:360px; border-radius:16px; object-fit:contain; }
.product-modal-details { flex:1; min-width:280px; }
.product-modal-specs .spec-row { display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #E6E9F9; }
.product-modal-actions { display:flex; gap:12px; flex-wrap:wrap; margin-top:24px; }
.product-modal-submit { margin-top:16px; }
#product-enquiry-form .form-group { position: relative; }
#product-enquiry-form .select-icon { position: absolute; right: 20px; bottom: 18px; pointer-events: none; color: #020844; }
#product-enquiry-form select { appearance: none; -webkit-appearance: none; -moz-appearance: none; }
@media(max-width:768px){ .product-modal-body { flex-direction:column; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Open product enquiry modal
    $(document).on('click', '.product-enquire-button', function (e) {
        e.preventDefault();
        var productName = $(this).data('product-name');
        $('#popup-product-name').val(productName);
        $('#product-enquiry-modal').addClass('active');
    });

    // Close modals on overlay or close button click
    $(document).on('click', '[data-close-modal]', function () {
        $('.product-modal').removeClass('active');
    });
});
</script>

<script type="application/ld+json">
    {!! json_encode($productSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
   {!! json_encode($breadcrumSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@include('layouts.frontfooter')
