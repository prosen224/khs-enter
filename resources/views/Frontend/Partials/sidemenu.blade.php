<nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="{{url('/')}}" class="b-brand">
                <img width="40" src="{{ asset ('assets/images/logo/pro-2.png') }}" alt="" class="logo images" width="60%">
                <img width="40" src="{{ asset ('assets/images/logo/pro-2.png') }}" alt="" class="logo-thumb images" alt="Aerial" width="60%">
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div" >
            <ul class="nav pcoded-inner-navbar">
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('home')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">{{__('Dashboard')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('information')}}?page=1" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-list-check"></i></span><span class="pcoded-mtext">{{__('Information')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('information.report')}}" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-flag"></i></span><span class="pcoded-mtext">{{__('Report')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('technician')}}" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-screwdriver-wrench"></i></span><span class="pcoded-mtext">{{__('Technicians')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('clients')}}" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-users"></i></span><span class="pcoded-mtext">{{__('Clients')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('type-of-work')}}" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-briefcase"></i></span><span class="pcoded-mtext">{{__('Type of Work')}}</span></a>
                </li>
                @can('isSuparAdmin')
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('all-user')}}" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-user-gear"></i></span><span class="pcoded-mtext">{{__('Users')}}</span></a>
                </li>
                @endcan
                
            </ul>
        </div>
    </div>
</nav>
