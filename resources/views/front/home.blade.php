@include('layouts.frontheader')


<section>
    <div class="hero-slider">
        @forelse($banners as $banner)
            <div class="hero-slide hero-slide-{{ $loop->iteration }}" style="--desktop-bg: url('{{ $banner->image ? asset('public/admin/banners/' . $banner->image) : asset('public/front/assets/images/hero-banner-1.png') }}'); --mobile-bg: url('{{ $banner->mobile_image ? asset('public/admin/banners/' . $banner->mobile_image) : ($banner->image ? asset('public/admin/banners/' . $banner->image) : asset('public/front/assets/images/hero-banner-1.png')) }}');">
                <div class="container">
                    <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                        <p class="hero-title">{{ $banner->title ?? 'Protect the Circuit' }}</p>
                        <p class="hero-subtitle">{{ $banner->description ?? '' }}</p>
                        <div class="hero-buttons">
                            <a href="#" class="com_btn com_btn_w">
                                Explore {{ optional($banner->category)->short_form ?? optional($banner->category)->title ?? 'Products' }} <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="11" viewBox="0 0 24 11" fill="none">
                                        <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </a>
                            <a href="{{ route('front.contact') }}" class="com_btn com_btn_w_b">Request Quote</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="hero-slide hero-slide-1" style="--desktop-bg: url('{{ asset('public/front/assets/images/hero-banner-1.png') }}'); --mobile-bg: url('{{ asset('public/front/assets/images/hero-banner-1.png') }}');">
                <div class="container">
                    <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                        <p class="hero-title">Control the Current.<br>Protect the Circuit</p>
                        <p class="hero-subtitle">Designed for the toughest applications, Blitz MCB miniature circuit breaker delivers fast, precise overcurrent protection, keeping your systems safe</p>
                        <div class="hero-buttons">
                            <a href="#" class="com_btn com_btn_w">
                                Explore MCBs <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="11" viewBox="0 0 24 11" fill="none">
                                        <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </a>
                            <a href="{{ route('front.contact') }}" class="com_btn com_btn_w_b">Request Quote</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

</section>


<section  class="home_about py_40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <p class="title_20 line_center" >ABOUT BLITZ ELECTRICAL</p>
                <h1 class="title_44 mb_40">Trusted Provider of Electrical Protection & Safety Devices</h1>
                <p class="home_about_para">Blitz is a globally trusted brand dedicated to advancing surge protection technologies for modern electrical and industrial systems. Specialising in the design and manufacturing of high-performance AC and DC Surge Protection Devices (SPDs), Miniature Circuit Breakers (MCBs), fuse terminals, and fuse links, every product is engineered to operate flawlessly in the world's most demanding environments.</p>
                <p class="home_about_para">Built in compliance with global standards such as IEC, our solutions ensure operational continuity, equipment longevity, and the highest level of safety, reflecting excellence in reliability, durability, and innovation.</p>

                <a href="#" class="com_btn mt_40">
                    Learn More About Us <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="11" viewBox="0 0 24 11" fill="none">
                            <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white"
                                stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></span>
                </a>
            </div>
        </div>
    </div>
</section>

