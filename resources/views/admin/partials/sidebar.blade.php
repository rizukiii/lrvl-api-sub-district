<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ asset('template_admin') }}/src/html/index.html" class="text-nowrap logo-img">
                <img src="{{ asset('template_admin') }}/src/assets/images/logos/dark-logo.svg" width="180"
                    alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ asset('template_admin') }}/src/html/index.html"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">IMPORTANT</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('news.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">News</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('announcement.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">Announcement</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">ABOUT</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('gallery.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-photo"></i>
                        </span>
                        <span class="hide-menu">Gallery</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Daerah</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('hamlet.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-photo"></i>
                        </span>
                        <span class="hide-menu">Hamlet</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('hamlet_number.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-photo"></i>
                        </span>
                        <span class="hide-menu">Hamlet Number</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-photo"></i>
                        </span>
                        <span class="hide-menu">Hamlet Detail</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-photo"></i>
                        </span>
                        <span class="hide-menu">Hamlet Program</span>
                    </a>
                </li>
                {{--  --}}
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">HTML</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('FrontEnd.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">Index</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
