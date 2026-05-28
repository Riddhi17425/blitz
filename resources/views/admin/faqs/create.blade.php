@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Add FAQ Group</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('faqs') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="faqForm" action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div id="faqRows">
                    @php
                        $titles = old('faq_title', ['']);
                        $descriptions = old('faq_description', ['']);
                    @endphp
                    @foreach($titles as $index => $title)
                        <div class="faq-row mb-3 p-3 border rounded">
                            <div class="mb-3">
                                <label class="form-label">FAQ Title <span class="text-danger">*</span></label>
                                <input type="text" name="faq_title[]" value="{{ $title }}" class="form-control @error('faq_title.' . $index) is-invalid @enderror" placeholder="Enter FAQ title">
                                @error('faq_title.' . $index)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">FAQ Description <span class="text-danger">*</span></label>
                                <textarea name="faq_description[]" class="form-control @error('faq_description.' . $index) is-invalid @enderror" rows="3" placeholder="Enter FAQ description">{{ $descriptions[$index] ?? '' }}</textarea>
                                @error('faq_description.' . $index)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger removeFaq">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="addFaqRow" class="btn btn-outline-primary mb-3">Add Another FAQ</button>
                <div>
                    <button type="submit" class="btn btn-primary">Save FAQs</button>
                </div>
            </form>
        </div></div>
    </div>
</div>

<script>
    $(function() {
        $('#addFaqRow').on('click', function() {
            $('#faqRows').append(`
                <div class="faq-row mb-3 p-3 border rounded">
                    <div class="mb-3">
                        <label class="form-label">FAQ Title <span class="text-danger">*</span></label>
                        <input type="text" name="faq_title[]" class="form-control" placeholder="Enter FAQ title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">FAQ Description <span class="text-danger">*</span></label>
                        <textarea name="faq_description[]" class="form-control" rows="3" placeholder="Enter FAQ description"></textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger removeFaq">Remove</button>
                </div>
            `);
        });

        $(document).on('click', '.removeFaq', function() {
            $(this).closest('.faq-row').remove();
        });

        $('#faqForm').validate({
            rules: {
                'faq_title[]': { required: true, maxlength: 255 },
                'faq_description[]': { required: true }
            },
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
