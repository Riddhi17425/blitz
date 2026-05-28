@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">FAQs</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('faqs.create') }}" class="btn btn-primary">Add FAQ Group</a></div>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <table class="table table-bordered" id="myDataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>FAQ Items</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <ul class="mb-0">
                                    @foreach($faq->faq_items as $item)
                                        <li><strong>{{ $item['title'] ?? '' }}</strong><br>{{ $item['description'] ?? '' }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $faq->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('faqs.delete', $faq->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this FAQ group?');">
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
