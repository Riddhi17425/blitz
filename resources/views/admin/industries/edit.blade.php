@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold">Edit Industry</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('industries') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <form id="industryForm" action="{{ route('industries.update', $industry->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $industry->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div class="mb-2">
                            @if($industry->image)
                                <img src="{{ asset('public/images/industries/' . $industry->image) }}" alt="{{ $industry->title }}" style="max-width:140px;" onerror="this.src='{{ asset('public/images/placeholder.png') }}'"/>
                            @else
                                <span class="text-muted">No image uploaded</span>
                            @endif
                        </div>
                        <label class="form-label">Replace Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Industry</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#industryForm').validate({
            rules: {
                title: { required: true, maxlength: 255 },
                image: { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                title: { required: 'Title is required.' },
                image: { extension: 'Please upload a JPG, JPEG, PNG, or WEBP image.' }
            }
        });
    });
</script>
@endsection
