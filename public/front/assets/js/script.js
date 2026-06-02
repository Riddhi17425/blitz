$(document).ready(function () {

  // 1. MUST BE ADDED BEFORE INITIALIZING SLICK
  // 'init' ensures this only runs exactly once.
  $(".hero-slider").on("init", function (event, slick) {
    $(".slick-dots").wrapInner(
      '<div class="container d-flex align-items-center"></div>',
    );
  });

  // 2. Slick Slider Initialization
  $(".hero-slider").slick({
    dots: true,
    infinite: true,
    speed: 800,
    fade: true,
    cssEase: "linear",
    autoplay: true,
    autoplaySpeed: 1000,
    arrows: false,
    appendDots: $(".hero-slider"),
  });

  // NOTE: Delete your old .on('setPosition') block completely!

  // 3. AOS (Animate On Scroll)
  // AOS.init({
  //   duration: 800,
  //   once: true,
  //   offset: 50,
  // });

  //4. Industry Slider

  $(document).ready(function () {
    $(".indu_slider").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      infinite: true,
      prevArrow: $(".custom-prev"),
      nextArrow: $(".custom-next"),

      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            dots: true
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });

  //5. Testimonial Slider
  $(".testimonial-slider").slick({
    slidesToShow: 1.5 /* Exactly 1.5 slides so the next one peaks out like the image */,
    slidesToScroll: 1,
    infinite: false,
    prevArrow: $(".custom-prev2"),
    nextArrow: $(".custom-next2"),
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  //6. Our Clients Slider (Auto-Ticker)
  //   if ($(".our_clint img").length > 5) {
  //     $(".our_clint").slick({
  //       slidesToShow: 5,
  //       slidesToScroll: 1,
  //       autoplay: true,
  //       autoplaySpeed: 0,
  //       speed: 3000,
  //       cssEase: "linear",
  //       infinite: true,
  //       arrows: false,
  //       dots: false,
  //       responsive: [
  //         {
  //           breakpoint: 991,
  //           settings: {
  //             slidesToShow: 4,
  //           },
  //         },
  //         {
  //           breakpoint: 767,
  //           settings: {
  //             slidesToShow: 3,
  //           },
  //         },
  //         {
  //           breakpoint: 480,
  //           settings: {
  //             slidesToShow: 2,
  //           },
  //         },
  //       ],
  //     });
  //   }

});


// DOM Load hone ke baad hi JS chalegi, taki errors na aayen
document.addEventListener("DOMContentLoaded", function () {
  // ==========================================
  // 1. THUMBNAIL (TAB) SYSTEM - Click & Hover
  // ==========================================
  const thumbs = document.querySelectorAll(".thumb");
  const mainImg = document.getElementById("mainImage");

  thumbs.forEach((thumb) => {
    // Tab par click ya hover hone par kya hoga:
    function changeTab() {
      // Remove active from all
      thumbs.forEach((t) => t.classList.remove("active"));
      // Add active to current
      this.classList.add("active");
      // Change Image
      mainImg.src = this.querySelector("img").src;
    }

    // Dono Events lagaye hain (Desktop & Mobile dono par chalega)
    thumb.addEventListener("mouseenter", changeTab);
    thumb.addEventListener("click", changeTab);
  });

  // ==========================================
  // 2. PERFECT INSIDE ZOOM (Instant Like GIF)
  // ==========================================
  const zoomContainer = document.getElementById("zoomContainer");

  if (zoomContainer) {
    zoomContainer.addEventListener("mousemove", function (e) {
      // Container ke coordinates nikalna
      const rect = zoomContainer.getBoundingClientRect();

      // Mouse ki position ka percentage nikalna
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;

      // CSS properties direct set karna for 0 delay
      if (mainImg) {
        mainImg.style.transformOrigin = `${x}% ${y}%`;
        mainImg.style.transform = "scale(2.5)"; // Zoom in
      }
    });

    zoomContainer.addEventListener("mouseleave", function () {
      // Mouse bahar jate hi normal kar dena
      if (mainImg) {
        mainImg.style.transformOrigin = "center center";
        mainImg.style.transform = "scale(1)"; // Zoom out
      }
    });
  }

  // ==========================================
  // 3. MAP ANIMATION SCROLL OBSERVER
  // ==========================================
  const mapContainer = document.getElementById("globalMapContainer");
  if (mapContainer) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting && window.innerWidth > 1024) {
          // Jab map viewport mein aayega tabhi animation class lagegi
          mapContainer.classList.add("start-animation");
        }
      });
    }, { threshold: 0.3 }); // Jab 30% map dikhe tab trigger hoga
    observer.observe(mapContainer);
  }

  // ==========================================
  // 4. STICKY SCROLL ZOOM & SLIDE EFFECT
  // ==========================================
  const storySection = document.getElementById("storyScrollSection");
  if (storySection) {
    const storyImg = storySection.querySelector(".story-zoom-img");
    const storyText = storySection.querySelector(".story-text-content");

    window.addEventListener("scroll", () => {
      if (window.innerWidth <= 1024) return;
      const rect = storySection.getBoundingClientRect();
      const windowHeight = window.innerHeight;

      let progress = 0;

      if (rect.top > 0) {
        progress = 0;
      }
      else if (rect.bottom < windowHeight) {
        progress = 1;
      }
      else {
        // total scrollable distance is section height - window height
        const scrollDistance = rect.height - windowHeight;
        progress = Math.abs(rect.top) / scrollDistance;
      }

      // Image scale: from 2.2 to 1
      // Image translateX: from 50% (moves to center) to 0
      const scaleVal = 1 + (1 - progress) * 1.2;
      const translateXVal = (1 - progress) * 50;

      storyImg.style.transform = `translateX(${translateXVal}%) scale(${scaleVal})`;

      // Text animation: starts appearing after 30% scroll
      let textProgress = (progress - 0.3) / 0.7;
      if (textProgress < 0) textProgress = 0;
      if (textProgress > 1) textProgress = 1;

      storyText.style.opacity = textProgress;
      storyText.style.transform = `translateX(${(1 - textProgress) * 100}px)`;
    });

    window.dispatchEvent(new Event('scroll'));
  }

  // ==========================================
  // 5. CUSTOM ROTATING CURSOR (Follow Mouse)
  // ==========================================
  const cursor = document.getElementById("customCursor");
  if (cursor) {
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let cursorX = mouseX;
    let cursorY = mouseY;

    // Track mouse position
    document.addEventListener("mousemove", (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    // Smooth animation loop using Lerp
    function animateCursor() {
      if (window.innerWidth <= 1024) return;
      // Lerp logic for buttery smooth follow
      cursorX += (mouseX - cursorX) * 0.2;
      cursorY += (mouseY - cursorY) * 0.2;

      // Hardware-accelerated transform with centering
      cursor.style.transform = `translate3d(calc(${cursorX}px - 50%), calc(${cursorY}px - 50%), 0)`;

      requestAnimationFrame(animateCursor);
    }
    animateCursor();

    // Add hover effect using event delegation for all current and dynamic clickable elements
    document.addEventListener("mouseover", (e) => {
      if (e.target.closest("a, button, .com_btn, input, textarea, select")) {
        cursor.classList.add("hover");
      }
    });

    document.addEventListener("mouseout", (e) => {
      if (e.target.closest("a, button, .com_btn, input, textarea, select")) {
        cursor.classList.remove("hover");
      }
    });
  }

  // ==========================================
  // 6. PRODUCT CARDS STICKY SCROLL ANIMATION
  // ==========================================
  const prodSection = document.getElementById("productScrollSection");
  if (prodSection) {
    const cards = prodSection.querySelectorAll(".product-scroll-card");
    let currentProdProgress = 0;
    let targetProdProgress = 0;

    window.addEventListener("scroll", () => {
      if (window.innerWidth <= 1024) return;
      const rect = prodSection.getBoundingClientRect();
      const windowHeight = window.innerHeight;

      // Start the animation as soon as the section enters the viewport from the bottom
      if (rect.top > windowHeight) {
        targetProdProgress = 0;
      } else if (rect.bottom < windowHeight) {
        targetProdProgress = 1;
      } else {
        // The total scroll distance is the height of the section
        const scrollDist = rect.height;
        // How much we have scrolled into the section
        const scrolled = windowHeight - rect.top;
        targetProdProgress = scrolled / scrollDist;
      }
    });

    function animateProdCards() {
      if (window.innerWidth <= 1024) return;
      currentProdProgress += (targetProdProgress - currentProdProgress) * 0.1; // Smooth interpolation

      cards.forEach((card, index) => {
        // Divide the 0-1 progress among the 4 cards
        const segment = 1 / cards.length;
        const start = index * segment;
        const end = start + segment;

        let cardProgress = (currentProdProgress - start) / (end - start);
        if (cardProgress < 0) cardProgress = 0;
        if (cardProgress > 1) cardProgress = 1;

        const yOffset = (1 - cardProgress) * 200; // Slide up from 200px
        card.style.transform = `translateY(${yOffset}px)`;
        card.style.opacity = cardProgress;
      });

      requestAnimationFrame(animateProdCards);
    }
    animateProdCards();
  }

  // ==========================================
  // 7. SCROLL-TRIGGERED COUNTER ANIMATION
  // ==========================================
  function animateCounter(el, target, duration, prefix, suffix) {
    let start = 0;
    const stepTime = 16; // ~60fps
    const steps = Math.ceil(duration / stepTime);
    const increment = target / steps;
    let current = 0;
    let step = 0;

    const timer = setInterval(() => {
      step++;
      current += increment;
      if (step >= steps || current >= target) {
        current = target;
        clearInterval(timer);
      }
      // Format number with commas if >= 1000
      const formatted = target % 1 === 0
        ? Math.floor(current).toLocaleString()
        : current.toFixed(1);
      el.textContent = prefix + formatted + suffix;
    }, stepTime);
  }

  // Counter Section 1 — "Why Choose Us" (.counter h2)
  const counterSection1 = document.querySelector('.counter')?.closest('section');
  if (counterSection1) {
    const counterEls = counterSection1.querySelectorAll('.counter h2');
    let counted1 = false;

    const obs1 = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !counted1) {
          counted1 = true;
          counterEls.forEach(el => {
            const originalText = el.textContent.trim();
            // Extract numeric value
            const numMatch = originalText.match(/[\d,]+(\.\d+)?/);
            if (!numMatch) return; // Skip non-numeric (like "IEC", "24/7", "Zero")
            const target = parseFloat(numMatch[0].replace(/,/g, ''));
            // Extract prefix (before number)
            const prefixMatch = originalText.match(/^([^0-9]*)/);
            const prefix = prefixMatch ? prefixMatch[1] : '';
            // Extract suffix (after number)
            const suffixMatch = originalText.match(/[\d,]+(\.\d+)?(.*)$/);
            const suffix = suffixMatch ? suffixMatch[2] : '';
            el.textContent = prefix + '0' + suffix;
            animateCounter(el, target, 2000, prefix, suffix);
          });
        }
      });
    }, { threshold: 0.3 });
    obs1.observe(counterSection1);
  }

  // Counter Section 2 — "Manufacturing Excellence" (.counter2 h4)
  const counterSection2 = document.querySelector('.counter2')?.closest('section');
  if (counterSection2) {
    const counterEls2 = counterSection2.querySelectorAll('.counter2 h4');
    let counted2 = false;

    const obs2 = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !counted2) {
          counted2 = true;
          counterEls2.forEach(el => {
            const originalText = el.textContent.trim();
            const numMatch = originalText.match(/[\d,]+(\.\d+)?/);
            if (!numMatch) return; // Skip "Zero", "24/7", etc.
            const target = parseFloat(numMatch[0].replace(/,/g, ''));
            const prefixMatch = originalText.match(/^([^0-9]*)/);
            const prefix = prefixMatch ? prefixMatch[1] : '';
            const suffixMatch = originalText.match(/[\d,]+(\.\d+)?(.*)$/);
            const suffix = suffixMatch ? suffixMatch[2] : '';
            el.textContent = prefix + '0' + suffix;
            animateCounter(el, target, 2000, prefix, suffix);
          });
        }
      });
    }, { threshold: 0.3 });
    obs2.observe(counterSection2);
  }

  // ==========================================
  // 7. SMART HEADER (Hide on scroll down, show on scroll up)
  // ==========================================
  const header = document.querySelector(".navbar");
  if (header) {
    let lastScrollY = window.scrollY;
    const HIDE_THRESHOLD = 30;  // Itna neeche scroll hone par hide hoga
    const SHOW_THRESHOLD = 400;  // Itna upar scroll hone par show hoga

    window.addEventListener("scroll", () => {
      const currentScrollY = window.scrollY;
      const scrollDiff = currentScrollY - lastScrollY;

      if (currentScrollY <= 150) {
        // Page ke bilkul top par — hamesha show karo
        header.classList.remove("navbar-hidden");
      } else if (scrollDiff > HIDE_THRESHOLD) {
        // Significant neeche scroll — hide karo
        header.classList.add("navbar-hidden");
        lastScrollY = currentScrollY;
      } else if (scrollDiff < -SHOW_THRESHOLD) {
        // Significant upar scroll — show karo
        header.classList.remove("navbar-hidden");
        lastScrollY = currentScrollY;
      }
      // Choti scroll pe kuch nahi karo (smooth feel)
    });
  }

});


