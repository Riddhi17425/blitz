@extends('admin.layouts.app')
@section('content')
<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-4">

            <!-- Theme Card: Products -->
            <div class="col-lg-6 col-12">
                <div class="p-4 rounded-4 shadow-sm bg-primary bg-gradient text-white h-100">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="text-uppercase small fw-semibold opacity-75">
                                Total Products
                            </div>
                            <div class="display-5 fw-bold">
                                {{ $productCount }}
                            </div>
                            <div class="small opacity-75">
                                Available in system
                            </div>
                        </div>

                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center shadow"
                            style="width:70px; height:70px;">
                            <i class="fa fa-cubes fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Theme Card: Industries -->
            <div class="col-lg-6 col-12">
                <div class="p-4 rounded-4 shadow-sm bg-danger bg-gradient text-dark h-100">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="text-uppercase small fw-semibold opacity-75">
                                Industries
                            </div>
                            <div class="display-5 fw-bold">
                                {{ $industryCount }}
                            </div>
                            <div class="small opacity-75">
                                Business categories
                            </div>
                        </div>

                        <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center shadow"
                            style="width:70px; height:70px;">
                            <i class="fa fa-industry fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
