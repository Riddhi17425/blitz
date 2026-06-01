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
                        <input type="text" name="title" id="title" value="{{ old('title', $category->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category URL <span class="text-danger">*</span></label>
                        <input type="text" name="category_url" id="category_url" value="{{ old('category_url', $category->category_url ?: \Illuminate\Support\Str::slug($category->title)) }}" class="form-control @error('category_url') is-invalid @enderror" placeholder="category-url" required>
                        @error('category_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Form <span class="text-danger">*</span></label>
                        <input type="text" name="short_form" value="{{ old('short_form', $category->short_form) }}" class="form-control @error('short_form') is-invalid @enderror" placeholder="Short form" required>
                        @error('short_form')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea id="description" name="description" class="form-control summernote @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $category->description) }}</textarea>
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
                        <textarea id="cta_img_description" name="cta_img_description" class="form-control summernote @error('cta_img_description') is-invalid @enderror" rows="4">{{ old('cta_img_description', $category->cta_img_description) }}</textarea>
                        @error('cta_img_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">Sub Category Settings</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Category Heading</label>
                        <input type="text" name="sub_category_heading" value="{{ old('sub_category_heading', $category->sub_category_heading) }}" class="form-control @error('sub_category_heading') is-invalid @enderror" placeholder="Sub Category Heading">
                        @error('sub_category_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Sub Category Description</label>
                        <textarea name="sub_category_description" class="form-control summernote @error('sub_category_description') is-invalid @enderror" rows="4">{{ old('sub_category_description', $category->sub_category_description) }}</textarea>
                        @error('sub_category_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center my-4 pb-2 border-bottom">
                    <h5 class="fw-bold mb-0 text-primary">FAQs</h5>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">FAQ Title</label>
                        <input type="text" name="faq_title" value="{{ old('faq_title', $category->faq_title) }}" class="form-control @error('faq_title') is-invalid @enderror" placeholder="FAQ title">
                        @error('faq_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">FAQ Description</label>
                        <textarea id="faq_description" name="faq_description" class="form-control summernote @error('faq_description') is-invalid @enderror" rows="4">{{ old('faq_description', $category->faq_description) }}</textarea>
                        @error('faq_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3 text-end">
                        <button type="button" class="btn btn-sm btn-primary" id="add-faq"><i class="fa fa-plus"></i> Add FAQ</button>
                    </div>
                </div>
                <div id="faqs-container" class="mb-4"></div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div></div>
    </div>
</div>

<script>
    $(function() {
        $.validator.addMethod('summernoteRequired', function(value, element) {
            if ($(element).hasClass('summernote')) {
                return $(element).summernote('isEmpty') === false;
            }
            return $.trim(value).length > 0;
        }, 'This field is required.');

        $('#description,#cta_img_description,#faq_description').summernote({
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

        $('#description,#cta_img_description,#faq_description').on('summernote.change summernote.blur', function() {
            $(this).valid();
        });

        function slugify(value) {
            return value.toString().toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
        $('#category_url').on('input', function() {
            $(this).val(slugify($(this).val()));
        });

        $('#categoryForm').validate({
            ignore: [],
            rules: {
                title: { required: true, maxlength: 255 },
                category_url: { required: true, maxlength: 255 },
                short_form: { required: true, maxlength: 255 },
                description: { summernoteRequired: true },
                catalogue_pdf: { extension: 'pdf' },
                list_img: { extension: 'jpg|jpeg|png|webp' },
                detail_img: { extension: 'jpg|jpeg|png|webp' },
                cta_img_desktop: { extension: 'jpg|jpeg|png|webp' },
                cta_img_mobile: { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                title: { required: 'Title is required.' },
                category_url: { required: 'Category URL is required.' },
                short_form: { required: 'Short Form is required.' },
                description: { summernoteRequired: 'Description is required.' },
                catalogue_pdf: { extension: 'Only PDF files are allowed.' }
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('summernote')) {
                    error.addClass('invalid-feedback');
                    element.next('.note-editor').after(error);
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
    // FAQs handling for edit
    let faqIndex = 0;
    function addFaq(question = '', answer = '') {
        const id = 'faq_answer_' + faqIndex;
        const html = `
            <div class="card mb-3 p-2" data-index="${faqIndex}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0">FAQ #${faqIndex + 1}</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-faq">Remove</button>
                </div>
                <div class="mb-2">
                    <label class="form-label">Question</label>
                    <input type="text" name="faqs_question[${faqIndex}]" value="${question}" class="form-control">
                </div>
                <div>
                    <label class="form-label">Answer</label>
                    <textarea id="${id}" name="faqs_answer[${faqIndex}]" class="form-control summernote">${answer}</textarea>
                </div>
            </div>
        `;
        $('#faqs-container').append(html);
        // initialize summernote
        $('#' + id).summernote({ height: 150, toolbar: [['style', ['bold','italic','underline']], ['para', ['ul','ol','paragraph']], ['insert', ['link','picture']], ['view', ['codeview']]] });
        faqIndex++;
    }

    $(document).on('click', '#add-faq', function() { addFaq(); });
    $(document).on('click', '.remove-faq', function() { $(this).closest('.card').remove(); });

    $(function() {
        // initialize from existing category faqs or old input
        @php
            $oldQ = old('faqs_question', []);
            $oldA = old('faqs_answer', []);
        @endphp
        @if(!empty($oldQ))
            @foreach($oldQ as $i => $q)
                addFaq({!! json_encode($q) !!}, {!! json_encode($oldA[$i] ?? '') !!});
            @endforeach
        @else
            @php $existingFaqs = $category->faqs ?? []; @endphp
            @if(!empty($existingFaqs))
                @foreach($existingFaqs as $f)
                    addFaq({!! json_encode($f['question'] ?? '') !!}, {!! json_encode($f['answer'] ?? '') !!});
                @endforeach
            @else
                addFaq();
            @endif
        @endif
    });
</script>
@endsection
