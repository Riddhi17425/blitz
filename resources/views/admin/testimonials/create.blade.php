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
                <div id="message-pop-up" class="alert alert-dismissible fade show" role="alert" style="display: none">
                    <span id="success-message"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Add Data</h3>
                        <a href="{{ route('testimonials') }}" class="btn btn-primary btn-set-task">Back</a>
                    </div>
                </div>
            </div> 

            {{-- Form Section --}}
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- whychooseus Info --}}
                                <div class="card mb-4 border">
                                    <div class="card-header bg-light"><strong>Testimonials Information</strong></div>
                                    <div class="card-body row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Title <span
                                                    class="required-star">*</span></label>
                                            <input type="text" name="testimonials_title" id="testimonials_title"
                                                class="form-control @error('testimonials_title') is-invalid @enderror"
                                                value="{{ old('testimonials_title') }}" placeholder="Enter Title Here">
                                            @error('testimonials_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Images <span class="required-star">*</span></label>
                                            <input type="file" name="testimonials_image" id="testimonials_image"
                                                class="form-control @error('testimonials_image') is-invalid @enderror" onchange="validateAndPreviewImage()">
                                                <span class="text-danger" id="span_testimonials_image"></span>
                                            @error('testimonials_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            
                                             <img id="preview_testimonials_image" src="#" alt="Preview" class="mt-2" style="max-width: 100px; height: auto; display: none;" />
                                        </div> 
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger removeColor"
                                                style="display: none;">-</button>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status <span
                                                    class="required-star">*</span></label>
                                            <select name="testimonials_status"
                                                class="form-control @error('testimonials_status') is-invalid @enderror">
                                                <option value="Active"
                                                    {{ old('testimonials_status') == 'Active' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="In-Active"
                                                    {{ old('testimonials_status') == 'In-Active' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                            @error('testimonials_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Alt <span class="required-star">*</span></label>
                                            <input type="text" name="testimonials_alt" id="testimonials_alt"
                                                class="form-control @error('testimonials_alt') is-invalid @enderror"
                                                value="{{ old('testimonials_alt') }}" placeholder="Enter Alt Here">
                                            @error('testimonials_alt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                           
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Locations <span class="required-star">*</span></label>
                                            <input type="text" name="testimonials_locations" id="testimonials_locations"
                                                class="form-control @error('testimonials_locations') is-invalid @enderror"
                                                value="{{ old('testimonials_locations') }}" placeholder="Enter Locations Here">
                                            @error('testimonials_locations')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Star <span class="required-star">*</span></label>
                                            <input type="text" name="testimonials_star" id="testimonials_star"
                                                class="form-control @error('testimonials_star') is-invalid @enderror"
                                                value="{{ old('testimonials_star') }}" placeholder="Enter Star Here">
                                            @error('testimonials_star')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="card mb-4 border">
                                            <div class="card mb-4 border">
                                                <div class="card-header bg-light"><strong>Description </strong><span class="required-star">*</span></div>
                                                <div class="card-body">
                                                    <textarea name="testimonials_desc" class="form-control @error('testimonials_desc') is-invalid @enderror" rows="4"
                                                        id="testimonials_desc">{{ old('testimonials_desc') }}</textarea>
                                                    @error('testimonials_desc')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- Submit --}}
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
