<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Frontend.Partials.head')
    </head>
    <body>
        <!-- Preloader -->
        @include('Frontend.Partials.loader')
        <!-- Side Menu -->
        @include('Frontend.Partials.sidemenu')
        <!-- Top Navbar -->
        @include('Frontend.Partials.topnav')
        <!-- Main Content Wrapper -->
        <div class="pcoded-main-container">
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
        </div>
        <!-- End Main Content Wrapper -->

        <!-- Theme Color customizer Right Modal -->
        {{-- @include('Admin.partials2.theme-color-customizer') --}}

        <!-- Footer Scripts -->
        @include('Frontend.Partials.footerscripts')

        @stack('scripts')

        <!-- Footer -->
        {{-- @include('Admin.partials2.footer') --}}
    </body>
</html>
