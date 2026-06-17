@include('layouts.frontheader')

<section class="contact_banner">
    <div class="container h-100">
        <div class="baner_left">
            <div class="breadcrumbs">
                <a href="#">Home</a>
                <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                            stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <a href="#">Contact</a>
            </div>
            <h2 class="banner_title">Get in Touch</h2>
            <p class="baner_desc mb-0">Have questions about our products? <br> Need technical support or pricing
                information? <br /> Our team is here to help you with all your electrical protection needs.</p>
        </div>
    </div>
</section>

@include('layouts.form')

<section class="py_80">
    <div class="container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58767.73216987788!2d72.41946662117739!3d22.98764302532079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9aeba8538b39%3A0xff36690af0489f23!2sSIGNATURE-2%2C%20105%2C%20Sarkhej%20-%20Sanand%20Rd%2C%20Sarkhej%2C%20Ahmedabad%2C%20Sarkhej-Okaf%2C%20Gujarat%20382210!5e0!3m2!1sen!2sin!4v1780050441979!5m2!1sen!2sin"
            width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "ContactPage",
  "@id": "https://blitzenergyindia.com/contact-us#webpage",
  "url": "https://blitzenergyindia.com/contact-us",
  "name": "Contact Blitz Energy India",
  "description": "Contact Blitz Energy India for inquiries related to electrical protection devices such as SPDs, MCBs, Fuses, and Solar Accessories.",
  "isPartOf": {
    "@id": "https://blitzenergyindia.com/#website"
  },
  "about": {
    "@id": "https://blitzenergyindia.com/#organization"
  },
  "mainEntity": {
    "@type": "Organization",
    "@id": "https://blitzenergyindia.com/#organization",
    "name": "Blitz Energy India",
    "url": "https://blitzenergyindia.com/",
    "telephone": "+91 97252 01620",
    "email": "info@blitzelectrical.in",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "B-403/404 Signature-2, Sarkhej Sanand Road, Sarkhej",
      "addressLocality": "Ahmedabad",
      "addressRegion": "Gujarat",
      "postalCode": "382210",
      "addressCountry": "IN"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+91 97252 01620",
      "contactType": "customer support",
      "email": "info@blitzelectrical.in",
      "availableLanguage": [
        "English",
        "Hindi",
		"Gujarati"
      ]
    }
  },
  "primaryImageOfPage": {
    "@type": "ImageObject",
    "url": "https://blitzenergyindia.com/public/front/assets/images/logo.svg"
  },
  "inLanguage": "en-IN"
}
</script>


@include('layouts.frontfooter')