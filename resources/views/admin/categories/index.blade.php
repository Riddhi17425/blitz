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
                            <th>Short Form</th>
                            <th>List Image</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->short_form }}</td>
                                <td>
                                    @if($category->list_img)
                                        <img src="{{ asset('public/images/category_list/' . $category->list_img) }}" alt="{{ $category->title }}" style="max-width:120px;" />
                                    @endif
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
@endsection
