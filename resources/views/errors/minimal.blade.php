<!DOCTYPE html>
<html class="loading" lang="{{Auth::user()->lang??'fr'}}" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title> @yield('title') | {{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" href="{{ asset(config('company.logo')) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('company.logo')) }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/bootstrap-extended.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/colors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/components.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/core/colors/palette-gradient.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/pages/error.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/assets/css/style.css') }}">
        <style>
            #branding_logo {
                max-width: 200px;
            }
        </style>
    </head>
    <body class="vertical-layout vertical-menu-modern 1-column blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body pb-5">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="col-lg-4 col-md-8 col-10 p-0">
                                <div class="card-header bg-transparent border-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset(config('company.logo')) }}" alt="branding logo" id="branding_logo">
                                    </div>
                                    <h2 class="error-code text-center mb-2">@yield('code')</h2>
                                    <h3 class="text-uppercase text-center">@yield('message')</h3>
                                </div>
                                <div class="card-content">
                                    <div class="row py-2">
                                        <div class="col-12">
                                            <a href="{{ route('home') }}" class="btn btn-primary btn-block"><i class="la la-home"></i> {{ __('Dashboard')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <script src="{{ asset('modern-admin/app-assets/vendors/js/vendors.min.js') }}"></script>
        <script src="{{ asset('modern-admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
        <script src="{{ asset('modern-admin/app-assets/js/core/app-menu.min.js') }}"></script>
        <script src="{{ asset('modern-admin/app-assets/js/core/app.min.js') }}"></script>
        <script src="{{ asset('modern-admin/app-assets/js/scripts/forms/form-login-register.min.js') }}"></script>
    </body>
</html>
