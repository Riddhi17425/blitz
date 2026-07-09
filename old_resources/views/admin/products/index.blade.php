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
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Product Name</th>
                                <th>URL</th>
                                <th>Product Model</th>
                                <th style="width: 120px;">List Image</th>
                                <th style="width: 150px;">Datasheet (PDF)</th>
                                <th>Featured</th>
                                <th>Active</th>
                                <th>Created At</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->category?->title ?? '—' }}</td>
                                    <td>{{ $product->subCategory?->title ?? '—' }}</td>
                                    <td class="fw-bold">{{ $product->product_name }}</td>
                                    <td>{{ $product->product_url }}</td>
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
                                    <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input js-toggle-flag" type="checkbox" data-url="{{ route('products.toggle_flag', $product->id) }}" data-field="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input js-toggle-flag" type="checkbox" data-url="{{ route('products.toggle_flag', $product->id) }}" data-field="is_active" {{ $product->is_active || is_null($product->is_active) ? 'checked' : '' }}>
                                        </div>
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
<script>
    $(document).on('change', '.js-toggle-flag', function() {
        const checkbox = $(this);
        checkbox.prop('disabled', true);
        $.ajax({
            url: checkbox.data('url'),
            type: 'PATCH',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                field: checkbox.data('field'),
                value: checkbox.is(':checked') ? 1 : 0
            },
            complete: function() {
                checkbox.prop('disabled', false);
            },
            error: function(xhr) {
                checkbox.prop('checked', !checkbox.is(':checked'));
                const message = xhr.responseJSON?.message || 'Unable to update status.';
                alert(message);
            }
        });
    });
</script>
@endsection
