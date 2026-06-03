@include('layouts.frontheader')
<section class="pd_banner">
   <div class="banner_wrapper">
      <div class="container">
         <div class="banner_grid">
            <div class="baner_left">
               <div class="breadcrumbs">
                  <a href="{{ route('front.home') }}">Home</a>
                  <span>
                     <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                           stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </span>
                  @if($category)
                  <span>
                     <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </span>
                  <a href="#">{{ $category->title ?? ''}}</a>
                  @endif
                  @if($subCategory)
                  <span>
                     <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </span>
                  <a href="#">{{ $subCategory->title ?? '' }}</a>
                  @endif
               </div>
               <h1 class="banner_title">{{ $subCategory->title ?? '' }}</h1>
               <h6 class="baner_desc">{!! $subCategory->description ?? '' !!}</h6>
               <div class="banner_btns">
                  <a href="{{ route('front.contact') }}" class="com_btn">Request Quote</a>
                  @if($subCategory->catalogue_pdf)
                  <a href="{{ asset('storage/app/public/' . $subCategory->catalogue_pdf) }}" target="_blank" class="com_btn com_btn_b_b">
                     Download Catalogue 
                     <span class="ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                           height="11" viewBox="0 0 24 11" fill="none">
                           <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333"
                              stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white"
                              stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </span>
                  </a>
                 @endif
               </div>
            </div>
            <div class="baner_right">
               <img src="{{ asset('/public/images/sub_category_detail/' . $subCategory->detail_img) }}" alt="product" class="img-fluid">
            </div>
         </div>
      </div>
   </div>
</section>
<section class="fea_Pro py_40">
   <div class="container">
      <p class="title_20 line_left aos-init aos-animate" >Products
      </p>
      <h2 class="title_44">Designed to Perform. Built to Last</h2>
      <p class="mb-0">Blitz products are IEC-compliant, rigorously tested, and trusted across the global solar and
         electrical industries.
      </p>
      <div class="row pt_40">
         @if(isset($products) && $products->count())
         @foreach($products as $product)
         <div class="col-md-6 mb-4">
            <div class="product-card">
               <div class="product-img-wrapper">
                  <img src="{{ $product->list_image ? asset('public/images/product_list_images/' . $product->list_image) : asset('public/front/assets/images/Background+Border.webp') }}" alt="{{ $product->product_name }}" class="product-image">
               </div>
               <div class="product-info">
                  <p class="product-sku">{{ $product->product_modal ?? '' }}</p>
                  <h3 class="title_24">{{ $product->product_name ?? '' }}</h3>
                  <div class="product-specs">
                     @forelse($product->technicalSpecifications->where('is_show_on_list', 1)->take(3) as $spec)
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
                  {{-- @if($product->datasheet)
                  <a href="{{ route('products.datasheet.download', $product->id) }}" target="_blank" class="com_btn com_btn_b_b">
                     <span>
                        <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
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
                        </svg>
                     </span>
                     <span class="ms-2">Datasheet</span>
                  </a>
                  @endif --}}
                  <a href="{{ route('front.product.details', $product->product_url) }}" class="com_btn">
                     View Details 
                     <span class="ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                           height="11" viewBox="0 0 24 11" fill="none">
                           <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333"
                              stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white"
                              stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                     </span>
                  </a>
               </div>
            </div>
         </div>
         @endforeach
         @endif
         {{-- 
         <div class="col-md-6">
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
               </div>
            </div>
         </div>
         --}}
      </div>
   </div>
</section>

@php
   $ctaIcons = $subCategory->cta_icon ?? [];
   $ctaTitles = $subCategory->cta_title ?? [];
   $ctaDescriptions = $subCategory->cta_description ?? [];
   
   // Filter out empty strings to avoid rendering broken empty blocks
   $validCtaTitles = array_filter($ctaTitles, function($value) { return !is_null($value) && $value !== ''; });
   $totalCtas = count($validCtaTitles);
   $halfCtas = ceil($totalCtas / 2);
@endphp