<section  class="Product_rang py_40 sticky-product-section" id="productScrollSection">
    <div class="sticky-product-wrapper">
        <div class="container">
            <p class="title_20 line_left">Product Range</p>
            <h1 class="title_44">One Brand. Every Protection Need Covered </h1>
            <p class="mb-0">Residential or industrial, Blitz protection devices are designed to perform in demanding electrical environments. </p>
            <div class="row pt_40">
                @if(isset($categories) && $categories->count())
                    @foreach($categories as $category)
                        <div class="col-md-3 product-scroll-card">
                            <div class="mcb-card">
                                <img src="{{ $category->list_img ? asset('public/images/category_list/' . $category->list_img) : asset('public/front/assets/images/Background+Border.webp') }}" alt="{{ $category->title }}" class="img-fluid">

                                <div class="mcb-overlay">
                                    <h3 class="title_36">{{ $category->title }}</h3>
                                    @if($category->category_url == 'solar-accessories')
                                        <a href="javascript:void(0);" class="com_btn com_btn_w_b">
                                                Coming Soon <span class="ms-2"></span>
                                            </a>
                                    @else
                                        <a href="{{ $category->category_url ? route('front.category.details', $category->category_url) : '#' }}" class="com_btn com_btn_w_b">
                                            Explore {{ $category->short_form ?: $category->title }} <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="11" viewBox="0 0 24 11" fill="none">
                                                    <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg></span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p>No product categories available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section  class="fea_Pro py_40">
    <div class="container">
        <p class="title_20 line_left" >Featured Products</p>
        <h1 class="title_44">Designed to Perform. Built to Last</h1>
        <p class="mb-0">Blitz products are IEC-compliant, rigorously tested, and trusted across the global solar and electrical industries.</p>

        <div class="pd_grid pt_40">
            @if(isset($featuredProducts) && $featuredProducts->count())
                @foreach($featuredProducts as $product)
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="{{ $product->list_image ? asset('public/images/product_list_images/' . $product->list_image) : asset('public/front/assets/images/Background+Border.webp') }}" alt="{{ $product->product_name }}" class="product-image">
                            </div>

                            <div>
                                  <div class="product-info">
                        <p class="product-sku">{{ $product->product_modal }}</p>
                        <h3 class="title_24">{{ $product->product_name }}</h3>

                        <div class="product-specs">
                            @forelse($product->technicalSpecifications->take(3) as $spec)
                                <div class="spec-row">
                                    <span class="spec-label">{{ $spec->parameter }}</span>
                                    <span class="spec-value">{{ $spec->specifications }}</span>
                                </div>
                            @empty
                                <div class="spec-row">
                                    <span class="spec-label">Specifications not available</span>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="product-buttons">
                        @if($product->datasheet)
                            <a href="{{ route('products.datasheet.download', $product->id) }}" target="_blank" class="com_btn com_btn_b_b">
                                <span><svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M15 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7L15 2Z"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14 2V6C14 6.53043 14.2107 7.03914 14.5858 7.41421C14.9609 7.78929 15.4696 8 16 8H20"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10 9H8" stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16 13H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 17H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span> <span class="ms-2">Datasheet</span>
                            </a>
                        @endif

                        <a href="#" class="com_btn product-enquire-button" data-product-name="{{ $product->product_name }}">
                            Enquire <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="11" viewBox="0 0 24 11" fill="none">
                                    <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white"
                                        stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></span>
                        </a>
                    </div>
                            </div>

                  
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p>No featured products available.</p>
            </div>
        @endif
    </div>
</section>


<div id="product-enquiry-modal" class="product-modal">
    <div class="product-modal-overlay" data-close-modal></div>
    <div class="product-modal-content">
        <button type="button" class="product-modal-close" data-close-modal>&times;</button>
        <div class="product-modal-body d-block">
            <div class="modal-form-header w-100 mb-4">
                <h2 class="title_30 mb-2">Product Enquiry</h2>
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
                    <button type="submit" class="com_btn">Send Enquiry</button>
                </div>
                <div id="popup-enquiry-message" class="text-success mt-3" style="display:none;"></div>
            </form>
        </div>
    </div>
</div>

