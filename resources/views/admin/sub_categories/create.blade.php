@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Add Sub Category</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('sub_categories') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="subCategoryForm" action="{{ route('sub_categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="fw-bold mb-3 pb-2 border-bottom text-primary">General Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Form</label>
                        <input type="text" name="short_form" value="{{ old('short_form') }}" class="form-control @error('short_form') is-invalid @enderror" placeholder="Short form">
                        @error('short_form')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3" placeholder="Enter short description">{{ old('short_description') }}</textarea>
                        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
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
                        <label class="form-label">List Image</label>
                        <input type="file" name="list_img" class="form-control @error('list_img') is-invalid @enderror">
                        @error('list_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Detail Image</label>
                        <input type="file" name="detail_img" class="form-control @error('detail_img') is-invalid @enderror">
                        @error('detail_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">CTA Image Section</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image</label>
                        <input type="file" name="cta_img" class="form-control @error('cta_img') is-invalid @enderror">
                        @error('cta_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image Title</label>
                        <input type="text" name="cta_img_title" value="{{ old('cta_img_title') }}" class="form-control @error('cta_img_title') is-invalid @enderror" placeholder="CTA image title">
                        @error('cta_img_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">CTA Image Description</label>
                        <textarea id="cta_img_description" name="cta_img_description" class="form-control @error('cta_img_description') is-invalid @enderror" rows="4">{{ old('cta_img_description') }}</textarea>
                        @error('cta_img_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center my-4 pb-2 border-bottom">
                    <h5 class="fw-bold mb-0 text-primary">CTA Items</h5>
                    <button type="button" class="btn btn-sm btn-primary" id="add-cta-item"><i class="fa fa-plus"></i> Add CTA Item</button>
                </div>
                <div id="cta-items-container" class="mb-4">
                    <!-- Dynamic CTA items will be appended here -->
                </div>
                <button type="submit" class="btn btn-primary">Save Sub Category</button>
            </form>
        </div></div>
    </div>
</div>

<script>
    let ctaIndex = 0;
    function addCtaItem(title = '', description = '') {
        const container = $('#cta-items-container');
        const itemHtml = `
            <div class="cta-item card mb-3 bg-light border" data-index="${ctaIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">CTA Item #${ctaIndex + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-cta-item"><i class="fa fa-trash"></i> Remove</button>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CTA Icon</label>
                            <input type="file" name="cta_icon[${ctaIndex}]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CTA Title</label>
                            <input type="text" name="cta_title[${ctaIndex}]" value="${title}" class="form-control" placeholder="Enter CTA Title">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CTA Description</label>
                            <textarea name="cta_description[${ctaIndex}]" class="form-control" rows="2" placeholder="Enter CTA Description">${description}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.append(itemHtml);
        ctaIndex++;
        updateCtaHeaders();
    }

    function updateCtaHeaders() {
        $('#cta-items-container .cta-item').each(function(idx) {
            $(this).find('h6').text('CTA Item #' + (idx + 1));
        });
    }

    $(function() {
        $(document).on('click', '.remove-cta-item', function() {
            $(this).closest('.cta-item').remove();
            updateCtaHeaders();
        });

        $('#add-cta-item').click(function() {
            addCtaItem();
        });

        // Initialize from old input if exists
        @php
            $oldTitles = old('cta_title', []);
            $oldDescriptions = old('cta_description', []);
        @endphp

        @if(!empty($oldTitles))
            @foreach($oldTitles as $idx => $title)
                addCtaItem(
                    {!! json_encode($title) !!},
                    {!! json_encode($oldDescriptions[$idx] ?? '') !!}
                );
            @endforeach
        @else
            // Add one empty item by default
            addCtaItem();
        @endif

        $('#description').summernote({
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

        $('#cta_img_description').summernote({
            placeholder: 'Enter CTA description here...',
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

        $('#subCategoryForm').validate({
            rules: {
                title: { required: true, maxlength: 255 },
                short_form: { maxlength: 255 },
                catalogue_pdf: { extension: 'pdf' },
                list_img: { extension: 'jpg|jpeg|png|webp' },
                detail_img: { extension: 'jpg|jpeg|png|webp' },
                cta_img: { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                title: { required: 'Title is required.' },
                catalogue_pdf: { extension: 'Only PDF files are allowed.' }
            }
        });
    });
</script>
@endsection
