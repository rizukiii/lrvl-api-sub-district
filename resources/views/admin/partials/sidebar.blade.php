<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ asset('template_admin') }}/src/html/index.html" class="text-nowrap logo-img mt-3">
                <img src="rill_kelurahantenan.png" width="180"
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
                    <span class="hide-menu">Dashboard</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-align-left"></i>
                        </span>
                        <span class="hide-nemu">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->is_admin == 1)
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
                            <i class="ti ti-speakerphone"></i>
                        </span>
                        <span class="hide-menu">Announcement</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">GALLERY</span>
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
                    <span class="hide-menu">HAMLET</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('hamlet.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-community"></i>
                        </span>
                        <span class="hide-menu">Hamlet</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('hamlet_number.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building"></i>
                        </span>
                        <span class="hide-menu">Number</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('hamlet_detail.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building"></i>
                        </span>
                        <span class="hide-menu">Detail</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('hamlet_detail.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building"></i>
                        </span>
                        <span class="hide-menu">Programs</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">HAMLET</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('submission.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-license"></i>
                        </span>
                        <span class="hide-menu">Submission</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('forum.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-license"></i>
                        </span>
                        <span class="hide-menu">Forum</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">HTML</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('FrontEnd.profil') }}" aria-expanded="false">
                        <span>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-scan"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /><path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg>
                        </span>
                        <span class="hide-menu">Profil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('FrontEnd.pejabat') }}" aria-expanded="false">
                        <span>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                        </span>
                        <span class="hide-menu">Pejabat</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('FrontEnd.linmas') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-open-source"></i>
                        </span>
                        <span class="hide-menu">Linmas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('FrontEnd.rukun') }}" aria-expanded="false">
                        <span>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /><path d="M19 22v-6" /><path d="M22 19l-3 -3l-3 3" /></svg>
                        </span>
                        <span class="hide-menu">Rukun</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('FrontEnd.pkk') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-affiliate"></i>
                        </span>
                        <span class="hide-menu">PKK</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('FrontEnd.lpmkal') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-fortress"></i>
                        </span>
                        <span class="hide-menu">Lpmkal</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
