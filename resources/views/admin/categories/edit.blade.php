@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Edit Category</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('categories') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="categoryForm" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="fw-bold mb-3 pb-2 border-bottom text-primary">General Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $category->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Form</label>
                        <input type="text" name="short_form" value="{{ old('short_form', $category->short_form) }}" class="form-control @error('short_form') is-invalid @enderror" placeholder="Short form">
                        @error('short_form')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">Media & Files</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Catalogue PDF</label>
                        @if($category->catalogue_pdf)
                            <div class="mb-2"><a href="{{ asset('storage/' . $category->catalogue_pdf) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-file-earmark-pdf"></i> Download current file</a></div>
                        @else
                            <div class="text-muted small mb-2">No file uploaded</div>
                        @endif
                        <input type="file" name="catalogue_pdf" class="form-control @error('catalogue_pdf') is-invalid @enderror">
                        @error('catalogue_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">List Image</label>
                        @if($category->list_img)
                            <div class="mb-2"><img src="{{ asset('public/images/category_list/' . $category->list_img) }}" style="max-height: 80px;" class="img-thumbnail" alt="List image" onerror="this.src='{{ asset('public/images/placeholder.png') }}'"/></div>
                        @else
                            <div class="text-muted small mb-2">No image uploaded</div>
                        @endif
                        <input type="file" name="list_img" class="form-control @error('list_img') is-invalid @enderror">
                        @error('list_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Detail Image</label>
                        @if($category->detail_img)
                            <div class="mb-2"><img src="{{ asset('public/images/category_detail/' . $category->detail_img) }}" style="max-height: 80px;" class="img-thumbnail" alt="Detail image" onerror="this.src='{{ asset('public/images/placeholder.png') }}'"/></div>
                        @else
                            <div class="text-muted small mb-2">No image uploaded</div>
                        @endif
                        <input type="file" name="detail_img" class="form-control @error('detail_img') is-invalid @enderror">
                        @error('detail_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">CTA Section</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image Desktop</label>
                        @if($category->cta_img_desktop)
                            <div class="mb-2"><img src="{{ asset('public/images/category_cta_desktop/' . $category->cta_img_desktop) }}" style="max-height: 80px;" class="img-thumbnail" alt="CTA desktop" onerror="this.src='{{ asset('public/images/placeholder.png') }}'"/></div>
                        @else
                            <div class="text-muted small mb-2">No desktop CTA image.</div>
                        @endif
                        <input type="file" name="cta_img_desktop" class="form-control @error('cta_img_desktop') is-invalid @enderror">
                        @error('cta_img_desktop')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image Mobile</label>
                        @if($category->cta_img_mobile)
                            <div class="mb-2"><img src="{{ asset('public/images/category_cta_mobile/' . $category->cta_img_mobile) }}" style="max-height: 80px;" class="img-thumbnail" alt="CTA mobile" onerror="this.src='{{ asset('public/images/placeholder.png') }}'"/></div>
                        @else
                            <div class="text-muted small mb-2">No mobile CTA image.</div>
                        @endif
                        <input type="file" name="cta_img_mobile" class="form-control @error('cta_img_mobile') is-invalid @enderror">
                        @error('cta_img_mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">CTA Image Title</label>
                        <input type="text" name="cta_img_title" value="{{ old('cta_img_title', $category->cta_img_title) }}" class="form-control @error('cta_img_title') is-invalid @enderror" placeholder="CTA title">
                        @error('cta_img_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">CTA Image Description</label>
                        <textarea id="cta_img_description" name="cta_img_description" class="form-control @error('cta_img_description') is-invalid @enderror" rows="4">{{ old('cta_img_description', $category->cta_img_description) }}</textarea>
                        @error('cta_img_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
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

        $('#categoryForm').validate({
            rules: {
                title: { required: true, maxlength: 255 },
                short_form: { maxlength: 255 },
                catalogue_pdf: { extension: 'pdf' },
                list_img: { extension: 'jpg|jpeg|png|webp' },
                detail_img: { extension: 'jpg|jpeg|png|webp' },
                cta_img_desktop: { extension: 'jpg|jpeg|png|webp' },
                cta_img_mobile: { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                title: { required: 'Title is required.' },
                catalogue_pdf: { extension: 'Only PDF files are allowed.' }
            }
        });
    });
</script>
@endsection