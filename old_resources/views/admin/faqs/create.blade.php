@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Add FAQ</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('faqs') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="faqForm" action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div id="faqRows">
                    @php
                        $questions = old('question', ['']);
                        $answers = old('answer', ['']);
                    @endphp
                    @foreach($questions as $index => $question)
                        <div class="faq-row mb-3 p-3 border rounded">
                            <div class="mb-3">
                                <label class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" name="question[]" value="{{ $question }}" class="form-control @error('question.' . $index) is-invalid @enderror" placeholder="Enter question" required>
                                @error('question.' . $index)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Answer <span class="text-danger">*</span></label>
                                <textarea name="answer[]" class="form-control summernote @error('answer.' . $index) is-invalid @enderror" rows="3" placeholder="Enter answer" required>{{ $answers[$index] ?? '' }}</textarea>
                                @error('answer.' . $index)<div class="invalid-feedback">{{ $message }}</div>@enderror
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
        function initFaqEditor(selector) {
            $(selector).summernote({
                placeholder: 'Enter answer here...',
                height: 150,
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

        $('#addFaqRow').on('click', function() {
            const newRow = $(
                `<div class="faq-row mb-3 p-3 border rounded">
                    <div class="mb-3">
                        <label class="form-label">Question <span class="text-danger">*</span></label>
                        <input type="text" name="question[]" class="form-control" placeholder="Enter question">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                        <textarea name="answer[]" class="form-control summernote" rows="3" placeholder="Enter answer"></textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger removeFaq">Remove</button>
                </div>`
            );
            $('#faqRows').append(newRow);
            initFaqEditor(newRow.find('textarea')); 
        });

        $(document).on('click', '.removeFaq', function() {
            $(this).closest('.faq-row').remove();
        });

        $.validator.addMethod('summernoteRequired', function(value, element) {
            if ($(element).hasClass('summernote')) {
                return $(element).summernote('isEmpty') === false;
            }
            return $.trim(value).length > 0;
        }, 'This field is required.');

        $('#faqForm').validate({
            ignore: [],
            rules: {
                'question[]': { required: true, maxlength: 255 },
                'answer[]': { summernoteRequired: true }
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

        initFaqEditor('textarea.summernote');
    });
</script>
@endsection
