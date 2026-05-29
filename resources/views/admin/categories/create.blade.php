@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Add Category</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('categories') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="categoryForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="fw-bold mb-3 pb-2 border-bottom text-primary">General Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Form <span class="text-danger">*</span></label>
                        <input type="text" name="short_form" value="{{ old('short_form') }}" class="form-control @error('short_form') is-invalid @enderror" placeholder="Short form" required>
                        @error('short_form')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea id="description" name="description" class="form-control summernote @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">Media & Files</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Catalogue PDF</label>
                        <input type="file" name="catalogue_pdf" class="form-control @error('catalogue_pdf') is-invalid @enderror">
                        <small class="text-muted">Max size: 5MB</small>
                        @error('catalogue_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">List Image <span class="text-danger">*</span></label>
                        <input type="file" name="list_img" class="form-control @error('list_img') is-invalid @enderror" required>
                        @error('list_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Detail Image <span class="text-danger">*</span></label>
                        <input type="file" name="detail_img" class="form-control @error('detail_img') is-invalid @enderror" required>
                        @error('detail_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">CTA Section</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image Desktop</label>
                        <input type="file" name="cta_img_desktop" class="form-control @error('cta_img_desktop') is-invalid @enderror">
                        @error('cta_img_desktop')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image Mobile</label>
                        <input type="file" name="cta_img_mobile" class="form-control @error('cta_img_mobile') is-invalid @enderror">
                        @error('cta_img_mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">CTA Image Title</label>
                        <input type="text" name="cta_img_title" value="{{ old('cta_img_title') }}" class="form-control @error('cta_img_title') is-invalid @enderror" placeholder="CTA title">
                        @error('cta_img_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">CTA Image Description</label>
                        <textarea id="cta_img_description" name="cta_img_description" class="form-control summernote @error('cta_img_description') is-invalid @enderror" rows="4">{{ old('cta_img_description') }}</textarea>
                        @error('cta_img_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </form>
        </div></div>
    </div>
</div>


<script>
    $(function() {
        $('#description,#cta_img_description').summernote({
            placeholder: 'Enter description here...',
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });

        $('#description,#cta_img_description').on('summernote.change', function() {
            $(this).valid();
        });
        
        $('#categoryForm').validate({
            ignore: [],
            rules: {
                title: { required: true, maxlength: 255 },
                short_form: { required: true, maxlength: 255 },
                description: { required: true },
                catalogue_pdf: { extension: 'pdf' },
                list_img: { required: true, extension: 'jpg|jpeg|png|webp' },
                detail_img: { required: true, extension: 'jpg|jpeg|png|webp' },
                cta_img_desktop: { extension: 'jpg|jpeg|png|webp' },
                cta_img_mobile: { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                title: { required: 'Title is required.', maxlength: 'Title must be less than 255 characters.' },
                short_form: { required: 'Short Form is required.', maxlength: 'Short Form must be less than 255 characters.' },
                description: { required: 'Description is required.' },
                catalogue_pdf: { extension: 'Only PDF files are allowed.' }
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('summernote')) {
                    error.insertAfter(element.next('.note-editor'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
                if ($(element).hasClass('summernote')) {
                    $(element).next('.note-editor').find('.note-editable').addClass('is-invalid');
                }
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                if ($(element).hasClass('summernote')) {
                    $(element).next('.note-editor').find('.note-editable').removeClass('is-invalid');
                }
            }
        });
    });
</script>
@endsection
