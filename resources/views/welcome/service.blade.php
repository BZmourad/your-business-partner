@php
    $services = [
        [
            'slug' => 'conseil_fiscal_entreprises',
            'name' => 'Conseil fiscal aux entreprises',
            'description' => 'Service de conseil fiscal spécialisé pour les entreprises',
            'icon' => 'fas fa-handshake'
        ],
        [
            'slug' => 'declarations_fiscales',
            'name' => 'Déclarations fiscales',
            'description' => 'Préparation et dépôt des déclarations fiscales',
            'icon' => 'fas fa-file-alt'
        ],
        [
            'slug' => 'creation_entreprise',
            'name' => 'Création d\'entreprise',
            'description' => 'Assistance à la création d\'entreprise',
            'icon' => 'fas fa-lightbulb'
        ]
    ];
    $service = $services[0];
    foreach ($services as $s) {
        if ($s['slug'] == $slug) {
            $service = $s;
        }
    }
@endphp

<!doctype html>
<html lang="{{$l}}" @if ($l == "ar") dir="rtl" @endif>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">
        @if ($l == "ar")
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/bootstrap.rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/animate.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/fonts/flaticon.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/boxicons.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/owl.carousel.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/owl.theme.default.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/magnific-popup.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/meanmenu.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/nice-select.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/nice-select.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/responsive.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/theme-dark.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/rtl/assets/css/rtl.css') }}">
        @else
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/animate.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/fonts/flaticon.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/boxicons.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/owl.carousel.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/owl.theme.default.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/magnific-popup.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/meanmenu.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/nice-select.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/nice-select.min.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/responsive.css') }}">
            <link rel="stylesheet" href="{{ asset('welcome/assets/css/theme-dark.css') }}">
        @endif
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/extensions/toastr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/plugins/extensions/toastr.min.css') }}">
        <title>{{ __("YBP - YOUR BUSINESS PARTNER", [], $l)}}</title>
        <link rel="icon" type="image/png" href="{{ asset('welcome/assets/img/logo-favicon.png') }}">
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/6920a428430d9c1961f48dbe/1jajo2g7n';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        {!! SEO::generate() !!}
    </head>
    <body>
        @include('welcome.partials.preloader')
        @include('welcome.partials.home2')
        <div class="inner-banner inner-bg11">
            <div class="container">
                <div class="inner-title text-center">
                    <h3>{{ __("Service Details", [], $l)}}</h3>
                    <ul>
                        <li>
                            <a href="{{route($l.'.welcome')}}">{{ __("Home", [], $l)}}</a>
                        </li>
                        <li>
                            <i class='bx bxs-chevron-right'></i>
                        </li>
                        <li>{{ __($service['name'], [], $l)}}</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('welcome.services.'.$service['slug'])
        @include('welcome.partials.contact')
        @include('welcome.partials.footer2')
        @if ($l == "ar")
            <script src="{{ asset('welcome/rtl/assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/wow.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/jquery.magnific-popup.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/meanmenu.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/jquery.nice-select.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/jquery.ajaxchimp.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/form-validator.min.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/contact-form-script.js') }}"></script>
            <script src="{{ asset('welcome/rtl/assets/js/custom.js') }}"></script>
        @else
            <script src="{{ asset('welcome/assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/wow.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/jquery.magnific-popup.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/meanmenu.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/jquery.nice-select.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/jquery.ajaxchimp.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/form-validator.min.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/contact-form-script.js') }}"></script>
            <script src="{{ asset('welcome/assets/js/custom.js') }}"></script>  
        @endif
        <script src="{{ asset('modern-admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
        <script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
        @include('layout.partials.ajaxForm')
        <script>
            $(document).ready(function() {
                ajaxForm('#contactForm');
            });
        </script>
    </body>
</html>