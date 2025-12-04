<div class="services-details pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="services-details-content">
                    <img src="{{ asset('welcome/assets/img/services/services-details.jpg') }}" alt="Images">
                    <div class="row border-bottom">
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Tax Declaration Requirements", [], $l) }}</h3>
                                <p>
                                    {{ __("Comprehensive management of all mandatory tax declarations in Tunisia including corporate income tax, VAT, and social security contributions. We ensure timely and accurate submissions to avoid penalties.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Monthly VAT Declarations", [], $l) }}</h3>
                                <p>
                                    {{ __("Professional preparation and submission of monthly VAT declarations. We handle input VAT recovery, output VAT calculations, and ensure compliance with Tunisian VAT regulations.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Annual Tax Returns", [], $l) }}</h3>
                                <p>
                                    {{ __("Complete preparation and filing of annual corporate tax returns. Our experts optimize your tax position while maintaining full compliance with Tunisian tax legislation.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Electronic Filing System", [], $l) }}</h3>
                                <p>
                                    {{ __("Seamless electronic submission of all tax declarations through official Tunisian platforms. We manage the entire digital filing process efficiently and securely.", [], $l) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="services-item-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-file-contract"></i>
                                    <h3>{{ __("Corporate Tax Returns", [], $l) }}</h3>
                                    <p>{{ __("Accurate preparation and timely submission of corporate income tax declarations with optimized tax calculations.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-receipt"></i>
                                    <h3>{{ __("VAT Declarations", [], $l) }}</h3>
                                    <p>{{ __("Monthly and quarterly VAT compliance services including declaration preparation and electronic submission.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-user-tie"></i>
                                    <h3>{{ __("Salary Tax Reporting", [], $l) }}</h3>
                                    <p>{{ __("Comprehensive payroll tax declarations and employee income tax reporting in compliance with Tunisian regulations.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-shield-alt"></i>
                                    <h3>{{ __("Social Security Declarations", [], $l) }}</h3>
                                    <p>{{ __("Monthly social security contributions declaration and compliance services for your workforce.", [], $l) }}</p>
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
                                        {{ __("Our tax declaration service provides complete peace of mind by ensuring all your tax obligations are met accurately and on time. We leverage deep knowledge of Tunisian tax laws to optimize your declarations while maintaining full compliance.", [], $l) }}
                                    </p>
                                    <ul>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Zero Penalty Guarantee", [], $l) }}
                                        </li>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Timely Submission Always", [], $l) }}
                                        </li>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Expert Accuracy & Compliance", [], $l) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="service-content">
                                    <h3>{{ __("Need Help With Tax Declarations?", [], $l) }}</h3>
                                    <h2>{{ __("Get Professional Support", [], $l) }}</h2>
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
                                    <i class="fas fa-file-invoice-dollar"></i>
                                    <a href="#">{{ __("Corporate Tax Returns", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-receipt"></i>
                                    <a href="#">{{ __("VAT Declarations", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-user-tie"></i>
                                    <a href="#">{{ __("Salary Tax Reporting", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-shield-alt"></i>
                                    <a href="#">{{ __("Social Security", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-clipboard-check"></i>
                                    <a href="#">{{ __("Compliance Review", [], $l) }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="services-bar-widget">
                        <h3 class="title">{{ __("Tags", [], $l) }}</h3>
                        <ul class="services-bar-widget-tag">
                            <li><a href="#">{{ __("Tax Returns", [], $l) }}</a></li>
                            <li><a href="#">{{ __("VAT Filing", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Compliance", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Deadlines", [], $l) }}</a></li>
                            <li><a href="#">{{ __("E-filing", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Reporting", [], $l) }}</a></li>
                        </ul>
                    </div>
                    <div class="services-bar-widget">
                        <div class="services-bar-contact">
                            <i class='bx bx-phone-call'></i>
                            <h3>{{ __("Expert Tax Declaration Support", [], $l) }}</h3>
                            <span><a href="tel:+216 24674032">+216 24674032</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>