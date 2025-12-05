<footer class="footer-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                    <div class="footer-logo">
                        <a href="{{route($l.'.welcome')}}">
                            <img src="{{ asset('welcome/assets/img/logo-dark.png') }}" width="75"class="footer-logo-one" alt="Logo">
                            <img src="{{ asset('welcome/assets/img/logo-white.png') }}" width="75" class="footer-logo-two" alt="Logo">
                        </a>
                    </div>
                    <p>
                        {{ __("Reliable tax advisory services tailored to Tunisian and international regulations.", [], $l)}} 
                    </p>
                    <ul class="social-link">
                        <li>
                            <a href="https://www.facebook.com/yourbusinesspartnertn" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li> 
                        <li>
                            <a href="https://www.linkedin.com/in/lotfi-alimi-b23a59130/" target="_blank"><i class='bx bxl-linkedin'></i></a>
                        </li> 
                        <li>
                            <a href="https://www.tiktok.com/@yourbusinesspartnertn?is_from_webapp=1&sender_device=pc" target="_blank"><i class='bx bxl-tiktok'></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h3>{{ __("Useful Links", [], $l)}} </h3>
                    <ul class="footer-list">
                        <li>
                            <a href="#about">{{ __("About Us", [], $l)}} </a>
                        </li>
                        <li>
                            <a href="#services">{{ __("Services", [], $l)}} </a>
                        </li>
                        <li>
                            <a href="#team">{{ __("Team", [], $l)}} </a>
                        </li>
                        <li>
                            <a href="#testimonials">{{ __("Testimonials", [], $l)}} </a>
                        </li>
                        <li>
                            <a href="#contact">{{ __("Contact", [], $l)}} </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h3>{{ __("Contacts", [], $l)}}</h3>
                    <ul class="footer-list-two">
                        <li>
                            <i class='bx bx-time'></i>
                            {{ __("Sun - Fri: 8.00am - 6.00pm", [], $l)}}
                        </li>
                        <li>
                            <i class='bx bx-location-plus'></i>
                            {{ __("Rue de La Palestine, Tunis, 1002", [], $l)}}
                        </li>
                        <li>
                            <i class='bx bx-phone'></i>
                            <a href="tel:+216 24674032">+216 24674032</a>
                        </li>
                        <li>
                            <i class='bx bxs-envelope'></i>
                            <a href="mailto:ybp.businesstn@gmail.com"><span>ybp.businesstn@gmail.com</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copy-right-area">
    <div class="container">
        <div class="copy-right-text text-center">
            <p>
                {{ __("Copyright YBP. All Rights Reserved by ", [], $l)}}
                <a href="https://mbz-solutions.com" target="_blank">mbz-solutions</a> 
            </p>
        </div>
    </div>
</div>