// const sections = document.querySelectorAll(".content-section");
// const navLinks = document.querySelectorAll(".nav-link");

// =========================
// CLICK SCROLL WITH OFFSET
// =========================
// navLinks.forEach((link) => {

//   link.addEventListener("click", function (e) {

//     e.preventDefault();

//     const targetId = this.getAttribute("href");
//     const targetSection = document.querySelector(targetId);

//     if (targetSection) {

//       const offsetTop = targetSection.offsetTop - 120;

//       window.scrollTo({
//         top: offsetTop,
//         behavior: "smooth",
//       });
//     }
//   });
// });


// document.addEventListener("DOMContentLoaded", function() {
//     const scroll = new LocomotiveScroll({
//         el: document.querySelector('[data-scroll-container]'),
//         smooth: true,
//         multiplier: 1, 
//         class: 'is-reveal' 
//     });

//     // Jab sab kuch (images, svgs, styles) load ho jaye tab height re-calculate karein
//     window.addEventListener('load', function() {
//         scroll.update();
//     });

//     // Agar AOS use karna hi hai, toh AOS aur Locomotive ko sync karein:
//     // (Lekin again, Lenis use karna zyada behtar rahega)
//     setTimeout(() => {
//         scroll.update();
//     }, 500);
// });

/* homepage featured products grid */

function handleResponsiveClass() {
  if ($(window).width() <= 1025) {
    $('.pd_grid').addClass('pd_slider');
  } else {
    $('.pd_grid').removeClass('pd_slider');
  }
}

handleResponsiveClass();

$(window).on('resize', handleResponsiveClass);

$(".pd_slider").slick({
  dots: true,
  infinite: true,
  speed: 800,
  cssEase: "linear",
  autoplay: true,
  autoplaySpeed: 1000,
  arrows: false,
  slidesToShow: 3,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

/* homepage featured products grid */