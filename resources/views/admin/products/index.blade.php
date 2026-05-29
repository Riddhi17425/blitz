@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold">Products</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="myDataTable">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Product Name</th>
                                <th>Product Model</th>
                                <th style="width: 120px;">List Image</th>
                                <th style="width: 150px;">Datasheet (PDF)</th>
                                <th>Created At</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold">{{ $product->product_name }}</td>
                                    <td><span class="badge bg-secondary">{{ $product->product_modal }}</span></td>
                                    <td>
                                        @if($product->list_image)
                                            <img src="{{ asset('public/images/product_list_images/' . $product->list_image) }}" alt="{{ $product->product_name }}" class="img-thumbnail" style="max-width:80px; max-height:60px; object-fit:contain;" />
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->datasheet)
                                            <a href="{{ route('products.datasheet.download', $product->id) }}" class="btn btn-sm btn-outline-danger">
                                                <i class="icofont-file-pdf"></i> Download PDF
                                            </a>
                                        @else
                                            <span class="text-muted">No PDF</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="icofont-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('products.delete', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                                    <i class="icofont-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
