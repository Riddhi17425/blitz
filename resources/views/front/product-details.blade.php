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
@endphp

<section class="py_80">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('front.home') }}">Home</a>
            @if($product->category)
                <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg></span>
                <a href="#">{{ $product->category->title }}</a>
            @endif
            @if($product->subCategory)
                <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg></span>
                <a href="#">{{ $product->subCategory->title }}</a>
            @endif
        </div>
        <div class="row xl-gx-5 gx-4">

        <div class="row gx-5">
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
                <h1 class="product-title">{{ $product->product_name }}</h1>
                @if($product->product_modal)
                    <div class="product-sku">{{ $product->product_modal }}</div>
                @endif

                @if($product->description)
                    <div class="product-desc">{!! $product->description !!}</div>
                @endif

                <div class="pb_40">
                    @if($product->datasheet)
                        <a href="{{ route('products.datasheet.download', $product->id) }}" target="_blank" class="com_btn">
                            Datasheet <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="11" viewBox="0 0 24 11" fill="none">
                                <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg></span>
                        </a>
                    @endif

                    <a href="{{ route('front.contact') }}" class="com_btn product-enquire-button" data-product-name="{{ $product->product_name }}">
                        Enquire <span class="ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="11" viewBox="0 0 24 11" fill="none">
                            <path d="M0.666748 5.33325H22.6667" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M17.9998 0.666626L22.6664 5.33329L17.9998 9.99996" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg></span>
                    </a>
                </div>

                @if($visibleFeatures->isNotEmpty())
                    <ul class="feature-list">
                        @foreach($visibleFeatures as $specification)
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M1.33398 7.9987C1.33398 11.6781 4.32122 14.6654 8.00065 14.6654C11.6801 14.6654 14.6673 11.6781 14.6673 7.9987C14.6673 4.31926 11.6801 1.33203 8.00065 1.33203C4.32122 1.33203 1.33398 4.31926 1.33398 7.9987Z" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6 8.0013L7.33333 9.33464L10 6.66797" stroke="#666666" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ $specification->parameter }}{{ $specification->specifications ? ': ' . $specification->specifications : '' }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if($product->features)
                    <hr class="dashed-divider">
                    <div class="product-desc">{!! $product->features !!}</div>
                @endif
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

@include('layouts.form')
@include('layouts.frontfooter')
