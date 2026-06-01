@extends('admin.layouts.app')

@section('content')
@php
    $oldTitles = old('cta_title');
    $oldDescriptions = old('cta_description');
    $oldExistingIcons = old('existing_cta_icon');

    $ctaItems = [];
    if (is_array($oldTitles)) {
        foreach ($oldTitles as $idx => $title) {
            $ctaItems[] = [
                'title' => $title,
                'description' => $oldDescriptions[$idx] ?? '',
                'icon' => $oldExistingIcons[$idx] ?? null
            ];
        }
    } else {
        $dbTitles = $subCategory->cta_title ?? [];
        $dbDescriptions = $subCategory->cta_description ?? [];
        $dbIcons = $subCategory->cta_icon ?? [];
        
        $maxCount = max(count($dbTitles), count($dbDescriptions), count($dbIcons));
        for ($i = 0; $i < $maxCount; $i++) {
            $ctaItems[] = [
                'title' => $dbTitles[$i] ?? '',
                'description' => $dbDescriptions[$i] ?? '',
                'icon' => $dbIcons[$i] ?? null
            ];
        }
    }
@endphp
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Edit Sub Category</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('sub_categories') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="subCategoryForm" action="{{ route('sub_categories.update', $subCategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="fw-bold mb-3 pb-2 border-bottom text-primary">General Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $subCategory->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $subCategory->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Category URL <span class="text-danger">*</span></label>
                        <input type="text" name="sub_category_url" id="sub_category_url" value="{{ old('sub_category_url', $subCategory->sub_category_url ?: \Illuminate\Support\Str::slug($subCategory->title)) }}" class="form-control @error('sub_category_url') is-invalid @enderror" placeholder="sub-category-url" required>
                        @error('sub_category_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Form <span class="text-danger">*</span></label>
                        <input type="text" name="short_form" value="{{ old('short_form', $subCategory->short_form) }}" class="form-control @error('short_form') is-invalid @enderror" placeholder="Short form" required>
                        @error('short_form')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3" placeholder="Enter short description">{{ old('short_description', $subCategory->short_description) }}</textarea>
                        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control summernote @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $subCategory->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">Media & Files</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Catalogue PDF</label>
                        @if($subCategory->catalogue_pdf)
                            <div class="mb-2"><a href="{{ asset('storage/app/public/' . $subCategory->catalogue_pdf) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-file-earmark-pdf"></i> Download current file</a></div>
                        @else
                            <div class="text-muted small mb-2">No file uploaded</div>
                        @endif
                        <input type="file" name="catalogue_pdf" class="form-control @error('catalogue_pdf') is-invalid @enderror">
                        @error('catalogue_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">List Image</label>
                        @if($subCategory->list_img)
                            <div class="mb-2"><img src="{{ asset('/public/images/sub_category_list/' . $subCategory->list_img) }}" style="max-height: 80px;" class="img-thumbnail" alt="List image"></div>
                        @else
                            <div class="text-muted small mb-2">No image uploaded</div>
                        @endif
                        <input type="file" name="list_img" class="form-control @error('list_img') is-invalid @enderror">
                        @error('list_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Detail Image</label>
                        @if($subCategory->detail_img)
                            <div class="mb-2"><img src="{{ asset('/public/images/sub_category_detail/' . $subCategory->detail_img) }}" style="max-height: 80px;" class="img-thumbnail" alt="Detail image"></div>
                        @else
                            <div class="text-muted small mb-2">No image uploaded</div>
                        @endif
                        <input type="file" name="detail_img" class="form-control @error('detail_img') is-invalid @enderror">
                        @error('detail_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">CTA Image Section</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image</label>
                        @if($subCategory->cta_img)
                            <div class="mb-2"><img src="{{ asset('/public/images/sub_category_cta/' . $subCategory->cta_img) }}" style="max-height: 80px;" class="img-thumbnail" alt="CTA image"></div>
                        @else
                            <div class="text-muted small mb-2">No image uploaded</div>
                        @endif
                        <input type="file" name="cta_img" class="form-control @error('cta_img') is-invalid @enderror">
                        @error('cta_img')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image Title</label>
                        <input type="text" name="cta_img_title" value="{{ old('cta_img_title', $subCategory->cta_img_title) }}" class="form-control @error('cta_img_title') is-invalid @enderror" placeholder="CTA image title">
                        @error('cta_img_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">CTA Image Description</label>
                        <textarea id="cta_img_description" name="cta_img_description" class="form-control summernote @error('cta_img_description') is-invalid @enderror" rows="4">{{ old('cta_img_description', $subCategory->cta_img_description) }}</textarea>
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
                <button type="submit" class="btn btn-primary">Update Sub Category</button>
            </form>
        </div></div>
    </div>
</div>

<script>
    // Inject FAQs section for edit page
    $(function() {
        const faqTitle = {!! json_encode(old('faq_title', $subCategory->faq_title ?? '')) !!};
        const faqDescription = {!! json_encode(old('faq_description', $subCategory->faq_description ?? '')) !!};
        const faqsSection = `
            <div class="d-flex justify-content-between align-items-center my-4 pb-2 border-bottom">
                <h5 class="fw-bold mb-0 text-primary">FAQs</h5>
            </div>
            <div class="row mb-4">
                <div class="col-md-12 mb-3">
                    <label class="form-label">FAQ Title</label>
                    <input type="text" name="faq_title" value="${faqTitle}" class="form-control @error('faq_title') is-invalid @enderror" placeholder="FAQ title">
                    @error('faq_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">FAQ Description</label>
                    <textarea id="faq_description" name="faq_description" class="form-control summernote @error('faq_description') is-invalid @enderror" rows="4">${faqDescription}</textarea>
                    @error('faq_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-12 mb-3 text-end">
                    <button type="button" class="btn btn-sm btn-primary" id="add-faq"><i class="fa fa-plus"></i> Add FAQ</button>
                </div>
            </div>
            <div id="faqs-container" class="mb-4"></div>
        `;
        $('#cta-items-container').after(faqsSection);

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
            $('#' + id).summernote({ height: 150, toolbar: [['style', ['bold','italic','underline']], ['para', ['ul','ol','paragraph']], ['insert', ['link','picture']], ['view', ['codeview']]] });
            faqIndex++;
        }

        $(document).on('click', '#add-faq', function() { addFaq(); });
        $(document).on('click', '.remove-faq', function() { $(this).closest('.card').remove(); });

        // initialize from old input or existing data
        @php
            $oldQ = old('faqs_question', []);
            $oldA = old('faqs_answer', []);
        @endphp
        @if(!empty($oldQ))
            @foreach($oldQ as $i => $q)
                addFaq({!! json_encode($q) !!}, {!! json_encode($oldA[$i] ?? '') !!});
            @endforeach
        @else
            @php $existingFaqs = $subCategory->faqs ?? []; @endphp
            @if(!empty($existingFaqs))
                @foreach($existingFaqs as $f)
                    addFaq({!! json_encode($f['question'] ?? '') !!}, {!! json_encode($f['answer'] ?? '') !!});
                @endforeach
            @endif
        @endif
    });
</script>
<script>
    let ctaIndex = 0;
    function addCtaItem(title = '', description = '', iconName = '') {
        const container = $('#cta-items-container');
        let iconHtml = '';
        if (iconName) {
            const assetUrl = "{{ asset('/public/images/sub_category_cta_icons') }}/" + iconName;
            iconHtml = `
                <div class="mb-2 d-flex align-items-center gap-2">
                    <img src="${assetUrl}" style="max-height: 50px;" class="img-thumbnail" alt="Icon">
                    <span class="text-muted small">${iconName}</span>
                    <input type="hidden" name="existing_cta_icon[${ctaIndex}]" value="${iconName}">
                </div>
            `;
        }
        
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
                            ${iconHtml}
                            <input type="file" name="cta_icon[${ctaIndex}]" class="form-control" accept="image/*">
                            <small class="text-muted">Leave empty to keep current icon</small>
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

        // Initialize from existing items
        @foreach($ctaItems as $item)
            addCtaItem(
                {!! json_encode($item['title']) !!},
                {!! json_encode($item['description']) !!},
                {!! json_encode($item['icon']) !!}
            );
        @endforeach
        
        if (ctaIndex === 0) {
            addCtaItem();
        }

        $.validator.addMethod('summernoteRequired', function(value, element) {
            if ($(element).hasClass('summernote')) {
                return $(element).summernote('isEmpty') === false;
            }
            return $.trim(value).length > 0;
        }, 'This field is required.');

        // Initialize Summernote
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

        $('#description,#cta_img_description,#faq_description').on('summernote.change', function() {
            $(this).valid();
        });

        function slugify(value) {
            return value.toString().toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
        $('#sub_category_url').on('input', function() {
            $(this).val(slugify($(this).val()));
        });

        $('#subCategoryForm').validate({
            ignore: [],
            rules: {
                category_id: { required: true },
                title: { required: true, maxlength: 255 },
                sub_category_url: { required: true, maxlength: 255 },
                short_form: { required: true, maxlength: 255 },
                description: { summernoteRequired: true },
                catalogue_pdf: { extension: 'pdf' },
                list_img: { extension: 'jpg|jpeg|png|webp' },
                detail_img: { extension: 'jpg|jpeg|png|webp' },
                cta_img: { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                sub_category_url: { required: 'Sub Category URL is required.' },
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
</script>
@endsection
