<div class="services-details pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="services-details-content">
                    <img src="{{ asset('welcome/assets/img/services/services-details.jpg') }}" alt="Images">
                    <div class="row border-bottom">
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Legal Structure Selection", [], $l) }}</h3>
                                <p>
                                    {{ __("Expert guidance in choosing the optimal legal structure for your business in Tunisia (SARL, SA, SUARL, etc.). We analyze your needs to recommend the most tax-efficient and suitable company form.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Registration Process Management", [], $l) }}</h3>
                                <p>
                                    {{ __("Complete handling of all registration formalities with Tunisian authorities including the Trade Register, Tax Administration, and Social Security. We ensure smooth and efficient company setup.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Tax Registration & Compliance", [], $l) }}</h3>
                                <p>
                                    {{ __("Comprehensive tax registration services including VAT number acquisition, corporate tax identification, and initial tax compliance setup to ensure your business starts on solid legal footing.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Post-Incorporation Services", [], $l) }}</h3>
                                <p>
                                    {{ __("Ongoing support after company creation including statutory book setup, initial accounting organization, and first tax declaration guidance to ensure continuous compliance from day one.", [], $l) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="services-item-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-building"></i>
                                    <h3>{{ __("Company Formation", [], $l) }}</h3>
                                    <p>{{ __("Complete incorporation services for all types of Tunisian business entities with optimized legal and tax structures.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-file-signature"></i>
                                    <h3>{{ __("Legal Documentation", [], $l) }}</h3>
                                    <p>{{ __("Preparation of all required legal documents including statutes, shareholder agreements, and registration forms.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-passport"></i>
                                    <h3>{{ __("Foreign Investment", [], $l) }}</h3>
                                    <p>{{ __("Specialized support for foreign investors including approval processes and compliance with Tunisian investment laws.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <h3>{{ __("Tax Incentives", [], $l) }}</h3>
                                    <p>{{ __("Guidance on available tax benefits and incentives for new businesses in Tunisia to optimize your fiscal position.", [], $l) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-advantage">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="advantage-item">
                                    <h3>{{ __("Service Advantage", [], $l) }}</h3>
                                    <p> 
                                        {{ __("Our company creation service provides a comprehensive solution that combines legal expertise with strategic tax planning. We ensure your business is established with the optimal structure for growth and compliance in the Tunisian market.", [], $l) }}
                                    </p>
                                    <ul>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Fast and Efficient Registration Process", [], $l) }}
                                        </li>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Tax-Optimized Business Structure", [], $l) }}
                                        </li>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Complete Compliance from Day One", [], $l) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="service-content">
                                    <h3>{{ __("Ready to Start Your Business?", [], $l) }}</h3>
                                    <h2>{{ __("Get Professional Setup", [], $l) }}</h2>
                                    <a href="{{route($l.'.welcome')}}#services" class="default-btn">{{ __("More Services", [], $l) }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="services-side-bar">
                    <div class="services-bar-widget">
                        <h3 class="title">{{ __("Categories", [], $l) }}</h3>
                        <div class="services-bar-categories">
                            <ul>
                                <li>
                                    <i class="fas fa-building"></i>
                                    <a href="#">{{ __("SARL Formation", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-chess-queen"></i>
                                    <a href="#">{{ __("SA Creation", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-globe"></i>
                                    <a href="#">{{ __("Foreign Investment", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-contract"></i>
                                    <a href="#">{{ __("Legal Documentation", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <a href="#">{{ __("Tax Registration", [], $l) }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="services-bar-widget">
                        <h3 class="title">{{ __("Tags", [], $l) }}</h3>
                        <ul class="services-bar-widget-tag">
                            <li><a href="#">{{ __("Company Formation", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Business Setup", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Legal Structure", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Registration", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Tax Optimization", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Compliance", [], $l) }}</a></li>
                        </ul>
                    </div>
                    <div class="services-bar-widget">
                        <div class="services-bar-contact">
                            <i class='bx bx-phone-call'></i>
                            <h3>{{ __("Start Your Business Journey Today", [], $l) }}</h3>
                            <span><a href="tel:+216 24674032">+216 24674032</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>