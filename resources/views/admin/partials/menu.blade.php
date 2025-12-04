<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main mt-1 mb-4" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @yield('active_dashboard')">
                <a href="{{ route('home')}}">
                    <i class="la la-dashboard"></i><span class="menu-title" >{{ __('Dashboard')}}</span>
                </a>
            </li>
            @can('customers')
                <li class="nav-item @yield('active_customers')">
                    <a href="{{ route('admin.customers.index')}}">
                        <i class="icon-users"></i><span class="menu-title" >{{ __('Customers')}}</span>
                    </a>
                </li>
            @endcan
            @can('partners')
                <li class="nav-item @yield('active_partners')">
                    <a href="{{ route('admin.partners.index')}}">
                        <i class="icon-user-following"></i><span class="menu-title" >{{ __('Partners')}}</span>
                    </a>
                </li>
            @endcan
            @can('services')
                <li class="nav-item @yield('active_services')">
                    <a href="{{ route('admin.services.index')}}">
                        <i class="la la-briefcase"></i><span class="menu-title" >{{ __('Services')}}</span>
                    </a>
                </li>
            @endcan
            @if (auth()->user()->hasServices())
                <li class="nav-item @yield('active_new_requests')">
                    <a href="{{ route('admin.requests.choose.services')}}">
                        <i class="la la-plus"></i><span class="menu-title" >{{ __('Nouveau Demande')}}</span>
                    </a>
                </li>
            @endif
            <li class="nav-item @yield('active_requests')">
                <a href="{{ route('admin.requests.index')}}">
                    <i class="la la-files-o"></i><span class="menu-title" >{{ __('Demandes')}}</span>
                </a>
            </li>
            <li class="nav-item @yield('active_documents')">
                <a href="{{ route('admin.documents.index')}}">
                    <i class="la la-folder-open"></i><span class="menu-title" >{{ __('Documents')}}</span>
                </a>
            </li>
            @can('report')
                <li class="nav-item @yield('active_reports')">
                    <a href="{{ route('admin.reports.index')}}">
                        <i class="la la-bar-chart"></i><span class="menu-title" >{{ __('Reports')}}</span>
                    </a>
                </li>
            @endcan
            @can('timelines')
                <li class="nav-item @yield('active_timelines')">
                    <a href="{{ route('admin.timelines.index')}}">
                        <i class="la la-clock-o"></i><span class="menu-title" >{{ __('Timelines')}}</span>
                    </a>
                </li>
            @endcan
            @canany(['configuration', 'users', 'contacts'])
                <li class="navigation-header">
                    <span>{{ __("Administration")}}</span>
                    <i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Administration')}}"></i>
                </li>
                @can('configuration')
                    <li class="nav-item">
                        <a href="#"><i class="la la-cogs"></i><span class="menu-title">{{ __('Configuration')}}</span></a>
                        <ul class="menu-content">
                            <li class="@yield('active_config_company')"><a class="menu-item" href="{{ route('admin.config.company.index')}}"><i class="la la-building mr-1"></i><span>{{ __('Company')}}</span></a></li>
                            <li class="@yield('active_config_logo')"><a class="menu-item" href="{{ route('admin.config.logo.index')}}"><i class="la la-image mr-1"></i><span>{{ __('Logo')}}</span></a></li>
                            <li class="@yield('active_config_docs')"><a class="menu-item" href="{{ route('admin.config.docs.index')}}"><i class="la la-folder-open mr-1"></i><span>{{ __('Documents')}}</span></a></li>
                        </ul>
                    </li>
                @endcan
                @can('users')
                    <li class="nav-item @yield('active_roles')">
                        <a href="{{ route('admin.roles.index')}}">
                            <i class="la la-key"></i><span class="menu-title" >{{ __('Roles')}}</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('active_users')">
                        <a href="{{ route('admin.users.index')}}">
                            <i class="la la-users"></i><span class="menu-title" >{{ __('Users')}}</span>
                        </a>
                    </li>
                @endcan
                @can('contacts')
                    <li class="nav-item @yield('active_contacts')">
                        <a href="{{ route('admin.contacts.index')}}">
                            <i class="la la-wechat"></i><span class="menu-title" >{{ __('Contacts')}}</span>
                        </a>
                    </li>
                @endcan
            @endcanany
        </ul>
    </div>
</div>