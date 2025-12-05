<section id="home">
    <header class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="header-left">
                        <div class="header-left-card">
                            <ul>
                                <li>
                                    <div class="head-icon">
                                        <i class='bx bxs-location-plus'></i>
                                    </div>
                                    <a href="#"> {{ __("Rue de La Palestine, Tunis, 1002", [], $l) }}</a>
                                </li>
                                <li>
                                    <div class="head-icon">
                                        <i class='bx bxs-phone'></i>
                                    </div>
                                    <a href="tel:+21624674032">+216 24674032</a>
                                </li>
                                <li>
                                    <div class="head-icon">
                                        <i class='bx bxs-envelope'></i>
                                    </div>
                                    <a href="mailto:ybp.businesstn@gmail.com"><span>ybp.businesstn@gmail.com</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="header-right">
                        <div class="top-social-link">
                            <ul>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-linkedin'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="language">
                            <i class='bx bx-world language-icon'></i>
                            <select class="language-list-item" onchange="window.location.href = this.value">
                                <option value="{{route('en.welcome')}}" {{($l == "en") ? 'selected' : ''}}>English</option>
                                <option value="{{route('ar.welcome')}}" {{($l == "ar") ? 'selected' : ''}}>العربيّة</option>
                                <option value="{{route('fr.welcome')}}" {{($l == "fr") ? 'selected' : ''}}>Français</option>
                            </select>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-area">
        <div class="mobile-nav">
            <a href="{{route($l.'.welcome')}}" class="logo">
                <img src="{{ asset('welcome/assets/img/logo-dark.png') }}"  width="75"class="logo-one" alt="Logo">
                <img src="{{ asset('welcome/assets/img/logo-white.png') }}" width="75" class="logo-two" alt="Logo">
            </a>
        </div>
        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <a class="navbar-brand" href="{{route($l.'.welcome')}}">
                        <img src="{{ asset('welcome/assets/img/logo-dark.png') }}"  width="75"class="logo-one" alt="Logo">
                        <img src="{{ asset('welcome/assets/img/logo-white.png') }}" width="75" class="logo-two" alt="Logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <a href="#home" class="nav-link active">
                                    {{ __("Home", [], $l)}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#about" class="nav-link">
                                    {{ __("About", [], $l)}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#services" class="nav-link">
                                    {{ __("Services", [], $l)}} 
                                    <i class='bx bx-chevron-down'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($services as $service)
                                        <li class="nav-item">
                                            <a href="{{route($l.'.welcome.service', $service['slug'])}}" class="nav-link">
                                                {{ __($service['name'], [], $l)}} 
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#team" class="nav-link">
                                    {{ __("Team", [], $l)}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#testimonials" class="nav-link">
                                    {{ __("Testimonials", [], $l)}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#faq" class="nav-link">
                                    {{ __("FAQ", [], $l)}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#contact" class="nav-link">
                                    {{ __("Contact", [], $l)}}
                                </a>
                            </li>
                            @if (Route::has('login') && !env('MODE_VITRINE', 0))
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/home') }}" class="nav-link">
                                            {{ __("Dashboard", [], $l)}}
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">
                                            {{ __("Login", [], $l)}}
                                        </a>
                                    </li>
                                @endauth
                            @endif
                        </ul>
                        <div class="others-options d-flex align-items-center">
                            <div class="option-item">
                                <div class="menu-icon d-in-line">
                                    <a href="#" class="burger-menu menu-icon-two">
                                        <i class='flaticon-menu'></i>
                                    </a>
                                </div>	
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="side-nav-responsive">
            <div class="container">
                <div class="dot-menu">
                    <div class="circle-inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="side-nav-inner">
                        <div class="side-nav justify-content-center align-items-center">
                            <div class="side-item">
                                <div class="option-item">
                                    <div class="menu-icon d-in-line">
                                        <a href="#" class="burger-menu menu-icon-two">
                                            <i class='flaticon-menu'></i>
                                        </a>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-modal">
        <div class="sidebar-modal-inner">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="{{ asset('welcome/assets/img/logo-dark.png') }}"  width="75"class="logo-one" alt="Logo">
                    <img src="{{ asset('welcome/assets/img/logo-white.png') }}" width="75" class="logo-two" alt="Logo">
                </div>
                <span class="close-btn sidebar-modal-close-btn">
                    <i class="bx bx-x"></i>
                </span>
            </div>
            <div class="contact-us">
                <h2>{{ __("Contact Us", [], $l) }}</h2>
                <ul>
                    <li>
                        <i class='bx bx-mail-send'></i>
                        <a href="mailto:ybp.businesstn@gmail.com"><span>ybp.businesstn@gmail.com</span></a>
                    </li>
                    <li>
                        <i class='bx bx-mobile'></i>
                        <a href="tel:+21624674032">+216 24 674 032</a>
                    </li>
                    <li>
                        <i class='bx bx-mobile'></i>
                        <a href="tel:+21620674366">+216 20 674 366</a>
                    </li>
                    <li>
                        <i class='bx bx-phone-call'></i>
                        <a href="tel:+21636643848">+216 36 643 848</a>
                    </li>
                    <li>
                        <i class='bx bx-current-location'></i>
                        {{ __("Address", [], $l) }}: {{ __("5 -ème étage bureau 2 , immeuble ALQUDS : 85-87 Rue de La Palestine, Tunis, Tunis, Tunisia, 1002", [], $l) }}
                    </li>
                </ul>
            </div>
            <div class="sidebar-follow-us">
                <h2>{{ __("Follow Us", [], $l)}}</h2>
                <ul class="social-wrap">
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-instagram-feed mt-2">
                <h2>{{ __("Instagram", [], $l)}}</h2>
                <ul>
                    @for ($i = 1; $i < 7; $i++)
                        <li>
                            <a href="#">
                                <img src="{{ asset('welcome/assets/img/instagram/'.$i.'.jpeg') }}" alt="image">
                            </a>
                        </li> 
                    @endfor
                </ul>
            </div>
        </div>
    </div>
    <div class="banner-area-two">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 ps-0">
                    <div class="banner-img-two">
                        <div class="banner-images">
                            <img src="{{ asset('welcome/assets/img/home-two/home-two-img.png') }}" alt="Images">
                        </div>
                        <div class="banner-half-circle"></div>
                        <div class="dots">
                            <img src="{{ asset('welcome/assets/img/home-two/dots2.png') }}" alt="Images">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-content banner-two-content">
                        <span>{{ __("Your Comprehensive Business Partner in Tunisia", [], $l)}}</span>
                        <h1>{{ __("Expert Business Solutions for Success in the Tunisian Market", [], $l)}}</h1>
                        <p>
                            {{ __("Complete business services from company creation to investment consulting and premium business support. Your trusted partner for success in Tunisia.", [], $l)}}
                        </p>
                        <div class="banner-btn">
                            <a href="#contact" class="contact-btn">{{ __("Contact Us", [], $l)}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-two-shape">
            <div class="shape-1">
                <img src="{{ asset('welcome/assets/img/home-two/dots.png') }}" alt="Images">
            </div>
            <div class="shape-2">
                <img src="{{ asset('welcome/assets/img/home-two/shape1.png') }}" alt="Images">
            </div>
            <div class="shape-3">
                <img src="{{ asset('welcome/assets/img/home-two/shape3.png') }}" alt="Images">
            </div>
            <div class="shape-4">
                <img src="{{ asset('welcome/assets/img/home-two/shape-bottom.png') }}" alt="Images">
            </div>
        </div>
    </div>
</section>