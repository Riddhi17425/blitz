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
  AOS.init({
    duration: 800,
    once: true,
    offset: 50,
  });

  //4. Industry Slider

  $(document).ready(function () {
    $(".indu_slider").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      infinite: true,

      /* Ye line add karna zaroori hai */
      prevArrow: $(".custom-prev"),
      nextArrow: $(".custom-next"),

      responsive: [
        // Aapke responsive settings...
      ],
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

  zoomContainer.addEventListener("mousemove", function (e) {
    // Container ke coordinates nikalna
    const rect = zoomContainer.getBoundingClientRect();

    // Mouse ki position ka percentage nikalna
    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;

    // CSS properties direct set karna for 0 delay
    mainImg.style.transformOrigin = `${x}% ${y}%`;
    mainImg.style.transform = "scale(2.5)"; // Zoom in
  });

  zoomContainer.addEventListener("mouseleave", function () {
    // Mouse bahar jate hi normal kar dena
    mainImg.style.transformOrigin = "center center";
    mainImg.style.transform = "scale(1)"; // Zoom out
  });
});


const sections = document.querySelectorAll(".content-section");
const navLinks = document.querySelectorAll(".nav-link");

// =========================
// CLICK SCROLL WITH OFFSET
// =========================
navLinks.forEach((link) => {

  link.addEventListener("click", function (e) {

    e.preventDefault();

    const targetId = this.getAttribute("href");
    const targetSection = document.querySelector(targetId);

    if (targetSection) {

      const offsetTop = targetSection.offsetTop - 120;

      window.scrollTo({
        top: offsetTop,
        behavior: "smooth",
      });
    }
  });
});


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




