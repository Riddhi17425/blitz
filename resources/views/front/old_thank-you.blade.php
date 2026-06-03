@include('layouts.frontheader')

<section class="thank-you-section">
    <div class="container">
        <div class="thank-you-card">

            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="11" fill="#40AC44"/>
                    <path d="M7 12.5L10.5 16L17 9" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <span class="thank-badge"> Successful</span>

            <h1 class="thank-title">Thank You!</h1>

            <p class="thank-text">
                We appreciate your interest. Your request has been received successfully.
                Our team will review the details and get back to you shortly.
            </p>

            <a href="{{ url('/') }}" class="com_btn com_btn_b_b">Back to Home</a>

        </div>
    </div>
</section>

<style>
.thank-you-section{
    min-height:80vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:
        radial-gradient(circle at top right, rgba(64,172,68,.15), transparent 25%),
        linear-gradient(135deg,#061A40,#0B2D68);
    padding:100px 0;
}

.thank-you-card{
    background:#fff;
    border-radius:24px;
    padding:60px 40px;
    text-align:center;
    max-width:700px;
    margin:auto;
    box-shadow:0 25px 60px rgba(0,0,0,.15);
    position:relative;
    overflow:hidden;
}

.thank-you-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background:linear-gradient(90deg,#40AC44,#0B2D68);
}

.success-icon{
    margin-bottom:25px;
    animation:pop .6s ease;
}

.thank-badge{
    background:#E8F8EA;
    color:#40AC44;
    padding:8px 18px;
    border-radius:30px;
    font-size:14px;
    font-weight:600;
    display:inline-block;
    margin-bottom:20px;
}

.thank-title{
    font-size:60px;
    font-weight:700;
    color:#061A40;
    margin-bottom:15px;
}

.thank-text{
    font-size:18px;
    line-height:1.8;
    color:#666;
    max-width:550px;
    margin:0 auto 35px;
}

.home-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    background:#061A40;
    color:#fff;
    text-decoration:none;
    padding:16px 32px;
    border-radius:50px;
    font-weight:600;
    transition:.3s;
}

.home-btn:hover{
    background:#40AC44;
    color:#fff;
    transform:translateY(-3px);
}

@keyframes pop{
    from{
        transform:scale(.5);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}

@media(max-width:768px){
    .thank-title{
        font-size:40px;
    }

    .thank-you-card{
        padding:40px 25px;
    }

    .thank-text{
        font-size:16px;
    }
}
</style>

@include('layouts.frontfooter')