<style>
.product-modal { display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center; }
.product-modal.active { display:flex; }
.product-modal-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.6); }
.product-modal-content { position:relative; background:#fff; border-radius:20px; max-width:900px; width:100%; max-height:90vh; overflow-y:auto; padding:30px; z-index:1; }
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

{{-- <section  class="py_40">

                    <div class="product-info">
                        <p class="product-sku">BZ-SPD40/2P</p>
                        <h3 class="title_24">Type 2 Surge Protector</h3>

                        <div class="product-specs">
                            <div class="spec-row">
                                <span class="spec-label">Max Voltage</span>
                                <span class="spec-value">275V AC</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Discharge</span>
                                <span class="spec-value">40kA</span>
                            </div>
                            <div class="spec-row no-border">
                                <span class="spec-label">Poles</span>
                                <span class="spec-value">2P</span>
                            </div>
                        </div>

                           <div class="product-buttons">
                            <a href="#" class="com_btn com_btn_b_b">
                                <span><svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M15 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7L15 2Z"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14 2V6C14 6.53043 14.2107 7.03914 14.5858 7.41421C14.9609 7.78929 15.4696 8 16 8H20"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10 9H8" stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16 13H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 17H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span> <span class="ms-2">Datasheet</span>
                            </a>

                            <a href="#" class="com_btn">
                                Enquire <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="11" viewBox="0 0 24 11" fill="none">
                                        <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white"
                                            stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('public/front/assets/images/Type 2 Surge Protector.png') }}" alt="Type 2 Surge Protector"
                            class="product-image">
                    </div>

                    <div class="product-info">
                        <p class="product-sku">BZ-SPD40/2P</p>
                        <h3 class="title_24">Type 2 Surge Protector</h3>

                        <div class="product-specs">
                            <div class="spec-row">
                                <span class="spec-label">Max Voltage</span>
                                <span class="spec-value">275V AC</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Discharge</span>
                                <span class="spec-value">40kA</span>
                            </div>
                            <div class="spec-row no-border">
                                <span class="spec-label">Poles</span>
                                <span class="spec-value">2P</span>
                            </div>
                        </div>

                           <div class="product-buttons">
                            <a href="#" class="com_btn com_btn_b_b">
                                <span><svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M15 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7L15 2Z"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14 2V6C14 6.53043 14.2107 7.03914 14.5858 7.41421C14.9609 7.78929 15.4696 8 16 8H20"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10 9H8" stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16 13H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 17H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span> <span class="ms-2">Datasheet</span>
                            </a>

                            <a href="#" class="com_btn">
                                Enquire <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="11" viewBox="0 0 24 11" fill="none">
                                        <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white"
                                            stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('public/front/assets/images/Type 2 Surge Protector.png') }}" alt="Type 2 Surge Protector"
                            class="product-image">
                    </div>

                    <div class="product-info">
                        <p class="product-sku">BZ-SPD40/2P</p>
                        <h3 class="title_24">Type 2 Surge Protector</h3>

                        <div class="product-specs">
                            <div class="spec-row">
                                <span class="spec-label">Max Voltage</span>
                                <span class="spec-value">275V AC</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Discharge</span>
                                <span class="spec-value">40kA</span>
                            </div>
                            <div class="spec-row no-border">
                                <span class="spec-label">Poles</span>
                                <span class="spec-value">2P</span>
                            </div>
                        </div>

                        <div class="product-buttons">
                            <a href="#" class="com_btn com_btn_b_b">
                                <span><svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M15 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7L15 2Z"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14 2V6C14 6.53043 14.2107 7.03914 14.5858 7.41421C14.9609 7.78929 15.4696 8 16 8H20"
                                            stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10 9H8" stroke="#020844" stroke-width="1.33333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16 13H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 17H8" stroke="#020844" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span> <span class="ms-2">Datasheet</span>
                            </a>

                            <a href="#" class="com_btn">
                                Enquire <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="11" viewBox="0 0 24 11" fill="none">
                                        <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white"
                                            stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section> --}}