@if($totalCtas > 0 || !empty($subCategory->cta_img_title))
<section class="py_80 multi_ac">
   <div class="container">
      <div class="mb_40 text-center">
         <h2 class="title_44">{{ $subCategory->cta_img_title ?? '' }}</h2>
         <p class="mb-0">{{ $subCategory->cta_img_description ?? '' }}</p>
      </div>
      <div class="row gy-4 gy-lg-0">
         <div class="col-md-3">
            <div class="d-flex flex-column justify-content-between h-100">
               @for($i = 0; $i < $halfCtas; $i++)
               @if(!empty($ctaTitles[$i]))
               <div class="text-center{{ $i < $halfCtas - 1 ? ' mb-4' : '' }}">
                  @if(!empty($ctaIcons[$i]))
                  <img src="{{ asset('public/images/sub_category_cta_icons/' . $ctaIcons[$i]) }}" alt="{{ $ctaTitles[$i] }}" class="mb-2" style="width: 60px; height: 60px; object-fit: contain;">
                  @else
                  <svg class="mb-2" width="70" height="70" viewBox="0 0 70 70" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <circle cx="35" cy="35" r="35" fill="#020844" />
                     <path
                        d="M51 35C51 43.8364 43.8364 51 35 51C26.1636 51 19 43.8364 19 35C19 26.1636 26.1636 19 35 19C43.8364 19 51 26.1636 51 35ZM42.6945 32.8182H36.4545V23.9876L27.3055 37.1818H33.5455V46.0124L42.6945 32.8182Z"
                        fill="white" />
                  </svg>
                  @endif
                  <h4 class="title_32">{{ $ctaTitles[$i] }}</h4>
                  <p class="mb-0">{{ $ctaDescriptions[$i] ?? '' }}</p>
               </div>
               @endif
               @endfor
            </div>
         </div>
         <div class="col-md-6 text-center">
            @if(!empty($subCategory->cta_img))
            <img src="{{ asset('public/images/sub_category_cta/' . $subCategory->cta_img) }}" alt="images" class="img-fluid">
            @else
            <img src="{{ asset('public/front/assets/images/Multiple AC Protection Solutions, One Standard of Reliability 2.webp') }}"
               alt="images" class=" img-fluid">
            @endif
         </div>

         <div class="col-md-3">
            <div class="d-flex flex-column justify-content-between h-100">
               @for($i = $halfCtas; $i < count($ctaTitles); $i++)
               @if(!empty($ctaTitles[$i]))
               <div class="text-center{{ $i < count($ctaTitles) - 1 ? ' mb-4' : '' }}">
                  @if(!empty($ctaIcons[$i]))
                  <img src="{{ asset('public/images/sub_category_cta_icons/' . $ctaIcons[$i]) }}" alt="{{ $ctaTitles[$i] }}" class="mb-2" style="width: 70px; height: 70px; object-fit: contain;">
                  @else
                  <svg class="mb-2" width="70" height="70" viewBox="0 0 70 70" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <circle cx="35" cy="35" r="35" fill="#020844" />
                     <path
                        d="M51 35C51 43.8364 43.8364 51 35 51C26.1636 51 19 43.8364 19 35C19 26.1636 26.1636 19 35 19C43.8364 19 51 26.1636 51 35ZM42.6945 32.8182H36.4545V23.9876L27.3055 37.1818H33.5455V46.0124L42.6945 32.8182Z"
                        fill="white" />
                  </svg>
                  @endif
                  <h4 class="title_32">{{ $ctaTitles[$i] }}</h4>
                  <p class="mb-0">{{ $ctaDescriptions[$i] ?? '' }}</p>
               </div>
               @endif
               @endfor
            </div>
         </div>
      </div>
   </div>
</section>
@endif

<section  class="bg_com py_40">
   <div class="container">
      <div style="display: flex; justify-content: space-between; align-items: flex-end;">
         <div>
            <p class="title_20 line_left" >Industries We Serve</p>
            <h1 class="title_44">{{ $industryT ?? 'Protecting Tomorrow\'s Powerful Infrastructure' }}</h1>
            <p class="mb-0">{{ $industryD ?? 'Industries choose Blitz when system protection, uptime, and electrical safety cannot be compromised.' }}</p>
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
         <div class="indu_slider common-dots">
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
            @endif
         </div>
      </div>
   </div>
</section>
<section class="py_40">
   <div class="container">
      @php
      $subCategoryFaqs = collect($subCategory->faqs ?? [])->filter(fn ($faq) => !empty($faq['question']) || !empty($faq['answer']))->values();
      @endphp
      <div class="pb_40">
         <p class="title_20 line_left" >FAQs</p>
         <h2 class="title_44">{{ $subCategory->faq_title ?? 'Frequently Asked Questions' }}</h2>
         @if(!empty($subCategory?->faq_description))
         <div class="mb-0">{!! $subCategory->faq_description !!}</div>
         @endif
      </div>
      <div class="accordion" id="blitzFaq">
         @forelse($subCategoryFaqs as $index => $faq)
         <div class="accordion-item">
            <h4 class="accordion-header">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#productListFaq{{ $index }}" aria-controls="productListFaq{{ $index }}">
               {{ $faq['question'] ?? '' }}
               </button>
            </h4>
            <div id="productListFaq{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
               <div class="accordion-body">
                  {!! $faq['answer'] ?? '' !!}
               </div>
            </div>
         </div>
         @empty
         <p class="mb-0">No FAQs available.</p>
         @endforelse
      </div>
   </div>
</section>
@include('layouts.form')
@include('layouts.frontfooter')