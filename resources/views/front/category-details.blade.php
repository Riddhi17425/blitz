@include('layouts.frontheader')
<section class="pd_banner">
   <div class="banner_wrapper">
      <div class="container">
         <div class="banner_grid">
            <div class="baner_left">
               <div class="breadcrumbs">
                  <a href="#">Home</a>
                  <span>
                     <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                           stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                  </span>
                  <a href="#">{{$category->short_form ?? ''}}</a>
               </div>
               <h2 class="banner_title">{{$category->title ?? ''}}</h2>
               <p class="baner_desc">{{$category->description ?? ''}}
               </p>
               <div class="banner_btns">
                  <a href="{{ route("front.contact") }}" class="com_btn">
                  Request Quote 
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
                  {{-- <a href="#" class="com_btn">Download Catalogue</a> --}}
               </div>
            </div>
            <div class="baner_right">
               <img src="{{ asset('public/images/category_detail/' . $category->detail_img) }}" alt="{{$category->title ?? ''}}" class="img-fluid">
            </div>
         </div>
      </div>
   </div>
</section>
<section class="py_80">
   <div class="container">
      <div class="mb-4">
         <p class="title_20 line_left aos-init aos-animate" >
            Product Range
         </p>
         <h2 class="title_44">{{ $category->sub_category_heading ?? '' }}
         </h2>
         <p>{{ $category->sub_category_description ?? '' }}</p>
      </div>
      @if(isset($category->subCategories) && $category->subCategories->count())
      <div class="row">
         @foreach($category->subCategories as $key => $subValue)
         <div class="col-md-6">
            <div class="pro_cat">
               <img src="{{ asset('/public/images/sub_category_list/' . $subValue->list_img) }}" alt="img" class="img_rou img-fluid">
               <div class="pro_cat_cont">
                  <h4 class="title_36">
                     {{ $subValue->short_form ?? '' }}
                  </h4>
                  <p>{{ $subValue->short_description ?? '' }}</p>
                  <a href="{{ route('front.product.list', ['cat_url' => $subValue->category->category_url, 'sub_cat_url' => $subValue->sub_category_url]) }}" class="com_btn com_btn_w_b">View Products</a>
               </div>
            </div>
         </div>
         @endforeach
      </div>
      @elseif(isset($category->products) && $category->products->count())
      <div class="row pt_40">
         @foreach($category->products as $product)
         <div class="col-md-6">
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
                  @if($product->datasheet)
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
                  @endif
                  <a href="{{ route('front.product.details', $product->product_url) }}" class="com_btn">
                     View Product 
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
      </div>
      @endif
   </div>
</section>
@if(isset($category->cta_img_desktop) && $category->cta_img_desktop != '')
<section  class="tec_res product_cta" style="background: url({{ asset('public/images/category_cta_desktop/' . $category->cta_img_desktop) }});">
   <div class="container h-100">
      <div class="tec_res_left">
         <h2 class="title_44" style="color: var(--blue-head); !important">{{ $category->cta_img_title ?? '' }}</h2>
         <p class="mb-0" style="color: var(--grey-666) !important;">{!! $category->cta_img_description ?? '' !!}</p>
         <div class="pt_40">
            <a href="#" class="com_btn">
               <span class="me-2">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <path
                        d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15"
                        stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                     <path d="M7 10L12 15L17 10" stroke="black" stroke-width="1.33333" stroke-linecap="round"
                        stroke-linejoin="round" />
                     <path d="M12 15V3" stroke="black" stroke-width="1.33333" stroke-linecap="round"
                        stroke-linejoin="round" />
                  </svg>
               </span>
               Download Catalogue
            </a>
            {{-- 
            <a href="#" class="com_btn ms-3">
               <span class="me-2">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
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
               </span>
               Technical Datasheets
            </a>
            --}}
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
            <h1 class="title_44">Powering Critical Infrastructure</h1>
            <p class="mb-0">From solar farms to residential towers, Blitz products safeguard the infrastructure that
               drives progress.
            </p>
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
            @endif
         </div>
      </div>
   </div>
</section>
<section class="py_40">
   <div class="container">
      @php
      $categoryFaqs = collect($category->faqs ?? [])->filter(fn ($faq) => !empty($faq['question']) || !empty($faq['answer']))->values();
      @endphp
      <div class="pb_40">
         <p class="title_20 line_left" >FAQs</p>
         <h2 class="title_44">{{ $category->faq_title ?? 'Frequently Asked Questions' }}</h2>
         @if(!empty($category->faq_description))
         <div class="mb-0">{!! $category->faq_description !!}</div>
         @endif
      </div>
      <div class="accordion" id="blitzFaq">
         @forelse($categoryFaqs as $index => $faq)
         <div class="accordion-item">
            <h4 class="accordion-header">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#categoryFaq{{ $index }}" aria-controls="categoryFaq{{ $index }}">
               {{ $faq['question'] ?? '' }}
               </button>
            </h4>
            <div id="categoryFaq{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
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