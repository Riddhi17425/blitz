@include('layouts.frontheader')

<section class="py_80">
    <div class="container">
        <div class="breadcrumbs">
            <a href="#">Home</a>
            <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                        stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <a href="#">blogs</a>

            <span><svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.666992 0.666016L5.33366 5.33268L0.666992 9.99935" stroke="#666666"
                        stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <a href="#">The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems</a>

        </div>

        <h2 class="title_60 mb-4">The Ultimate Guide to Surge Protection for Utility-Scale Solar Systems</h2>
        <p class="baner_desc mb-0">As PV installations scale to utility capacities, the risk of lightning-induced surges
            and
            switching transients increases exponentially. Learn the precision engineering protocols required to
            safeguard high-voltage DC arrays.</p>

        <div class="mt-4">
            <img class="img-fluid img_rou" src="{{ asset('public/front/assets/images/ABOUT US IMAGE.webp') }}" alt="blogs banner">
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
                    <li><a href="#intro" class="nav-link active">Introduction</a></li>
                    <li><a href="#vulnerabilities" class="nav-link">System Vulnerabilities</a></li>
                    <li><a href="#solutions" class="nav-link">Protection Solutions</a></li>
                    <li><a href="#products" class="nav-link">Product Recommendations</a></li>
                    <li><a href="#faq" class="nav-link">FAQs</a></li>
                </ul>

            </aside>

            <!-- Main Content -->
            <div class="content">

                <!-- Introduction -->
                <div class="content-section" id="intro">

                    <h2>Difference Between SPD and MCB - Complete Guide</h2>

                    <p>
                        Electrical protection is an extremely important process in establishing the safety,
                        reliability and life of the new electrical systems.
                    </p>

                    <p>
                        The <strong>SPD (Surge Protective Device)</strong> and the
                        <strong>MCB (Miniature Circuit Breaker)</strong> are both regarded to be two of the most
                        essential protection appliances of the contemporary world.
                    </p>

                </div>

                <!-- Vulnerabilities -->
                <div class="content-section" id="vulnerabilities">

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

                <!-- Solutions -->
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

                <!-- Products -->
                <div class="content-section" id="products">

                    <h2>Product Recommendations</h2>

                    <p>
                        Choose high-quality protection devices from trusted electrical
                        brands with certified safety standards and long operational life.
                    </p>

                </div>


                <div class="content-section" id="faq">>
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

                <!-- FAQ -->
                <div class="content-section" id="faq">

                    <h2>Real-Life Example – Renewable Energy Installation</h2>

                    <p>Solar energy farms are unique among industrial facilities due to their immense physical footprint
                        and exposure to atmospheric phenomena. The interconnected nature of DC strings and AC collection
                        networks creates multiple entry points for high-energy surges that can cripple production for
                        weeks.</p>

                </div>

                <!-- FAQ -->
                <div class="content-section" id="faq">

                    <h2>Real-Life Example – Renewable Energy Installation</h2>

                    <p>Solar energy farms are unique among industrial facilities due to their immense physical footprint
                        and exposure to atmospheric phenomena. The interconnected nature of DC strings and AC collection
                        networks creates multiple entry points for high-energy surges that can cripple production for
                        weeks.</p>
                </div>

                <div class="content-section" id="faq">
                    <div class="pb_40">
                        <p class="title_20 line_left" data-aos="fade-up" data-aos-duration="800">Industries We Serve</p>
                        <h2 class="title_44">Powering Critical Infrastructure</h2>
                        <p class="mb-0">From solar farms to residential towers, Blitz products safeguard the
                            infrastructure that
                            drives progress.</p>
                    </div>
                    <div class="accordion" id="blitzFaq">

                        <div class="accordion-item">
                            <h4 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne">
                                    What industries commonly use Blitz electrical protection products?
                                </button>
                            </h4>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#blitzFaq">
                                <div class="accordion-body">
                                    Blitz electrical protection products are widely used across various industries
                                    including
                                    manufacturing, automotive, renewable energy, telecommunications, and residential
                                    construction to ensure safe and reliable power management.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
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
                        </div>

                    </div>
                </div>

                <section class="tec_res blogs_details_cta">
                    <div class="h-100">
                        <div class="tec_res_left">
                            <p class="title_20 line_left" data-aos="fade-up" data-aos-duration="800">Technical resources
                            </p>
                            <h2 class="title_44">Download Our Complete
                                Product Catalogue</h2>
                            <p class="mb-0">Access detailed technical specifications, dimensional drawings, and
                                selection
                                guides for our complete product range.</p>

                            <div class="pt_40">
                                <a href="#" class="com_btn">
                                    <span class="me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15"
                                                stroke="black" stroke-width="1.33333" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M7 10L12 15L17 10" stroke="black" stroke-width="1.33333"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 15V3" stroke="black" stroke-width="1.33333"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span> Download Catalogue
                                </a>

                                <a href="#" class="com_btn ms-3">
                                    <span class="me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7L15 2Z"
                                                stroke="white" stroke-width="1.33333" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M14 2V6C14 6.53043 14.2107 7.03914 14.5858 7.41421C14.9609 7.78929 15.4696 8 16 8H20"
                                                stroke="white" stroke-width="1.33333" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M10 9H8" stroke="white" stroke-width="1.33333"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 13H8" stroke="white" stroke-width="1.33333"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 17H8" stroke="white" stroke-width="1.33333"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span> Technical Datasheets
                                </a>

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</section>

@include('layouts.frontfooter')