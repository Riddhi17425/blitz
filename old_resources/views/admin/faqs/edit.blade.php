@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Edit FAQ</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('faqs') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="faqForm" action="{{ route('faqs.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="faq-row mb-3 p-3 border rounded">
                    <div class="mb-3">
                        <label class="form-label">Question <span class="text-danger">*</span></label>
                        <input type="text" name="question" value="{{ old('question', $faq->question) }}" class="form-control @error('question') is-invalid @enderror" placeholder="Enter question" required>
                        @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control summernote @error('answer') is-invalid @enderror" rows="4" placeholder="Enter answer" required>{{ old('answer', $faq->answer) }}</textarea>
                        @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div><button type="submit" class="btn btn-primary">Update FAQ</button></div>
            </form>
        </div></div>
    </div>
</div>

<script>
    $(function() {
        function initFaqEditEditor(selector) {
            $(selector).summernote({
                placeholder: 'Enter answer here...',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                ]
            }).on('summernote.change summernote.blur', function() {
                $(this).valid();
            });
        }

        $.validator.addMethod('summernoteRequired', function(value, element) {
            if ($(element).hasClass('summernote')) {
                return $(element).summernote('isEmpty') === false;
            }
            return $.trim(value).length > 0;
        }, 'This field is required.');

        initFaqEditEditor('textarea.summernote');

        $('#faqForm').validate({
            ignore: [],
            rules: {
                question: { required: true, maxlength: 255 },
                answer: { summernoteRequired: true }
            },
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.hasClass('summernote')) {
                    element.closest('.mb-3').append(error);
                } else {
                    element.closest('.mb-3').append(error);
                }
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
