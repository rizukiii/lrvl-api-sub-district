<!doctype html>
<html lang="en">

@include('admin.partials.head')
@stack('head')

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.partials.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.partials.navbar')
            <!--  Header End -->
            <div class="container-fluid">
                <main>
                    @yield('content')
                </main>
                @include('admin.partials.footer')
            </div>
        </div>
    </div>
    @include('admin.partials.script')
    @stack('script')
</body>

</html>
