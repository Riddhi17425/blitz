@extends('admin.layouts.app')

@section('content')
    <style>
        .required-star {
            color: red;
        }
    </style>
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            {{-- Page Header --}}
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Edit Data</h3>
                        <a href="{{ route('banners') }}" class="btn btn-primary btn-set-task">Back</a>
                    </div>
                </div> 
            </div>

            {{-- Form Section --}}
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('banners.update', $banners->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card mb-4 border">
                                    <div class="card-header bg-light"><strong>Banners Information</strong></div>
                                    <div class="card-body row">
                                        {{-- Title --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Title <span class="required-star">*</span></label>
                                            <input type="text" name="banners_title" id="banners_title"
                                                class="form-control @error('banners_title') is-invalid @enderror"
                                                value="{{ old('banners_title', $banners->title) }}" placeholder="Enter Title Here">
                                            @error('banners_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Category <span class="required-star">*</span></label>
                                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $banners->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Image --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="banners_image" id="banners_image"
                                                class="form-control color-image-input @error('banners_image') is-invalid @enderror" onchange="validateAndPreviewImage()">
                                            @error('banners_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($banners->image)
                                                <div class="mt-2">
                                                    <img id="preview_banners_image" src="{{ asset('public/admin/banners/' . $banners->image) }}" width="150" height="120" alt="{{ $banners->alt_tag }}">
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Mobile Image --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Mobile Image</label>
                                            <input type="file" name="banners_mobile_image" id="banners_mobile_image"
                                                class="form-control @error('banners_mobile_image') is-invalid @enderror">
                                            @error('banners_mobile_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($banners->mobile_image)
                                                <div class="mt-2">
                                                    <img id="preview_banners_mobile_image" src="{{ asset('public/admin/banners/' . $banners->mobile_image) }}" width="150" height="120" alt="{{ $banners->alt_tag }}">
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status <span class="required-star">*</span></label>
                                            <select name="banners_status"
                                                class="form-control @error('banners_status') is-invalid @enderror">
                                                <option value="Active" {{ old('banners_status', $banners->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="In-Active" {{ old('banners_status', $banners->status) == 'In-Active' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('banners_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
 
                                        {{-- Alt --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Alt <span class="required-star">*</span></label>
                                            <input type="text" name="banners_alt" id="banners_alt"
                                                class="form-control @error('banners_alt') is-invalid @enderror"
                                                value="{{ old('banners_alt', $banners->alt_tag) }}" placeholder="Enter Alt Here">
                                            @error('banners_alt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        
                                        
                                        {{-- Description --}}
                                        <div class="card mb-4 border">
                                            <div class="card-header bg-light"><strong>Description </strong><span class="required-star">*</span></div>
                                            <div class="card-body">
                                                <textarea name="banners_desc"
                                                    class="form-control @error('banners_desc') is-invalid @enderror"
                                                    rows="4" id="banners_desc">{{ old('banners_desc', $banners->description) }}</textarea>
                                                @error('banners_desc')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                            </form>
                        </div> {{-- End Card Body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Section --}}
    <script src="{{ asset('public/admin/js/banners/banners.js') }}" defer></script>

    <script>
        $(document).ready(function() {
            $('#banners_desc').summernote({
                placeholder: 'Enter Description here...',
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
            });
        });
    </script>
@endsection
