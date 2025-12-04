<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main mt-1" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @yield('active_dashboard')">
                <a href="{{ route('home')}}">
                    <i class="la la-dashboard"></i><span class="menu-title" >{{ __('Dashboard')}}</span>
                </a>
            </li>
            <li class="nav-item @yield('active_new_requests')">
                <a href="{{ route('customer.requests.choose.services')}}">
                    <i class="la la-plus"></i><span class="menu-title" >{{ __('Nouveau Demande')}}</span>
                </a>
            </li>
            <li class="nav-item @yield('active_requests')">
                <a href="{{ route('customer.requests.index')}}">
                    <i class="la la-files-o"></i><span class="menu-title" >{{ __('Demandes')}}</span>
                </a>
            </li>
            <li class="nav-item @yield('active_documents')">
                <a href="{{ route('customer.documents.index')}}">
                    <i class="la la-folder-open"></i><span class="menu-title" >{{ __('Documents')}}</span>
                </a>
            </li>
        </ul>
    </div>
</div>