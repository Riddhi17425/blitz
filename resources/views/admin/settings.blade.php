@extends('admin.layouts.app')

@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="col-md-6"><h3 class="fw-bold">Site Settings</h3></div>
            <div class="col-md-6 text-end"><a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a></div>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="card"><div class="card-body">
            <form id="settingsForm" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h5 class="fw-bold mb-3 pb-2 border-bottom text-primary">Contact Information</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', optional($settings)->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', optional($settings)->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Head Office Address</label>
                        <textarea name="head_office_address" class="form-control @error('head_office_address') is-invalid @enderror" rows="3" placeholder="Enter head office address">{{ old('head_office_address', optional($settings)->head_office_address) }}</textarea>
                        @error('head_office_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">Certifications</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <input type="file" name="certifications[]" class="form-control @error('certifications.*') is-invalid @enderror" multiple accept="image/*">
                        <small class="text-muted">You can upload multiple certification images. Existing certifications will be preserved unless removed.</small>
                        @error('certifications.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                @if(!empty($settings->certifications))
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card p-3 mb-3">
                            <h6 class="fw-bold">Existing Certifications</h6>
                            <div class="row">
                                @foreach($settings->certifications as $certification)
                                    <div class="col-md-4 mb-2">
                                        <div class="border rounded p-2 h-100">
                                            {{-- @if(pathinfo($certification, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('public/images/settings_certifications/' . $certification) }}" target="_blank">{{ $certification }}</a>
                                            @else --}}
                                                <img src="{{ asset('public/images/settings_certifications/' . $certification) }}" class="img-fluid mb-2" alt="Certification">
                                            {{-- @endif --}}
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_certification[]" value="{{ $certification }}" id="remove_certification_{{ $loop->index }}">
                                                <label class="form-check-label" for="remove_certification_{{ $loop->index }}">Remove</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <h5 class="fw-bold my-4 pb-2 border-bottom text-primary">Our Clients</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <input type="file" name="client_images[]" class="form-control @error('client_images.*') is-invalid @enderror" multiple accept="image/*">
                        <small class="text-muted">You can upload multiple client logos or images.</small>
                        @error('client_images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                @if(!empty($settings->client_images))
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card p-3 mb-3">
                            <h6 class="fw-bold">Existing Client Images</h6>
                            <div class="row">
                                @foreach($settings->client_images as $clientImage)
                                    <div class="col-md-3 mb-2">
                                        <div class="border rounded p-2 text-center">
                                            <img src="{{ asset('public/images/settings_clients/' . $clientImage) }}" class="img-fluid mb-2" style="max-height: 100px;" alt="Client Image">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_client_image[]" value="{{ $clientImage }}" id="remove_client_image_{{ $loop->index }}">
                                                <label class="form-check-label" for="remove_client_image_{{ $loop->index }}">Remove</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div></div>
    </div>
</div>

<script>
    $(function() {
        $('#settingsForm').validate({
            ignore: [],
            rules: {
                phone: { maxlength: 50 },
                email: { email: true, maxlength: 255 },
                head_office_address: { maxlength: 1000 },
                'certifications[]': { extension: 'jpg|jpeg|png|webp' },
                'client_images[]': { extension: 'jpg|jpeg|png|webp' }
            },
            messages: {
                email: { email: 'Enter a valid email address.' },
                'certifications[]': { extension: 'Allowed file types: JPG, JPEG, PNG, WEBP.' },
                'client_images[]': { extension: 'Allowed file types: JPG, JPEG, PNG, WEBP.' }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
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
