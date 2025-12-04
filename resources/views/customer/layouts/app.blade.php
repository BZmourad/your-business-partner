<!DOCTYPE html>
<html class="loading" lang="{{Auth::user()->lang}}" @if(Auth::user()->lang != 'ar') data-textdirection="ltr" @else data-textdirection="rtl" @endif>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title') </title>
    <link rel="apple-touch-icon" href="{{ asset(config('company.logo')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('company.logo')) }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">
    @if (Auth::user()->lang != 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/bootstrap-extended.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/colors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/components.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/core/colors/palette-gradient.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/pages/single-page.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/assets/css/style.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/vendors-rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/bootstrap-extended.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/colors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/components.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/custom-rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/core/menu/menu-types/horizontal-menu.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/pages/single-page.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/assets/css/style-rtl.css') }}">
    @endif
    @include('layout.partials.loader.style')
    @include('layout.partials.pointer.style')
    @include('layout.partials.scroll-top.style')
    @stack('styles')
</head>
<body class="horizontal-layout horizontal-menu 2-columns" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    @include('layout.partials.loader.html')
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('home')}}">
                            <img class="brand-logo" alt="modern admin logo" src="{{ asset(config('company.logo')) }}">
                            <h3 class="brand-text">{{ config('app.name') }}</h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-dark">
                                    @if (Auth::user()->lang == 'fr')
                                        {{ __('French')}}
                                    @else
                                        {{ __('Arabic')}}
                                    @endif
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('setLang','fr')}}" > {{ __('French')}}</a>
                                <a class="dropdown-item" href="{{route('setLang','ar')}}" > {{ __('Arabic')}}</a>
                            </div>
                        </li>
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="mr-1 user-name text-bold-700">{{ Auth::user()->name }}</span>
                                <span class="avatar avatar-online">
                                    <img src="{{ asset('storage/users/' . auth()->user()->avatar) }}" alt="avatar"><i></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="ft-user"></i> {{ __('Profile')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ft-power"></i> {{ __('Logout')}}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item @yield('active_dashboard')"><a class="nav-link" href="{{ route('home')}}"><i class="la la-dashboard"></i><span>{{ __('Dashboard')}}</span></a></li>
                <li class="nav-item @yield('active_new_requests')"><a class="nav-link" href="{{ route('customer.requests.choose.services')}}"><i class="la la-plus"></i><span>{{ __('Nouveau Demande')}}</span></a></li>
            </ul>
        </div>
    </div>
    @yield('content')
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <button class="scroltop icon-up" type="button" id="scroll-to-top"><i class="fas fa-arrow-up"></i></button>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/js/scripts/customizer.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/js/scripts/footer.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js') }}"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
    @include('layout.partials.loader.script')
    @include('layout.partials.pointer.script')
    @include('layout.partials.scroll-top.script')
    @include('layout.partials.ajaxForm')
    @if(session('success'))
        <script>$(document).ready((function() {toastr.success("{{ session('success') }}")}));</script>
    @endif
    @if(session('errors'))
        <script>$(document).ready((function() {toastr.error("{{ session('errors') }}")}));</script>
    @endif
    @stack('scripts')
  </body>
</html>