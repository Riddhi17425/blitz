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
                        <th>Title</th>
                        <th>Short Form</th>
                        <th>List Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subCategories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->short_form }}</td>
                            <td>
                                @if($item->list_img)
                                    <img src="{{ asset('/public/images/sub_category_list/' . $item->list_img) }}" alt="{{ $item->title }}" style="max-width:120px;" />
                                @endif
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
@endsection