<section  class="py_40">
    <div class="container">
        <div class="text-center">
            <p class="title_20 line_center" >Why Choose Us</p>
            <h1 class="title_44">Why Blitz Electrical?</h1>
            <p class="mb-0">From Ahmedabad to the UAE, from Kenya to Bangladesh, Blitz surge protection devices are earning trust one installation at a time.</p>
        </div>

        <div class="row g-4 pt_40">
            <div class="col-md-3">
                <div class="counter">
                    <h2 class="title_44">8+</h2>
                    <h4 class="title_24">Countries</h4>
                    <p class="mb-0">where Blitz is active</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="counter">
                    <h2 class="title_44">≤ 25ns</h2>
                    <h4 class="title_24">Surge</h4>
                    <p class="mb-0">response time</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="counter">
                    <h2 class="title_44">IEC</h2>
                    <h4 class="title_24">Globally</h4>
                    <p class="mb-0">certified</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="counter">
                    <h2 class="title_44">2+</h2>
                    <h4 class="title_24">Years</h4>
                    <p class="mb-0">of proven excellence</p>
                </div>
            </div>

            {{-- <div class="col-md-3">
                <div class="counter">
                    <h2 class="title_44">99.9%</h2>
                    <h4 class="title_24">Reliability Rate</h4>
                    <p class="mb-0">Zero-defect commitment</p>
                </div>
            </div> --}}
            
        </div>

        <div class="row g-4 pt_40">
            <div class="col-md-4">
                <div class="why_Ch">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="12" fill="#E5EFFF" />
                        <path
                            d="M36 29.0004C36 34.0004 32.5 36.5005 28.34 37.9505C28.1222 38.0243 27.8855 38.0207 27.67 37.9405C23.5 36.5005 20 34.0004 20 29.0004V22.0004C20 21.7352 20.1054 21.4809 20.2929 21.2933C20.4804 21.1058 20.7348 21.0004 21 21.0004C23 21.0004 25.5 19.8004 27.24 18.2804C27.4519 18.0994 27.7214 18 28 18C28.2786 18 28.5481 18.0994 28.76 18.2804C30.51 19.8104 33 21.0004 35 21.0004C35.2652 21.0004 35.5196 21.1058 35.7071 21.2933C35.8946 21.4809 36 21.7352 36 22.0004V29.0004Z"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <h4 class="title_18">Premium Build Quality</h4>
                    <h2 class="title_24">Made to Endure</h2>
                    <p class="mb-0">Blitz products use high-grade materials for durability, heat resistance, and long-term operational reliability</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="why_Ch">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="12" fill="#0055FF" fill-opacity="0.1" />
                        <path
                            d="M31.4768 28.8896L32.9918 37.4156C33.0087 37.516 32.9946 37.6192 32.9514 37.7114C32.9081 37.8036 32.8377 37.8803 32.7497 37.9314C32.6616 37.9825 32.56 38.0055 32.4586 37.9974C32.3571 37.9892 32.2605 37.9502 32.1818 37.8856L28.6018 35.1986C28.4289 35.0695 28.219 34.9998 28.0033 34.9998C27.7875 34.9998 27.5776 35.0695 27.4048 35.1986L23.8188 37.8846C23.7401 37.9491 23.6436 37.988 23.5422 37.9962C23.4409 38.0044 23.3394 37.9815 23.2514 37.9305C23.1634 37.8796 23.093 37.803 23.0497 37.711C23.0063 37.619 22.992 37.516 23.0088 37.4156L24.5228 28.8896"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M28 30C31.3137 30 34 27.3137 34 24C34 20.6863 31.3137 18 28 18C24.6863 18 22 20.6863 22 24C22 27.3137 24.6863 30 28 30Z"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>


                    <h4 class="title_18">IEC Compliant</h4>
                    <h2 class="title_24">Globally Certified</h2>
                    <p class="mb-0">Blitz electrical protection products meet international standards for reliable deployment across global industrial markets</p>
                </div>
            </div>



            <div class="col-md-4">
                <div class="why_Ch">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="12" fill="#0055FF" fill-opacity="0.1" />
                        <path
                            d="M18 36C18 36.5304 18.2107 37.0391 18.5858 37.4142C18.9609 37.7893 19.4696 38 20 38H36C36.5304 38 37.0391 37.7893 37.4142 37.4142C37.7893 37.0391 38 36.5304 38 36V24L31 29V24L24 29V20C24 19.4696 23.7893 18.9609 23.4142 18.5858C23.0391 18.2107 22.5304 18 22 18H20C19.4696 18 18.9609 18.2107 18.5858 18.5858C18.2107 18.9609 18 19.4696 18 20V36Z"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M33 34H34" stroke="#020844" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M28 34H29" stroke="#020844" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M23 34H24" stroke="#020844" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>


                    <h4 class="title_18">Reliable Fault Indication </h4>
                    <h2 class="title_24">Always Stay Informed</h2>
                    <p class="mb-0">A built-in Green/Red status window lets installers and operators monitor the health of every surge protection device</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="why_Ch">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="12" fill="#0055FF" fill-opacity="0.1" />
                        <path
                            d="M19 30H22C22.5304 30 23.0391 30.2107 23.4142 30.5858C23.7893 30.9609 24 31.4696 24 32V35C24 35.5304 23.7893 36.0391 23.4142 36.4142C23.0391 36.7893 22.5304 37 22 37H21C20.4696 37 19.9609 36.7893 19.5858 36.4142C19.2107 36.0391 19 35.5304 19 35V28C19 25.6131 19.9482 23.3239 21.636 21.636C23.3239 19.9482 25.6131 19 28 19C30.3869 19 32.6761 19.9482 34.364 21.636C36.0518 23.3239 37 25.6131 37 28V35C37 35.5304 36.7893 36.0391 36.4142 36.4142C36.0391 36.7893 35.5304 37 35 37H34C33.4696 37 32.9609 36.7893 32.5858 36.4142C32.2107 36.0391 32 35.5304 32 35V32C32 31.4696 32.2107 30.9609 32.5858 30.5858C32.9609 30.2107 33.4696 30 34 30H37"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>


                    <h4 class="title_18">Dedicated Support </h4>
                    <h2 class="title_24">Service Beyond Sales</h2>
                    <p class="mb-0">Blitz provides expert product guidance and dependable after-sales support to keep projects running smoothly</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="why_Ch">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="12" fill="#0055FF" fill-opacity="0.1" />
                        <path
                            d="M30 34V22C30 21.4696 29.7893 20.9609 29.4142 20.5858C29.0391 20.2107 28.5304 20 28 20H20C19.4696 20 18.9609 20.2107 18.5858 20.5858C18.2107 20.9609 18 21.4696 18 22V33C18 33.2652 18.1054 33.5196 18.2929 33.7071C18.4804 33.8946 18.7348 34 19 34H21"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M31 34H25" stroke="#020844" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M35 34H37C37.2652 34 37.5196 33.8946 37.7071 33.7071C37.8946 33.5196 38 33.2652 38 33V29.35C37.9996 29.1231 37.922 28.903 37.78 28.726L34.3 24.376C34.2065 24.2589 34.0878 24.1643 33.9528 24.0992C33.8178 24.0341 33.6699 24.0002 33.52 24H30"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M33 36C34.1046 36 35 35.1046 35 34C35 32.8954 34.1046 32 33 32C31.8954 32 31 32.8954 31 34C31 35.1046 31.8954 36 33 36Z"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M23 36C24.1046 36 25 35.1046 25 34C25 32.8954 24.1046 32 23 32C21.8954 32 21 32.8954 21 34C21 35.1046 21.8954 36 23 36Z"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>


                    <h4 class="title_18">Made in India </h4>
                    <h2 class="title_24">Proudly Crafted Here</h2>
                    <p class="mb-0">Designed and manufactured in India, Blitz products carry the precision of local engineering expertise </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="why_Ch">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="12" fill="#0055FF" fill-opacity="0.1" />
                        <path
                            d="M28 38C33.5228 38 38 33.5228 38 28C38 22.4772 33.5228 18 28 18C22.4772 18 18 22.4772 18 28C18 33.5228 22.4772 38 28 38Z"
                            stroke="#020844" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M28 22V28L32 30" stroke="#020844" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>


                    <h4 class="title_18">Fast Response Time </h4>
                    <h2 class="title_24">Performance Assured</h2>
                    <p class="mb-0">Blitz SPD devices intercept voltage spikes within ≤25ns, protecting equipment from damaging transient surges</p>
                </div>
            </div>
        </div>
    </div>

