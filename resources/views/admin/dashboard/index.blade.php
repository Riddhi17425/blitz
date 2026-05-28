@extends('admin.layouts.app')
@section('content')
<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 mb-3">

            <!-- Total Products -->
            <div class="col-lg-6 col-12">
                <div class="alert-success alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-success text-light">
                            <i class="fa fa-cubes fa-lg"></i> <!-- cube icon for products -->
                        </div> 
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Total Products</div>
                            <span class="small">{{ $product_count }}</span>
                        </div> 
                    </div>
                </div>
            </div>

            <!-- Total Inquiries -->
            <div class="col-lg-6 col-12">
                <div class="alert-danger alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-danger text-light">
                            <i class="fa fa-envelope-open fa-lg"></i> <!-- envelope for inquiries -->
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Product Inquiries</div>
                            <span class="small">{{ $product_inquiry }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Row end  -->
    </div>
</div>
@endsection
