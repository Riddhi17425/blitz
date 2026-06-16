@include('layouts.frontheader', [
    'og_image' => asset('public/admin/blogs/front_image/' . $blog->front_image),
    'blog_schema' => $blog->blog_schema ?? ''
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
                '@context' => 'https://schema.org',
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

        <h2 class="title_60 mb-4">{{$blog->title ?? ''}}</h2>
        <p class="baner_desc mb-0">{!! $blog->short_description ?? '' !!}</p>

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
                <h4 class="title_24">CONTENTS</h4>
                <ul>
                    <li><a href="#details" class="nav-link active">Details</a></li>
                    <li><a href="#cta" class="nav-link">CTA</a></li>
                    <li><a href="#conclusion" class="nav-link">Conclusion</a></li>
                    <li><a href="#faq" class="nav-link">FAQs</a></li>
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
                        <p class="title_20 line_left" >faqs</p>
                        {{-- <h2>{{ $industryT ?? 'Protecting Tomorrow\'s Powerful Infrastructure' }}</h2>
                        <p class="mb-0">{{ $industryD ?? 'Industries choose Blitz when system protection, uptime, and electrical safety cannot be compromised.' }}</p> --}}
                    </div>
                    <div class="accordion" id="blitzFaq">
                        @foreach ($blog->blog_faq as $index => $faq)
                        <div class="accordion-item">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_{{ $index }}">
                                    {{ $faq['faq_title'] ?? '' }}
                                </button>
                            </h4>
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
        const links = document.querySelectorAll(".sidebar ul li a.nav-link");
        const sections = document.querySelectorAll(".content-section");

        // Click Event: Change active class and smooth scroll
        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                
                links.forEach(l => l.classList.remove("active"));
                this.classList.add("active");

                const targetId = this.getAttribute("href");
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: "smooth"
                    });
                }
            });
        });

        // Scroll Event: Automatically update active class based on scroll position
        window.addEventListener("scroll", function () {
            let current = "";
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
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
                    }
                });
            }
        });
    });
</script>

@include('layouts.frontfooter')
