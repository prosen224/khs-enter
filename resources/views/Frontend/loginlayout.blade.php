<!doctype html>
<html lang="en">
    <head>
        @include('Frontend.Partials.head')
    </head>

    <body>
        <!-- Preloader -->
        {{-- @include('Admin.partials2.loader') --}}

        <!-- Top Navbar -->
        {{-- @include('Admin.partials2.topnav') --}}
        <!-- Side Menu -->
        {{-- @include('Admin.partials2.sidemenu') --}}

        <!-- Main Content Wrapper -->


        <div class="main-content d-flex flex-column hide-sidemenu">
            <!-- Main Content Layout -->

            @yield('content-wrapper')


        </div>

        {{-- <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <!-- Main Content Layout -->
                            @yield('content-wrapper')
                        </div>
                    </div>
                </div>
            </div>

        </div> --}}
        <!-- End Main Content Wrapper -->

        <!-- Theme Color customizer Right Modal -->
        {{-- @include('Admin.partials2.theme-color-customizer') --}}

        <!-- Footer Scripts -->
        @include('Frontend.Partials.footerscripts')
        @stack('scripts')


    </body>
</html>
