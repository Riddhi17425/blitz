@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold">Edit Product</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('products') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form id="productForm" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- General Information -->
                    <h5 class="fw-bold mb-3 pb-2 border-bottom text-primary"><i class="icofont-info-circle"></i> General Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Sub Category <span class="text-danger">*</span></label>
                            <select name="sub_category_id" id="sub_category_id" class="form-control @error('sub_category_id') is-invalid @enderror" required>
                                <option value="">Select Sub Category</option>
                                @foreach($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ old('sub_category_id', $product->sub_category_id) == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->title }}</option>
                                @endforeach
                            </select>
                            @error('sub_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $product->product_name) }}" class="form-control @error('product_name') is-invalid @enderror" placeholder="Enter product name" required>
                            @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Product URL <span class="text-danger">*</span></label>
                            <input type="text" name="product_url" id="product_url" value="{{ old('product_url', $product->product_url ?: \Illuminate\Support\Str::slug($product->product_name)) }}" class="form-control @error('product_url') is-invalid @enderror" placeholder="product-url" required>
                            @error('product_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Product Model <span class="text-danger">*</span></label>
                            <input type="text" name="product_modal" value="{{ old('product_modal', $product->product_modal) }}" class="form-control @error('product_modal') is-invalid @enderror" placeholder="Enter product model" required>
                            @error('product_modal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Featured</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_featured" value="0">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Active</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', is_null($product->is_active) ? 1 : $product->is_active) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                    <!-- Descriptions (Summernote) -->
                    <h5 class="fw-bold my-4 pb-2 border-bottom text-primary"><i class="icofont-align-left"></i> Description & Features</h5>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" class="form-control summernote @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Features (Optional)</label>
                            <textarea id="features" name="features" class="form-control summernote @error('features') is-invalid @enderror" rows="5">{{ old('features', $product->features) }}</textarea>
                            @error('features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Files & Media -->
                    <h5 class="fw-bold my-4 pb-2 border-bottom text-primary"><i class="icofont-image"></i> Files & Media</h5>
                    <div class="row">
                        <!-- Datasheet -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Datasheet (PDF)</label>
                            <input type="file" name="datasheet" class="form-control @error('datasheet') is-invalid @enderror">
                            @if($product->datasheet)
                                <div class="mt-2">
                                    <a href="{{ route('products.datasheet.download', $product->id) }}" class="text-danger fw-bold"><i class="icofont-file-pdf"></i> Download Current PDF</a>
                                </div>
                            @endif
                            <small class="text-muted">Upload product specifications in PDF format (Max: 10MB). Leave empty to keep current.</small>
                            @error('datasheet')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        <!-- List Image -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">List Image</label>
                            <input type="file" name="list_image" class="form-control @error('list_image') is-invalid @enderror">
                            @if($product->list_image)
                                <div class="mt-2">
                                    <img src="{{ asset('public/images/product_list_images/' . $product->list_image) }}" alt="Current List Image" class="img-thumbnail" style="max-height: 80px;" />
                                </div>
                            @endif
                            <small class="text-muted">Leave empty to keep current. (Max: 2MB)</small>
                            @error('list_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Detail Images -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Detail Images (Multiple)</label>
                            <input type="file" name="detail_images[]" id="detailImagesInput" class="form-control @error('detail_images') is-invalid @enderror" multiple>
                            @if(!empty($product->detail_images))
                                <div class="detail-images-preview d-flex flex-wrap gap-3 mt-3">
                                    @foreach($product->detail_images as $detail)
                                        <div class="position-relative detail-image-preview-container border rounded p-1">
                                            <img src="{{ asset('public/images/product_detail_images/' . $detail) }}" alt="Detail Image" class="img-fluid rounded" />
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-existing-image" data-filename="{{ $detail }}" style="padding: 2px 6px;" title="Remove this image">
                                                <i class="icofont-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div id="detailImagesPreview" class="detail-images-preview d-flex flex-wrap gap-3 mt-3"></div>
                            <div id="removedImagesInputs"></div>
                            <small class="text-muted">Add more detail images. (Max: 2MB per image)</small>
                            @error('detail_images')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Technical Specifications -->
                    <h5 class="fw-bold my-4 pb-2 border-bottom text-primary"><i class="icofont-listine-lines"></i> Technical Specifications</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" id="specsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Parameter</th>
                                    <th>Specification</th>
                                    <th class="text-center" style="width: 150px;">Show on List?</th>
                                    <th class="text-center" style="width: 100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="specsContainer">
                                @forelse($product->technicalSpecifications as $index => $spec)
                                    <tr class="spec-row">
                                        <td>
                                            <input type="text" name="specs[{{ $index }}][parameter]" value="{{ $spec->parameter }}" class="form-control" placeholder="Parameter">
                                        </td>
                                        <td>
                                            <input type="text" name="specs[{{ $index }}][specifications]" value="{{ $spec->specifications }}" class="form-control" placeholder="Specification">
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="specs[{{ $index }}][is_show_on_list]" value="0">
                                            <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input" type="checkbox" name="specs[{{ $index }}][is_show_on_list]" value="1" {{ $spec->is_show_on_list ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-spec-row">
                                                <i class="icofont-minus-circle"></i> Remove
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="spec-row">
                                        <td>
                                            <input type="text" name="specs[0][parameter]" class="form-control" placeholder="Parameter">
                                        </td>
                                        <td>
                                            <input type="text" name="specs[0][specifications]" class="form-control" placeholder="Specification">
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="specs[0][is_show_on_list]" value="0">
                                            <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input" type="checkbox" name="specs[0][is_show_on_list]" value="1" checked>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-spec-row" disabled>
                                                <i class="icofont-minus-circle"></i> Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm mb-4" id="addSpecRow">
                        <i class="icofont-plus-circle"></i> Add More
                    </button>

                    <!-- Meta Details -->
                    <h5 class="fw-bold my-4 pb-2 border-bottom text-primary"><i class="icofont-listine-lines"></i> Meta Details</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Meta title for SEO">
                            @error('meta_title')<div class="invalid-feedback">{{ $message }}</  div>@enderror   
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Meta Description</label>
                            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="3" placeholder="Meta description for SEO">{{ old('meta_description', $product->meta_description)   }}</textarea>   
                            @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mt-4 border-top pt-3 text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2"><i class="icofont-save"></i> Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        // Initialize Summernote
        $('#description,#features').summernote({
            placeholder: 'Enter content here...',
            height: 250,
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

        // Trigger validation on Summernote change
        $('#description,#features').on('summernote.change', function() {
            $(this).valid();
        });

        const selectedSubCategoryId = @json(old('sub_category_id', $product->sub_category_id));
        const subCategoriesByCategoryUrl = @json(url('/admin/sub-categories/by-category'));

        function loadSubCategories(categoryId, selectedId = null) {
            const $subSelect = $('#sub_category_id');
            $subSelect.html('<option value="">Select Sub Category</option>');
            if (!categoryId) {
                return;
            }
            $.get(subCategoriesByCategoryUrl + '/' + categoryId, function(data) {
                data.forEach(function(item) {
                    const selected = String(selectedId) === String(item.id) ? 'selected' : '';
                    $subSelect.append('<option value="' + item.id + '" ' + selected + '>' + item.title + '</option>');
                });
            });
        }

        $('#category_id').on('change', function() {
            loadSubCategories($(this).val());
        });

        if ($('#category_id').val()) {
            loadSubCategories($('#category_id').val(), selectedSubCategoryId);
        }

        function slugify(value) {
            return value.toString().toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
        $('#product_url').on('input', function() {
            $(this).val(slugify($(this).val()));
        });

        // Dynamic rows script for Technical Specifications
        let specIndex = {{ count($product->technicalSpecifications) > 0 ? count($product->technicalSpecifications) : 1 }};
        
        // Initial setup of remove buttons
        updateRemoveButtons();

        $('#addSpecRow').click(function() {
            let newRow = `
                <tr class="spec-row">
                    <td>
                        <input type="text" name="specs[${specIndex}][parameter]" class="form-control" placeholder="Parameter">
                    </td>
                    <td>
                        <input type="text" name="specs[${specIndex}][specifications]" class="form-control" placeholder="Specification">
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="specs[${specIndex}][is_show_on_list]" value="0">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input" type="checkbox" name="specs[${specIndex}][is_show_on_list]" value="1" checked>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-spec-row">
                            <i class="icofont-minus-circle"></i> Remove
                        </button>
                    </td>
                </tr>
            `;
            $('#specsContainer').append(newRow);
            specIndex++;
            updateRemoveButtons();
        });

        $(document).on('click', '.remove-spec-row', function() {
            $(this).closest('tr').remove();
            updateRemoveButtons();
        });

        $(document).on('click', '.remove-existing-image', function() {
            let filename = $(this).data('filename');
            $(this).closest('.detail-image-preview-container').remove();
            $('#removedImagesInputs').append(`<input type="hidden" name="removed_detail_images[]" value="${filename}">`);
        });

        $('#detailImagesInput').on('change', function() {
            let preview = $('#detailImagesPreview').empty();
            Array.from(this.files || []).forEach(function(file) {
                if (!file.type.match('image.*')) {
                    return;
                }

                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.append(`
                        <div class="detail-image-preview-container border rounded p-1">
                            <img src="${e.target.result}" alt="New Detail Image Preview" class="img-fluid rounded" />
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            });
        });

        function updateRemoveButtons() {
            let rows = $('.spec-row');
            if (rows.length <= 1) {
                rows.find('.remove-spec-row').prop('disabled', true);
            } else {
                rows.find('.remove-spec-row').prop('disabled', false);
            }
        }

        // jQuery Validation (optional files)
        $('#productForm').validate({
            ignore: [],
            rules: {
                category_id: { required: true },
                sub_category_id: { required: true },
                product_name: { required: true, maxlength: 255 },
                product_url: { required: true, maxlength: 255 },
                product_modal: { required: true, maxlength: 255 },
                description: { required: true },
                datasheet: { extension: 'pdf' },
                list_image: { extension: 'jpg|jpeg|png|webp' },
                'detail_images[]': { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                category_id: { required: 'Category is required.' },
                sub_category_id: { required: 'Sub Category is required.' },
                product_name: { required: 'Product Name is required.' },
                product_url: { required: 'Product URL is required.' },
                product_modal: { required: 'Product Model is required.' },
                description: { required: 'Description is required.' },
                datasheet: { extension: 'Only PDF files are allowed.' },
                list_image: { extension: 'Only jpg, jpeg, png, or webp images are allowed.' },
                'detail_images[]': { extension: 'Only jpg, jpeg, png, or webp images are allowed.' }
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
<style>
    .detail-images-preview .detail-image-preview-container {
        width: 180px;
        height: 180px;
    }

    .detail-images-preview img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #f8f9fa;
    }
</style>
@endsection
