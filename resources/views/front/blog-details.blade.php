@include('layouts.frontheader', [
    'og_image' => asset('public/admin/blogs/front_image/' . $blog->front_image),
    'blog_schema' => $blog->schema_json ?? ''
])

@if (isset($blog->blog_faq) && is_countable($blog->blog_faq) && count($blog->blog_faq) > 0)
    @php
        $faqSchemaEntities = [];
        foreach ($blog->blog_faq as $faq) {
            $question = trim($faq['faq_title'] ?? '');
            $answer = trim(strip_tags($faq['faq_description'] ?? ''));
            if ($question && $answer) {
                $faqSchemaEntities[] = [
                    '@type' => 'Question',
                    'name' => $question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $answer,
                    ],
                ];
            }
        }
    @endphp
    @if(!empty($faqSchemaEntities))
        <script type="application/ld+json">
            {!! json_encode([
                '@@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faqSchemaEntities,
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endif
@endif
<section class="py_80">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('front.home') }}">Home</a>
            <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                        stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <a href="{{ route('front.blogs') }}">blogs</a>

            {{-- <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                        stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <a href="#">The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems</a> --}}

        </div>

        <h1 class="title_60 mb-4">{{$blog->title ?? ''}}</h1>
        <!--<p class="baner_desc mb-0">{!! $blog->short_description ?? '' !!}</p>-->

        <div class="mt-4">
            <img class="img-fluid img_rou" src="{{ asset('public/admin/blogs/detail_image/' . $blog->detail_image) }}" alt="{{ $blog->detail_image_alt ?? '' }}">
        </div>
    </div>
</section>

<section class="guide-section mb_80">
    <div class="container">
        <div class="guide-section-child">
            <!-- Sidebar -->
            <aside class="sidebar">
                <p class="title_24">CONTENTS</p>
                <ul id="dynamic-sidebar">
                    <!-- Links will be generated here dynamically via JS -->
                </ul>

            </aside>

            <!-- Main Content -->
            <div class="content">
                <!-- Details -->
                <div class="content-section" id="details">
                    {!! $blog->detail_description !!}
                    {{-- <h2>Difference Between SPD and MCB - Complete Guide</h2>
                    <p>
                        Electrical protection is an extremely important process in establishing the safety,
                        reliability and life of the new electrical systems.
                    </p>
                    <p>
                        The <strong>SPD (Surge Protective Device)</strong> and the
                        <strong>MCB (Miniature Circuit Breaker)</strong> are both regarded to be two of the most
                        essential protection appliances of the contemporary world.
                    </p> --}}
                </div>
                
                {{-- <div class="content-section" id="vulnerabilities">

                    <h2>System Vulnerabilities</h2>

                    <p>
                        Electrical systems are vulnerable to overloads, short circuits,
                        power surges, lightning strikes and voltage fluctuations.
                    </p>

                    <p>
                        These issues may damage appliances, burn wiring and reduce
                        equipment lifespan if proper protection devices are not installed.
                    </p>

                </div>
                <div class="content-section" id="solutions">

                    <h2>Protection Solutions</h2>

                    <p>
                        MCBs protect against overloads and short circuits while SPDs
                        protect sensitive devices from sudden voltage spikes.
                    </p>

                    <p>
                        Using both devices together provides complete electrical safety
                        for residential and industrial installations.
                    </p>

                </div>
                <div class="content-section" id="products">

                    <h2>Product Recommendations</h2>

                    <p>
                        Choose high-quality protection devices from trusted electrical
                        brands with certified safety standards and long operational life.
                    </p>

                </div>
                <div class="content-section" id="faq">
                    <h2>The Specification of SPD and MCB</h2>
                    <div class="table-wrapper">
                        <table class="table-dark">
                            <thead>
                                <tr>
                                    <th>Parameters</th>
                                    <th>Specifications</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nominal Voltage (Un)</td>
                                    <td>230/400V AC</td>
                                </tr>
                                <tr>
                                    <td>Max. Continuous Operating Voltage (Uc)</td>
                                    <td>275V AC</td>
                                </tr>
                                <tr>
                                    <td>Nominal Discharge Current (In)</td>
                                    <td>20kA (8/20µs)</td>
                                </tr>
                                <tr>
                                    <td>Max. Discharge Current (Imax)</td>
                                    <td>40kA (8/20µs)</td>
                                </tr>
                                <tr>
                                    <td>Voltage Protection Level (Up)</td>
                                    <td>&le;1.5kV</td>
                                </tr>
                                <tr>
                                    <td>Response Time</td>
                                    <td>&lt;25ns</td>
                                </tr>
                                <tr>
                                    <td>SPD Type / Test Class</td>
                                    <td>Type 2 / Class II</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table-dark">
                            <thead>
                                <tr>
                                    <th>Parameters</th>
                                    <th>Specifications</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nominal Voltage (Un)</td>
                                    <td>230/400V AC</td>
                                </tr>
                                <tr>
                                    <td>Max. Continuous Operating Voltage (Uc)</td>
                                    <td>275V AC</td>
                                </tr>
                                <tr>
                                    <td>Nominal Discharge Current (In)</td>
                                    <td>20kA (8/20µs)</td>
                                </tr>
                                <tr>
                                    <td>Max. Discharge Current (Imax)</td>
                                    <td>40kA (8/20µs)</td>
                                </tr>
                                <tr>
                                    <td>Voltage Protection Level (Up)</td>
                                    <td>&le;1.5kV</td>
                                </tr>
                                <tr>
                                    <td>Response Time</td>
                                    <td>&lt;25ns</td>
                                </tr>
                                <tr>
                                    <td>SPD Type / Test Class</td>
                                    <td>Type 2 / Class II</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                 <div class="content-section" id="faq">
                    <h2>Real-Life Example  Renewable Energy Installation</h2>
                    <p>Solar energy farms are unique among industrial facilities due to their immense physical footprint
                        and exposure to atmospheric phenomena. The interconnected nature of DC strings and AC collection
                        networks creates multiple entry points for high-energy surges that can cripple production for
                        weeks.</p>

                </div> --}}

                {{-- CTA --}}
                <div class="content-section" id="cta">
                   <a href="{{ $blog->cta_link_url ? $blog->cta_link_url : route('front.contact')  }}"> <img class="img-fluid" src="{{ asset('public/admin/blogs/cta_image/' . $blog->cta_image) }}" alt="{{ $blog->cta_image_alt ?? '' }}"></a>
                </div>

                <!-- Conclusion -->
                <div class="content-section" id="conclusion">
                    <h2>Conclusion</h2>
                    {!! $blog->conclusion !!}
                </div>

                @if (isset($blog->blog_faq) && is_countable($blog->blog_faq) && count($blog->blog_faq) > 0)
                <div class="content-section" id="faq">
                    <div class="pb_40">
                        <h2 class="line_left" >FAQs</h2>
                        {{-- <h2>{{ $industryT ?? 'Protecting Tomorrow\'s Powerful Infrastructure' }}</h2>
                        <p class="mb-0">{{ $industryD ?? 'Industries choose Blitz when system protection, uptime, and electrical safety cannot be compromised.' }}</p> --}}
                    </div>
                    <div class="accordion" id="blitzFaq">
                        @foreach ($blog->blog_faq as $index => $faq)
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_{{ $index }}">
                                    {{ $faq['faq_title'] ?? '' }}
                                </button>
                            </h3>
                            <div id="collapse_{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
                                <div class="accordion-body">
                                    {!! $faq['faq_description'] ?? '' !!}
                                </div>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="accordion-item">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo">
                                    How do I choose the right fuse or circuit protection solution for my application?
                                </button>
                            </h4>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
                                <div class="accordion-body">
                                    Choosing the right fuse or circuit protection solution depends on factors such as
                                    voltage
                                    rating, current capacity, application type, load requirements, and environmental
                                    conditions.
                                    Our experts help you select the most reliable protection solution based on your
                                    industry
                                    needs to ensure maximum safety, efficiency, and long-term performance.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree">
                                    Are Blitz products tested for international safety and quality standards?
                                </button>
                            </h4>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
                                <div class="accordion-body">
                                    Yes, all our products undergo rigorous testing and meet major international safety
                                    standards
                                    (such as IEC, UL, and CE) to guarantee optimal protection and reliability.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour">
                                    Are Blitz products tested for international safety and quality standards?
                                </button>
                            </h4>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
                                <div class="accordion-body">
                                    Yes, all our products undergo rigorous testing and meet major international safety
                                    standards
                                    (such as IEC, UL, and CE) to guarantee optimal protection and reliability.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive">
                                    Are Blitz products tested for international safety and quality standards?
                                </button>
                            </h4>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
                                <div class="accordion-body">
                                    Yes, all our products undergo rigorous testing and meet major international safety
                                    standards
                                    (such as IEC, UL, and CE) to guarantee optimal protection and reliability.
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarList = document.getElementById("dynamic-sidebar");
        const headings = document.querySelectorAll(".content h2, .content h3");
        const sections = [];
        let currentH2Li = null;
        let currentH3Ul = null;
        const allDropdowns = [];

        // Generate sidebar links dynamically based on h2 and h3 tags
        if (headings.length > 0) {
            headings.forEach((heading, index) => {
                let targetId = heading.id;
                if (!targetId) {
                    targetId = heading.tagName.toLowerCase() + "-heading-" + index;
                    heading.id = targetId;
                }

                const a = document.createElement("a");
                a.href = "#" + targetId;
                a.className = "nav-link";
                a.textContent = heading.textContent.trim();

                if (heading.tagName.toLowerCase() === 'h2') {
                    const li = document.createElement("li");
                    
                    const flexContainer = document.createElement("div");
                    flexContainer.className = "d-flex align-items-center justify-content-between heading-wrapper";
                    flexContainer.appendChild(a);
                    li.appendChild(flexContainer);

                    if (index === 0) {
                        a.classList.add("active");
                    }
                    
                    sidebarList.appendChild(li);
                    currentH2Li = li;
                    currentH3Ul = null;
                    
                    sections.push(heading);
                } else if (heading.tagName.toLowerCase() === 'h3' && currentH2Li) {
                    if (!currentH3Ul) {
                        const ul = document.createElement("ul");
                        currentH3Ul = ul;
                        
                        ul.className = "sub-menu ps-3";
                        ul.style.overflow = "hidden";
                        ul.style.transition = "max-height 0.3s ease-in-out";
                        ul.style.maxHeight = "0px";
                        ul.style.listStyleType = "none";
                        ul.id = "submenu-" + index;

                        const toggleBtn = document.createElement("button");
                        toggleBtn.className = "dropdown-toggle-btn border-0 bg-transparent ms-2 p-0";
                        toggleBtn.style.transition = "transform 0.3s ease-in-out";
                        toggleBtn.style.cursor = "pointer";
                        toggleBtn.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
                        
                        allDropdowns.push({ ul: ul, btn: toggleBtn });

                        // Open the first one by default if it's the first h2
                        if (currentH2Li === sidebarList.firstElementChild) {
                            ul.style.maxHeight = "1000px";
                            toggleBtn.style.transform = "rotate(180deg)";
                        }

                        toggleBtn.onclick = function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            const isCollapsed = ul.style.maxHeight === "0px" || ul.style.maxHeight === "";
                            
                            // Close other dropdowns
                            allDropdowns.forEach(item => {
                                if (item.ul !== ul) {
                                    item.ul.style.maxHeight = "0px";
                                    item.btn.style.transform = "rotate(0deg)";
                                }
                            });

                            if (isCollapsed) {
                                ul.style.maxHeight = ul.scrollHeight + "px";
                                toggleBtn.style.transform = "rotate(180deg)";
                                setTimeout(() => { if (ul.style.maxHeight !== "0px") ul.style.maxHeight = "1000px"; }, 300);
                            } else {
                                ul.style.maxHeight = "0px";
                                toggleBtn.style.transform = "rotate(0deg)";
                            }
                        };

                        const flexContainer = currentH2Li.querySelector(".heading-wrapper");
                        if (flexContainer) {
                            flexContainer.appendChild(toggleBtn);
                        }

                        currentH2Li.appendChild(ul);
                    }
                    
                    const subLi = document.createElement("li");
                    a.classList.add("sub-link");
                    subLi.appendChild(a);
                    currentH3Ul.appendChild(subLi);
                    
                    sections.push(heading);
                }
            });
        }

        const links = document.querySelectorAll("#dynamic-sidebar li a.nav-link");
        let isClickScrolling = false;

        // Click Event: Change active class and smooth scroll
        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                
                isClickScrolling = true;
                
                links.forEach(l => l.classList.remove("active"));
                this.classList.add("active");

                const targetId = this.getAttribute("href");
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    const headerOffset = 100; // Adjust this if you have a sticky header
                    const elementPosition = targetSection.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                }
                
                // Auto-scroll sidebar when link is clicked
                const sidebarContainer = document.querySelector(".sidebar");
                if (sidebarContainer) {
                    const containerRect = sidebarContainer.getBoundingClientRect();
                    const linkRect = this.getBoundingClientRect();
                    const relativeTop = linkRect.top - containerRect.top + sidebarContainer.scrollTop;
                    
                    // Smoothly center the clicked link in the sidebar
                    const centerOffset = relativeTop - (sidebarContainer.clientHeight / 2) + (linkRect.height / 2);
                    
                    sidebarContainer.scrollTo({
                        top: centerOffset > 0 ? centerOffset : 0,
                        behavior: 'smooth'
                    });
                }
                
                // Release the scroll lock after page scroll is likely finished
                setTimeout(() => {
                    isClickScrolling = false;
                }, 800);
            });
        });

        // Scroll Event: Automatically update active class based on scroll position
        window.addEventListener("scroll", function () {
            let current = "";
            let currentLink = null;
            
            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                const sectionTop = rect.top + window.scrollY;
                // Adjusting the offset so the active class changes properly before it hits the exact top
                if (window.scrollY >= sectionTop - 180) {
                    current = section.getAttribute("id");
                }
            });

            if (current) {
                links.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                        currentLink = link;
                        
                        // Manage accordion open/close logic
                        const parentUl = link.closest('.sub-menu');
                        const li = link.closest('li');
                        const ownUl = li ? li.querySelector('.sub-menu') : null;
                        const targetUl = parentUl || ownUl;

                        // Close all others
                        allDropdowns.forEach(item => {
                            if (item.ul !== targetUl) {
                                item.ul.style.maxHeight = "0px";
                                item.btn.style.transform = "rotate(0deg)";
                            }
                        });

                        // Open target
                        if (targetUl && (targetUl.style.maxHeight === '0px' || targetUl.style.maxHeight === '')) {
                            targetUl.style.maxHeight = targetUl.scrollHeight + "px";
                            setTimeout(() => { if (targetUl.style.maxHeight !== "0px") targetUl.style.maxHeight = "1000px"; }, 300);
                            const toggleBtn = targetUl.parentElement.querySelector('.dropdown-toggle-btn');
                            if (toggleBtn) toggleBtn.style.transform = 'rotate(180deg)';
                        }
                    }
                });
                
                // Scroll the sidebar to keep the active link visible if the list is long
                if (!isClickScrolling) {
                    const sidebarContainer = document.querySelector(".sidebar");
                    if(sidebarContainer && currentLink) {
                        const containerRect = sidebarContainer.getBoundingClientRect();
                        const linkRect = currentLink.getBoundingClientRect();
                        
                        if(linkRect.top < containerRect.top || linkRect.bottom > containerRect.bottom) {
                            const relativeTop = linkRect.top - containerRect.top + sidebarContainer.scrollTop;
                            const centerOffset = relativeTop - (sidebarContainer.clientHeight / 2) + (linkRect.height / 2);
                            
                            sidebarContainer.scrollTo({
                                top: centerOffset > 0 ? centerOffset : 0, 
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            } else if (window.scrollY < 200 && links.length > 0) {
                links.forEach(l => l.classList.remove("active"));
                links[0].classList.add("active");
                
                // If we scroll to the very top, open the first one and close others
                const firstUl = allDropdowns.length > 0 ? allDropdowns[0].ul : null;
                allDropdowns.forEach(item => {
                    if (item.ul !== firstUl) {
                        item.ul.style.maxHeight = "0px";
                        item.btn.style.transform = "rotate(0deg)";
                    } else if (item.ul.style.maxHeight === '0px' || item.ul.style.maxHeight === '') {
                        item.ul.style.maxHeight = "1000px";
                        item.btn.style.transform = "rotate(180deg)";
                    }
                });
            }
        });
    });
</script>

@include('layouts.frontfooter')
