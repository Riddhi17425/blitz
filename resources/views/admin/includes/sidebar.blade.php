<!-- sidebar -->
        <div class="sidebar px-4 py-4 py-md-4 me-0">
            <div class="d-flex flex-column h-100">
                <a href="{{ route('dashboard') }}" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <i class="bi bi-bag-check-fill fs-4"></i>
                    </span>
                    <span class="logo-text">Blitz</span>
                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3">
                    <li><a class="m-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="icofont-home fs-5"></i> <span>Dashboard</span></a></li>
 
                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('testimonials') ? 'active' : '' }} {{ request()->routeIs('testimonials.addtestimonials') ? 'active' : '' }} {{ request()->routeIs('testimonials.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-testimonials" href="javascript:void(0);">
                            <i class="icofont-quote-left fs-5"></i> <span>Testimonials</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse" id="menu-testimonials">
                                <li><a class="ms-link {{ request()->routeIs('testimonials') ? 'active' : '' }}" href="{{ route('testimonials') }}">List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('testimonials.addtestimonials') ? 'active' : '' }}" href="{{ route('testimonials.addtestimonials') }}">Add</a></li>
                            </ul>
                    </li>

                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('banners') ? 'active' : '' }} {{ request()->routeIs('banners.create') ? 'active' : '' }} {{ request()->routeIs('banners.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-banners" href="javascript:void(0);">
                            <i class="icofont-image fs-5"></i> <span>Banner</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse" id="menu-banners">
                                <li><a class="ms-link {{ request()->routeIs('banners') ? 'active' : '' }}" href="{{ route('banners') }}">List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('banners.create') ? 'active' : '' }}" href="{{ route('banners.create') }}">Add</a></li>
                            </ul>
                    </li>
                    
                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('blogs') ? 'active' : '' }} {{ request()->routeIs('blogs.addBlogs') ? 'active' : '' }} {{ request()->routeIs('blogs.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-blogs" href="javascript:void(0);">
                            <i class="icofont-notebook fs-5"></i> <span>Blogs</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse" id="menu-blogs">
                                <li><a class="ms-link {{ request()->routeIs('blogs') ? 'active' : '' }}" href="{{ route('blogs') }}">Blogs List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('blogs.addBlogs') ? 'active' : '' }}" href="{{ route('blogs.addBlogs') }}">Blogs Add</a></li>
                            </ul> 
                    </li>

                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('industries') ? 'active' : '' }} {{ request()->routeIs('industries.create') ? 'active' : '' }} {{ request()->routeIs('industries.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-industries" href="javascript:void(0);">
                            <i class="icofont-institution fs-5"></i> <span>Industries</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <ul class="sub-menu collapse" id="menu-industries">
                                <li><a class="ms-link {{ request()->routeIs('industries') ? 'active' : '' }}" href="{{ route('industries') }}">List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('industries.create') ? 'active' : '' }}" href="{{ route('industries.create') }}">Add</a></li>
                            </ul>
                    </li>

                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('categories') ? 'active' : '' }} {{ request()->routeIs('categories.create') ? 'active' : '' }} {{ request()->routeIs('categories.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-categories" href="javascript:void(0);">
                            <i class="icofont-tags fs-5"></i> <span>Categories</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <ul class="sub-menu collapse" id="menu-categories">
                                <li><a class="ms-link {{ request()->routeIs('categories') ? 'active' : '' }}" href="{{ route('categories') }}">List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('categories.create') ? 'active' : '' }}" href="{{ route('categories.create') }}">Add</a></li>
                            </ul>
                    </li>

                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('sub_categories') ? 'active' : '' }} {{ request()->routeIs('sub_categories.create') ? 'active' : '' }} {{ request()->routeIs('sub_categories.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-sub-categories" href="javascript:void(0);">
                            <i class="icofont-listing-box fs-5"></i> <span>Sub Categories</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <ul class="sub-menu collapse" id="menu-sub-categories">
                                <li><a class="ms-link {{ request()->routeIs('sub_categories') ? 'active' : '' }}" href="{{ route('sub_categories') }}">List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('sub_categories.create') ? 'active' : '' }}" href="{{ route('sub_categories.create') }}">Add</a></li>
                            </ul>
                    </li>

                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('products') ? 'active' : '' }} {{ request()->routeIs('products.create') ? 'active' : '' }} {{ request()->routeIs('products.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-products" href="javascript:void(0);">
                            <i class="icofont-box fs-5"></i> <span>Products</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <ul class="sub-menu collapse" id="menu-products">
                                <li><a class="ms-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('products.create') ? 'active' : '' }}" href="{{ route('products.create') }}">Add</a></li>
                            </ul>
                    </li>

                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('faqs') ? 'active' : '' }} {{ request()->routeIs('faqs.create') ? 'active' : '' }} {{ request()->routeIs('faqs.edit') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-faqs" href="javascript:void(0);">
                            <i class="icofont-question-circle fs-5"></i> <span>FAQs</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <ul class="sub-menu collapse" id="menu-faqs">
                                <li><a class="ms-link {{ request()->routeIs('faqs') ? 'active' : '' }}" href="{{ route('faqs') }}">List</a></li>
                                <li><a class="ms-link {{ request()->routeIs('faqs.create') ? 'active' : '' }}" href="{{ route('faqs.create') }}">Add</a></li>
                            </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link {{ request()->routeIs('settings') ? 'active' : '' }} {{ request()->routeIs('settings.update') ? 'active' : '' }}" href="{{ route('settings') }}">
                            <i class="icofont-settings fs-5"></i> <span>Settings</span></a>
                    </li>
                </ul>
                <!-- Menu: menu collepce btn -->
                <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                    <span class="ms-2"><i class="icofont-bubble-right"></i></span>
                </button>
            </div>
        </div>                 