</section>


<section  class="bg_com py_40">
    <div class="container">

        <div style="display: flex; justify-content: space-between; align-items: flex-end;">

            <div>
                <p class="title_20 line_left" >Industries We Serve</p>
                <h1 class="title_44">Protecting Tomorrow's Powerful Infrastructure</h1>
                <p class="mb-0">Industries choose Blitz when system protection, uptime, and electrical safety cannot be compromised. </p>
            </div>

            <div class="custom-arrows">
                <div class="custom-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="18" viewBox="0 0 10 18" fill="none">
                        <path d="M8.25 16.25L1.25 8.75L8.25 1.25" stroke="#EE1A25" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="custom-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                        <path d="M10.7988 22.4004L17.7988 14.9004L10.7988 7.40039" stroke="#EE1A25" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>

        </div>

        <div class="slider-wrapper pt_40">
            <div class="indu_slider">
                @if(isset($industries) && $industries->count())
                    @foreach($industries as $industry)
                        <div class="slide-item">
                            <img class="img-fluid" src="{{ $industry->image ? asset('public/images/industries/' . $industry->image) : asset('public/front/assets/images/placeholder.png') }}" alt="{{ $industry->title }}">
                            <div class="title_36">{{ strtoupper($industry->title) }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="slide-item">
                        <img class="img-fluid" src="{{ asset('public/front/assets/images/Solar plants.webp') }}" alt="Solar Plants">
                        <div class="title_36">SOLAR PLANTS</div>
                    </div>
                    <div class="slide-item">
                        <img class="img-fluid" src="{{ asset('public/front/assets/images/Commercial  Buildings.webp') }}" alt="Commercial Buildings">
                        <div class="title_36">COMMERCIAL BUILDINGS</div>
                    </div>
                    <div class="slide-item">
                        <img class="img-fluid" src="{{ asset('public/front/assets/images/Data Center.webp') }}" alt="Data Center">
                        <div class="title_36">DATA CENTER</div>
                    </div>
                    <div class="slide-item">
                        <img class="img-fluid" src="{{ asset('public/front/assets/images/Residential Infrastructure.webp') }}" alt="Residential Infrastructure">
                        <div class="title_36">RESIDENTIAL INFRASTRUCTURE</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


<section  class="testimonial-section">
    <div class="bg-curve">
        <img src="{{ asset('public/front/assets/images/testimonial-bg.png') }}" alt="Background Curve" class="img-fluid">
    </div>
    <div class="row align-items-center">

        <div class="col-lg-4 text-center text-md-start">
            <p class="title_20 line_left aos-init aos-animate" >
                Testimonial</p>
            <h2 class="title_44">What Our Clients Say</h2>

            <div class="custom-arrows pt_40">
                <div class="custom-prev2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="18" viewBox="0 0 10 18" fill="none">
                        <path d="M8.25 16.25L1.25 8.75L8.25 1.25" stroke="#EE1A25" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="custom-next2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                        <path d="M10.7988 22.4004L17.7988 14.9004L10.7988 7.40039" stroke="#EE1A25" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="testimonial-slider">
            @if(isset($testimonials) && $testimonials->count())
                @foreach($testimonials as $testimonial)
                    <div class="testi-card">
                        <div class="card-top">
                            <div class="client-logo">
                                @if($testimonial->image)
                                    <img src="{{ asset('public/admin/testimonials/' . $testimonial->image) }}" alt="{{ $testimonial->alt_tag ?? $testimonial->title }}">
                                @else
                                    <img src="{{ asset('public/front/assets/images/testimonial-icon1.png') }}" alt="{{ $testimonial->title }}">
                                @endif
                            </div>
                            <div class="client-details">
                                <h4 class="title_18">{{ $testimonial->title }}</h4>
                                <p class="mb-0">{{ $testimonial->locations }}</p>
                            </div>
                        </div>
                        <p class="testi-text">{{ $testimonial->description }}</p>
                        <div class="rating">
                            {!! str_repeat('★', max(0, intval($testimonial->star))) !!}
                            {!! str_repeat('<span class="empty">★</span>', max(0, 5 - intval($testimonial->star))) !!}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="testi-card">
                    <div class="card-top">
                        <div class="client-logo">
                            <img src="{{ asset('public/front/assets/images/testimonial-icon1.png') }}" alt="Logo">
                        </div>
                        <div class="client-details">
                            <h4 class="title_18">FLAME SOLREN PRIVATE LIMITED</h4>
                            <p class="mb-0">Surat</p>
                        </div>
                    </div>
                    <p class="testi-text">BLITZ SPD offers superior quality, enhanced durability, and outstanding performance - all at a budget-friendly price</p>
                    <div class="rating">
                        ★★★★<span class="empty">★</span>
                    </div>
                </div>
            @endif
        </div>
        </div>

    </div>
</section>

<section  class="bg_com py_40">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="counter2_left">
                    <img class="img_rou img-fluid" src="{{ asset('public/front/assets/images/Manufacturing Excellence.webp') }}"
                        alt="Manufacturing Excellence">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_134622)">
                            <path
                                d="M40 80C62.0914 80 80 62.0914 80 40C80 17.9086 62.0914 0 40 0C17.9086 0 0 17.9086 0 40C0 62.0914 17.9086 80 40 80Z"
                                fill="url(#paint0_linear_1_134622)" />
                            <path
                                d="M75.9008 57.6562C73.179 63.1815 69.2197 68.0046 64.3307 71.7508C59.4417 75.497 53.7547 78.0654 47.7117 79.2562L29.168 60.7125L55.893 37.6562L75.9008 57.6562Z"
                                fill="url(#paint1_linear_1_134622)" />
                            <path
                                d="M55.8922 37.6563L32.4266 19.5313C31.9873 19.1913 31.4614 18.9813 30.9087 18.9253C30.3561 18.8693 29.7988 18.9694 29.3002 19.2144C28.8016 19.4594 28.3818 19.8393 28.0884 20.3111C27.795 20.7828 27.6399 21.3273 27.6406 21.8829V58.125C27.6414 58.6799 27.7975 59.2234 28.0915 59.694C28.3855 60.1646 28.8054 60.5434 29.3037 60.7874C29.802 61.0314 30.3587 61.1309 30.9107 61.0746C31.4627 61.0183 31.9878 60.8084 32.4266 60.4688L55.8922 42.3516C56.2506 42.0742 56.5408 41.7183 56.7404 41.3114C56.94 40.9045 57.0438 40.4572 57.0438 40.0039C57.0438 39.5507 56.94 39.1034 56.7404 38.6965C56.5408 38.2896 56.2506 37.9337 55.8922 37.6563Z"
                                fill="#020844" />
                        </g>
                        <defs>
                            <linearGradient id="paint0_linear_1_134622" x1="11.7156" y1="11.7156" x2="68.2844"
                                y2="68.2844" gradientUnits="userSpaceOnUse">
                                <stop stop-color="white" />
                                <stop offset="1" stop-color="#E5EEFF" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_1_134622" x1="41.6148" y1="48.2656" x2="64.9586"
                                y2="71.6094" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#ACBFE4" />
                                <stop offset="0.93" stop-color="#E5EEFF" stop-opacity="0" />
                            </linearGradient>
                            <clipPath id="clip0_1_134622">
                                <rect width="80" height="80" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>

            </div>

            <div class="col-md-6">
                <p class="title_20 line_left" >Manufacturing Excellence</p>
                <h1 class="title_44">Precision-Powered Innovation</h1>
                <p class="mb-0">Every Blitz device is designed, assembled, and quality-checked, where skilled engineering and strict manufacturing standards ensure each product is ready for the most demanding environments. </p>

                <div class="pt_40">
                    <div class="counter2_right">
                        <div class="counter2">
                            <h4 class="title_44">50,000+</h4>
                            <p class="mb-0">sq. ft. facility</p>
                        </div>

                        <div class="counter2">
                            <h4 class="title_44">100%</h4>
                            <p class="mb-0">Automated QC</p>
                        </div>

                        <div class="counter2">
                            <h4 class="title_44">24/7</h4>
                            <p class="mb-0">Production</p>
                        </div>

                        <div class="counter2">
                            <h4 class="title_44">Zero</h4>
                            <p class="mb-0">Defect Policy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section  class="tec_res">
    <div class="container h-100">
        <div class="tec_res_left">
            <p class="title_20 line_left" >Technical resources</p>
            <h2 class="title_44">Discover The Complete Blitz Range</h2>
            <p class="mb-0">Download our complete product catalogue covering surge protection devices, miniature circuit breakers, fuse terminals, and solar accessories - everything you are looking for </p>

            <div class="pt_40">
                <a href="#" class="com_btn com_btn_w">
                    <span class="me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15"
                                stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7 10L12 15L17 10" stroke="black" stroke-width="1.33333" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 15V3" stroke="black" stroke-width="1.33333" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span> Download Catalogue
                </a>

                <a href="#" class="com_btn com_btn_w_b ms-3">
                    <span class="me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7L15 2Z"
                                stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M14 2V6C14 6.53043 14.2107 7.03914 14.5858 7.41421C14.9609 7.78929 15.4696 8 16 8H20"
                                stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 9H8" stroke="white" stroke-width="1.33333" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M16 13H8" stroke="white" stroke-width="1.33333" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M16 17H8" stroke="white" stroke-width="1.33333" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span> Technical Datasheets
                </a>

            </div>
        </div>
    </div>
</section> --}}

@include('layouts.form')

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

@include('layouts.frontfooter')