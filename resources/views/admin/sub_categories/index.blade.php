@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Sub Categories</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('sub_categories.create') }}" class="btn btn-primary">Add Sub Category</a></div>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <table class="table table-bordered" id="myDataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Short Form</th>
                        <th>List Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subCategories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category?->title ?? '—' }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->sub_category_url }}</td>
                            <td>{{ $item->short_form }}</td>
                            <td>
                                @if($item->list_img)
                                    <img src="{{ asset('/public/images/sub_category_list/' . $item->list_img) }}" alt="{{ $item->title }}" style="max-width:120px;" />
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input js-toggle-flag" type="checkbox" data-url="{{ route('sub_categories.toggle_flag', $item->id) }}" data-field="is_active" {{ $item->is_active || is_null($item->is_active) ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('sub_categories.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('sub_categories.delete', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this sub category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
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
