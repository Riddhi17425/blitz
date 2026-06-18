@include('layouts.frontheader')

<section class="pd_banner pb-0">
    <div class="banner_wrapper">
        <div class="container">

            <div class="banner_grid">
                <div class="baner_left">
                    <div class="breadcrumbs">
                        <a href="{{ route('front.home') }}">Home</a>
                        <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                                    stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <a href="javascript:void(0);">Blogs</a>
                    </div>
                    <h1 class="banner_title">Blitz Electrical Blogs</h1>
                    <p class="baner_desc mb-0">Stay informed with expert articles, technical guides, and product insights, covering everything you need to know about electrical protection and solar safety.</p>

                </div>
                <div class="baner_right">
                    <img src="{{ asset('public/front/assets/images/BLOG.webp') }}" alt="blogs banner" class="w-50">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py_80">
    <div class="container">
        <div class="row g-4">
            @if(isset($blogs) && is_countable($blogs) && count($blogs) > 0)
            @foreach($blogs as $key => $blog)
            <div class="col-md-4">
                <div class="blog-card">
                    <div class="card-content-wrapper">
                        <div class="blog-image-box">
                            <a href="{{ route('front.blog.details', $blog->url) }}"><img src="{{ asset('public/admin/blogs/front_image/' . $blog->front_image) }}" alt="{{ $blog->front_image_alt ?? '' }}"></a>
                        </div>
                        <div class="blog-meta">
                           {{ $blog->category->title ?? '' }} • {{ date('M d, Y', strtotime($blog->date)) }}
                        </div>
                        <h5 class="blog-title">
                           <a href="{{ route('front.blog.details', $blog->url) }}"> {{ $blog->title ?? '' }} </a>
                        </h5>
                        <p class="blog-desc">
                            {!! $blog->meta_description ?? '' !!}
                        </p>
                        <div class="read-more">
                            <a href="{{ route('front.blog.details', $blog->url) }}">Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            {{--<div class="col-md-4">
                <div class="blog-card">
                    <div class="card-content-wrapper">

                        <div class="blog-image-box">
                            <img src="{{ asset('public/front/assets/images/Top Benefits of MCB Over Fuse 2.webp') }}"
                                alt="Surge Protection">
                        </div>

                        <div class="blog-meta">
                            Surge Protection • Nov 20, 2025
                        </div>

                        <h5 class="blog-title">
                            The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems
                        </h5>

                        <p class="blog-desc">
                            Prevent appliance damage and save money with surge protectors...
                        </p>

                        <div class="read-more">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>

                    </div>
                </div>

            </div>
            
            <div class="col-md-4">
                <div class="blog-card">
                    <div class="card-content-wrapper">

                        <div class="blog-image-box">
                            <img src="{{ asset('public/front/assets/images/How Surge Protection Devices Safeguard Solar Power Systems 2.webp') }}"
                                alt="Surge Protection">
                        </div>

                        <div class="blog-meta">
                            Surge Protection • Nov 20, 2025
                        </div>

                        <h5 class="blog-title">
                            The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems
                        </h5>

                        <p class="blog-desc">
                            Prevent appliance damage and save money with surge protectors...
                        </p>

                        <div class="read-more">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>

                    </div>
                </div>

            </div>

              <div class="col-md-4">
                <div class="blog-card">
                    <div class="card-content-wrapper">

                        <div class="blog-image-box">
                            <img src="{{ asset('public/front/assets/images/The Importance of MCB in Electrical Safety 2.webp') }}"
                                alt="Surge Protection">
                        </div>

                        <div class="blog-meta">
                            Surge Protection • Nov 20, 2025
                        </div>

                        <h5 class="blog-title">
                            The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems
                        </h5>

                        <p class="blog-desc">
                            Prevent appliance damage and save money with surge protectors...
                        </p>

                        <div class="read-more">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>

                    </div>
                </div>

            </div>

              <div class="col-md-4">
                <div class="blog-card">
                    <div class="card-content-wrapper">

                        <div class="blog-image-box">
                            <img src="{{ asset('public/front/assets/images/Top Benefits of MCB Over Fuse 2.webp') }}"
                                alt="Surge Protection">
                        </div>

                        <div class="blog-meta">
                            Surge Protection • Nov 20, 2025
                        </div>

                        <h5 class="blog-title">
                            The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems
                        </h5>

                        <p class="blog-desc">
                            Prevent appliance damage and save money with surge protectors...
                        </p>

                        <div class="read-more">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>

                    </div>
                </div>

            </div>

              <div class="col-md-4">
                <div class="blog-card">
                    <div class="card-content-wrapper">

                        <div class="blog-image-box">
                            <img src="{{ asset('public/front/assets/images/How Surge Protection Devices Safeguard Solar Power Systems 2.webp') }}"
                                alt="Surge Protection">
                        </div>

                        <div class="blog-meta">
                            Surge Protection • Nov 20, 2025
                        </div>

                        <h5 class="blog-title">
                            The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems
                        </h5>

                        <p class="blog-desc">
                            Prevent appliance damage and save money with surge protectors...
                        </p>

                        <div class="read-more">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>

                    </div>
                </div>

            </div> --}}

        </div>
    </div>
</section>

@include('layouts.frontfooter')