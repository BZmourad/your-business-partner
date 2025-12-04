<!doctype html>
<html lang="{{$l}}" @if ($l == "ar") dir="rtl" @endif>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
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
        <style>
            /* Style de base pour les images clients */
            .customer-img {
                width: 225px;
                height: 135px;
                object-fit: contain;
                opacity: 0.7;
                transition: all 0.3s ease;
                padding: 10px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            }
            
            .customer-img:hover {
                opacity: 1;
                transform: scale(1.05);
                box-shadow: 0 5px 15px rgba(0,0,0,0.12);
            }
            
            /* Conteneur marquee */
            .marquee-container {
                width: 100%;
                overflow: hidden;
                white-space: nowrap;
                padding: 15px 0;
                position: relative;
                border-radius: 12px;
            }
            
            /* Masques pour un effet de fondu sur les bords */
            .marquee-container::before,
            .marquee-container::after {
                content: '';
                position: absolute;
                top: 0;
                width: 100px;
                height: 100%;
                z-index: 2;
            }
            
            .marquee-container::before {
                left: 0;
                background: linear-gradient(to right, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%);
            }
            
            .marquee-container::after {
                right: 0;
                background: linear-gradient(to left, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%);
            }
            
            /* Piste de défilement */
            .marquee-track {
                display: inline-flex;
                align-items: center;
                animation: slideImg 40s linear infinite;
                padding: 5px 0;
            }
            
            /* Animation inverse */
            .marquee-reverse {
                animation: slideImgReverse 35s linear infinite;
            }
            
            /* Éléments images */
            .marquee-image {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }
            
            /* Animation de défilement */
            @keyframes slideImg {
                0% {
                    transform: translateX(0%);
                }
                100% {
                    transform: translateX(-50%);
                }
            }
            
            @keyframes slideImgReverse {
                0% {
                    transform: translateX(-50%);
                }
                100% {
                    transform: translateX(0%);
                }
            }
            
            /* Pause au survol */
            .marquee-container:hover .marquee-track {
                animation-play-state: paused;
            }
            
            /* Responsive */
            @media (max-width: 992px) {
                .customer-img {
                    width: 140px;
                    height: 90px;
                }
                
                .marquee-track {
                    animation-duration: 30s;
                }
                
                .marquee-reverse {
                    animation-duration: 25s;
                }
            }
            
            @media (max-width: 768px) {
                .customer-img {
                    width: 120px;
                    height: 80px;
                }
                
                .marquee-track {
                    animation-duration: 25s;
                }
                
                .marquee-reverse {
                    animation-duration: 20s;
                }
                
                .marquee-container::before,
                .marquee-container::after {
                    width: 60px;
                }
            }
            
            @media (max-width: 576px) {
                .customer-img {
                    width: 100px;
                    height: 70px;
                    padding: 8px;
                }
                
                .marquee-image {
                    margin-left: 15px !important;
                    margin-right: 15px !important;
                }
                
                .marquee-track {
                    animation-duration: 20s;
                }
                
                .marquee-reverse {
                    animation-duration: 15s;
                }
            }
            
            /* Fallback pour images manquantes */
            .customer-img:before {
                content: "Client";
                display: none;
                position: absolute;
                font-size: 0.8rem;
                color: #666;
            }
            
            .customer-img[src*="error"]:before,
            .customer-img:not([src]):before {
                display: block;
            }
        </style>
        @stack('styles')
        @switch($l)
            @case("en")
                <script type="text/javascript">
                    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                    (function(){
                        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                        s1.async=true;
                        s1.src='https://embed.tawk.to/6920a428430d9c1961f48dbe/1jbg79gqf';
                        s1.charset='UTF-8';
                        s1.setAttribute('crossorigin','*');
                        s0.parentNode.insertBefore(s1,s0);
                    })();
                </script>
                @break
            @case("fr")
                <script type="text/javascript">
                    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                    (function(){
                        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                        s1.async=true;
                        s1.src='https://embed.tawk.to/6920a428430d9c1961f48dbe/1jbg7ccb7';
                        s1.charset='UTF-8';
                        s1.setAttribute('crossorigin','*');
                        s0.parentNode.insertBefore(s1,s0);
                    })();
                </script>
                @break
            @case("ar")
                <script type="text/javascript">
                    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                    (function(){
                        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                        s1.async=true;
                        s1.src='https://embed.tawk.to/6920a428430d9c1961f48dbe/1jbg7ht2g';
                        s1.charset='UTF-8';
                        s1.setAttribute('crossorigin','*');
                        s0.parentNode.insertBefore(s1,s0);
                    })();
                </script>
                @break
            @default
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
        @endswitch
        {!! SEO::generate() !!}
    </head>
    <body>
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
        @endphp
        @include('welcome.partials.preloader')
        @include('welcome.partials.home')
        @include('welcome.partials.customers')
        @include('welcome.partials.about')
        @include('welcome.partials.services')
        @include('welcome.partials.team')
        @include('welcome.partials.testimonials')
        @include('welcome.partials.faq')
        @include('welcome.partials.contact')
        @include('welcome.partials.footer')
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
        @stack('scripts')
    </body>
</html>