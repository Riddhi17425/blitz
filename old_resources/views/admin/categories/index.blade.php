@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold">Categories</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="myDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Short Form</th>
                            <th>List Image</th>
                            <th>Active</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->category_url }}</td>
                                <td>{{ $category->short_form }}</td>
                                <td>
                                    @if($category->list_img)
                                        <img src="{{ asset('public/images/category_list/' . $category->list_img) }}" alt="{{ $category->title }}" style="max-width:120px;" />
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input js-toggle-flag" type="checkbox" data-url="{{ route('categories.toggle_flag', $category->id) }}" data-field="is_active" {{ $category->is_active || is_null($category->is_active) ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
