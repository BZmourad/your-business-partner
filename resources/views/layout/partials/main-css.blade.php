<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/fonts/simple-line-icons/style.min.css') }}">
@if(Auth::user()->lang != 'ar')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/assets/css/style.css') }}">
@else
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/vendors-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/custom-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/assets/css/style-rtl.css') }}">
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/extensions/toastr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/plugins/extensions/toastr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/animate/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/forms/icheck/custom.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/plugins/forms/checkboxes-radios.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/fancybox/jquery.fancybox.css') }}">
@include('layout.partials.loader.style')
@include('layout.partials.scroll-top.style')
@include('layout.partials.uploadFiles.style')
<style>
    .bg-blue-dark{
        background-color: #002960 !important;
    }
    .blue-dark{
        color: #002960 !important;
    }
    .badge-white {
        background-color: #ffffff !important; 
    }
    .actions-datatable .dropdown-toggle::after {
        content: none !important;
    }
    .actions-datatable i {
        margin-right: 0 !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff !important;
        background-color: #002960 !important;
    }
    .nav.nav-pills .nav-item a.nav-link {
        color: #002960;
    }
</style>
<style>
    .file-item{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: background-color 0.2s;
    }
    .file-info {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .file-name {
        font-weight: 500;
        margin-bottom: 3px;
    }
    .file-size {
        font-size: 0.8rem;
        color: #6c757d;
    }
    .file-actions {
        display: flex;
        gap: 8px;
    }
    .btn-download {
        background-color: #2c5aa0;
        color: white;
    }
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-preview {
        background-color: #17a2b8;
        color: white;
    }
</style>
<style>
    .service-detail-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .service-detail-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e0e0e0;
        border-radius: 8px 8px 0 0;
    }
    .service-detail-body {
        padding: 20px;
    }
    .detail-item {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
    }
    .detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .detail-label {
        font-weight: 600;
        color: #546e7a;
        margin-bottom: 5px;
    }
    .detail-value {
        color: #37474f;
    }
    .badge-required {
        background-color: #ff5252;
        color: white;
    }
    .badge-optional {
        background-color: #ff9800;
        color: white;
    }
    .badge-multiple {
        background-color: #2196f3;
        color: white;
    }
    .badge-single {
        background-color: #9c27b0;
        color: white;
    }
    .field-type-badge {
        background-color: #607d8b;
        color: white;
        font-size: 0.8rem;
    }
</style>
<style>
    .page-item.active .page-link {
        background-color: #002960 !important;
        border-color: #002960 !important;
        color: white !important;
    }
    .pagination .page-link {
        color: #002960 !important;
        border: 1px solid #002960 !important;
    }
</style>