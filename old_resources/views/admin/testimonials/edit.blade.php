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
                        <a href="{{ route('testimonials') }}" class="btn btn-primary btn-set-task">Back</a>
                    </div>
                </div> 
            </div>

            {{-- Form Section --}}
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('testimonials.update', $testimonials->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card mb-4 border">
                                    <div class="card-header bg-light"><strong>Testimonials Information</strong></div>
                                    <div class="card-body row">
                                        {{-- Title --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Title <span class="required-star">*</span></label>
                                            <input type="text" name="testimonials_title" id="testimonials_title"
                                                class="form-control @error('testimonials_title') is-invalid @enderror"
                                                value="{{ old('testimonials_title', $testimonials->title) }}" placeholder="Enter Title Here">
                                            @error('testimonials_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Image --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="testimonials_image" id="testimonials_image"
                                                class="form-control color-image-input @error('testimonials_image') is-invalid @enderror" onchange="validateAndPreviewImage()">
                                            @error('testimonials_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($testimonials->image)
                                                <div class="mt-2">
                                                    <img id="preview_testimonials_image" src="{{ asset('public/admin/testimonials/' . $testimonials->image) }}" width="150" height="120" alt="{{ $testimonials->alt_tag }}">
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status <span class="required-star">*</span></label>
                                            <select name="testimonials_status"
                                                class="form-control @error('testimonials_status') is-invalid @enderror">
                                                <option value="Active" {{ old('testimonials_status', $testimonials->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="In-Active" {{ old('testimonials_status', $testimonials->status) == 'In-Active' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('testimonials_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
 
                                        {{-- Alt --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Alt <span class="required-star">*</span></label>
                                            <input type="text" name="testimonials_alt" id="testimonials_alt"
                                                class="form-control @error('testimonials_alt') is-invalid @enderror"
                                                value="{{ old('testimonials_alt', $testimonials->alt_tag) }}" placeholder="Enter Alt Here">
                                            @error('testimonials_alt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Locations <span class="required-star">*</span></label>
                                            <input type="text" name="testimonials_locations" id="testimonials_locations"
                                                class="form-control @error('testimonials_locations') is-invalid @enderror"
                                                value="{{ old('testimonials_locations', $testimonials->locations) }}" placeholder="Enter Locations Here">
                                            @error('testimonials_locations')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Star <span class="required-star">*</span></label>
                                            <input type="text" name="testimonials_star" id="testimonials_star"
                                                class="form-control @error('testimonials_star') is-invalid @enderror"
                                                value="{{ old('testimonials_star', $testimonials->star) }}" placeholder="Enter Star Here">
                                            @error('testimonials_star')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        {{-- Description --}}
                                        <div class="card mb-4 border">
                                            <div class="card-header bg-light"><strong>Description </strong><span class="required-star">*</span></div>
                                            <div class="card-body">
                                                <textarea name="testimonials_desc"
                                                    class="form-control @error('testimonials_desc') is-invalid @enderror"
                                                    rows="4" id="testimonials_desc">{{ old('testimonials_desc', $testimonials->description) }}</textarea>
                                                @error('testimonials_desc')
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
    <script src="{{ asset('public/admin/js/testimonials/testimonials.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#testimonials_desc').summernote({
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
