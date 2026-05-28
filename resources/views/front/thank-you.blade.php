
@include('layouts.frontheader')
<section>    
        <div class="thank power_biotechnology">
            <h1 class="milestone_head">Thank You</h1>
            <a class="d-flex align-items-center justify-content-center mt-4" href="{{ url('/') }}">
                Go to Home
                <div class="styled-wrapper">
                                <button class="button">
                                    <div class="button-box">
                                    <span class="button-elem">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 26 26" fill="none">
                                            <path d="M7 1L18.7115 12.3538C18.8025 12.4367 18.8751 12.5368 18.9248 12.6479C18.9744 12.7591 19 12.8789 19 13C19 13.1211 18.9744 13.2409 18.9248 13.3521C18.8751 13.4632 18.8025 13.5633 18.7115 13.6462L7 25" stroke="#40AC44" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                    </span>
                                    <span class="button-elem">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 26 26" fill="none">
                                        <path d="M7 1L18.7115 12.3538C18.8025 12.4367 18.8751 12.5368 18.9248 12.6479C18.9744 12.7591 19 12.8789 19 13C19 13.1211 18.9744 13.2409 18.9248 13.3521C18.8751 13.4632 18.8025 13.5633 18.7115 13.6462L7 25" stroke="#40AC44" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    </div>
                                </button>
                            </div>
            </a>
        </div>  
</section>

@include('layouts.frontfooter')