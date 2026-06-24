<div class="offcanvas offcanvas-end" tabindex="-1" id="inquiryOffcanvas" aria-labelledby="inquiryOffcanvasLabel" style="width: 650px; max-width: 100%;">
    <div class="offcanvas-header border-bottom">
        <p class="offcanvas-title title_24" id="inquiryOffcanvasLabel">Inquiry Now</p>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="quote-section">
            <!-- Right Form Section -->
            <div class="quote-form-wrapper">
                <form class="quote-form" id="contact-form-offcanvas" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s{2,}/g, ' ').trimStart();">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="company" placeholder="Company name" value="{{ old('company') }}">
                            @error('company')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" placeholder="john@company.com" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" placeholder="+91 99999 99999" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Country <span class="text-danger">*</span></label>
                            <select name="country">
                                <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}" {{ old('country') === $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Product</label>
                            <select name="product">
                                <option value="" disabled {{ old('product') ? '' : 'selected' }}>Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_name }}" {{ old('product') === $product->product_name ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                            @error('product')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label>Requirement Details</label>
                        <textarea name="requirement_details" placeholder="Describe your project requirements..." >{{ old('requirement_details') }}</textarea>
                        @error('requirement_details')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="com_btn w-100 justify-content-center" id="contactSubmitBtnOffcanvas">
                        Get Quote 
                        <svg class="ms-2" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.3767 15.4809C10.4038 15.5485 10.451 15.6062 10.5118 15.6462C10.5727 15.6862 10.6443 15.7067 10.7171 15.7048C10.7899 15.7029 10.8604 15.6788 10.9191 15.6358C10.9779 15.5927 11.022 15.5327 11.0456 15.4638L15.6858 1.90015C15.7087 1.8369 15.713 1.76844 15.6984 1.7028C15.6837 1.63716 15.6507 1.57704 15.6032 1.52949C15.5556 1.48193 15.4955 1.44891 15.4298 1.43427C15.3642 1.41963 15.2958 1.42399 15.2325 1.44684L1.66888 6.08702C1.59999 6.11065 1.53998 6.15478 1.49689 6.2135C1.45381 6.27222 1.42972 6.34271 1.42785 6.41552C1.42599 6.48832 1.44644 6.55996 1.48646 6.62081C1.52648 6.68165 1.58416 6.7288 1.65175 6.75592L7.31278 9.02604C7.49174 9.09769 7.65433 9.20484 7.79076 9.34103C7.92719 9.47721 8.03463 9.63962 8.10661 9.81845L10.3767 15.4809Z" stroke="white" stroke-width="1.42775" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.6008 1.53223L7.79102 9.3413" stroke="white" stroke-width="1.42775" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <p class="form-footer text-center">Our team typically responds within 24 business hours.</p>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
   @media screen and (max-width: 1601px) {
    /* #inquiryOffcanvas {
        overflow: hidden !important;
    } */
    #inquiryOffcanvas .offcanvas-body {
        /* overflow: hidden !important; */
        padding: 15px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
  
    #inquiryOffcanvas .quote-form {
        gap: 10px;
    }
    #inquiryOffcanvas .form-row {
        gap: 15px;
        margin-bottom: 0;
    }
    #inquiryOffcanvas .form-group {
        gap: 2px;
        margin-bottom: 10px !important;
    }
   
    #inquiryOffcanvas .form-group input, 
    #inquiryOffcanvas .form-group select {
        padding: 6px 12px;
        /* font-size: 14px; */
    }
    #inquiryOffcanvas textarea[name="requirement_details"] {
        padding: 6px 12px;
        height: 55px;
        /* font-size: 14px; */
    }
    #inquiryOffcanvas .com_btn {
        padding: 10px 15px;
        margin-top: 5px;
    }
   
    #inquiryOffcanvas .offcanvas-header {
        padding: 10px 20px;
    }
    #inquiryOffcanvas .title_24 {
        font-size: 20px;
        margin: 0;
    }
    
   }
</style>


