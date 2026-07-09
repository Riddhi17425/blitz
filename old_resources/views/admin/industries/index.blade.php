@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold">Industries</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('industries.create') }}" class="btn btn-primary">Add Industry</a>
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
                            <th>Image</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($industries as $industry)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $industry->title }}</td>
                                <td>
                                    @if($industry->image)
                                        <img src="{{ asset('public/images/industries/' . $industry->image) }}" alt="{{ $industry->title }}" style="max-width:120px;" onerror="this.src='{{ asset('public/images/placeholder.png') }}'"/>
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $industry->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('industries.edit', $industry->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('industries.delete', $industry->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this industry?');">
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
