<div class="services-details pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="services-details-content">
                    <img src="{{ asset('welcome/assets/img/services/services-details.jpg') }}" alt="Images">
                    <div class="row border-bottom">
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Tax Compliance Requirements", [], $l) }}</h3>
                                <p>
                                    {{ __("Ensure full compliance with Tunisian tax regulations and reporting obligations. We help businesses meet all statutory requirements including VAT declarations, corporate tax filings, and social security contributions.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Tax Optimization Strategies", [], $l) }}</h3>
                                <p>
                                    {{ __("Develop customized tax optimization plans to minimize your tax burden while remaining fully compliant. We identify legitimate tax savings opportunities and incentives available under Tunisian law.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("Tax Audit Support", [], $l) }}</h3>
                                <p>
                                    {{ __("Comprehensive assistance during tax audits and inspections. Our experts provide representation, documentation preparation, and strategic guidance to ensure favorable outcomes.", [], $l) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __("International Taxation", [], $l) }}</h3>
                                <p>
                                    {{ __("Expert guidance on cross-border tax matters, double taxation treaties, and international tax planning for businesses operating across multiple jurisdictions from Tunisia.", [], $l) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="services-item-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                    <h3>{{ __("Corporate Tax Planning", [], $l) }}</h3>
                                    <p>{{ __("Strategic corporate tax planning to optimize your company's tax position and maximize profitability while ensuring full compliance.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-chart-line"></i>
                                    <h3>{{ __("VAT Consulting", [], $l) }}</h3>
                                    <p>{{ __("Comprehensive VAT advisory services including registration, compliance, recovery optimization, and handling complex VAT transactions.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-balance-scale"></i>
                                    <h3>{{ __("Tax Dispute Resolution", [], $l) }}</h3>
                                    <p>{{ __("Expert representation in tax disputes, appeals, and litigation proceedings with tax authorities to protect your business interests.", [], $l) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="fas fa-handshake"></i>
                                    <h3>{{ __("M&A Tax Advisory", [], $l) }}</h3>
                                    <p>{{ __("Tax due diligence and structuring advice for mergers, acquisitions, and corporate reorganizations to optimize tax outcomes.", [], $l) }}</p>
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
                                        {{ __("Our corporate tax advisory service combines deep local expertise with international best practices. We provide proactive tax planning that aligns with your business objectives while ensuring full compliance with Tunisian tax legislation.", [], $l) }}
                                    </p>
                                    <ul>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Expert Knowledge of Tunisian Tax Law", [], $l) }}
                                        </li>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Proactive Tax Risk Management", [], $l) }}
                                        </li>
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __("Customized Tax Optimization Strategies", [], $l) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="service-content">
                                    <h3>{{ __("Have You Any Tax Questions?", [], $l) }}</h3>
                                    <h2>{{ __("Get Expert Consultation", [], $l) }}</h2>
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
                                    <a href="#">{{ __("Corporate Taxation", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-receipt"></i>
                                    <a href="#">{{ __("VAT Consulting", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-globe"></i>
                                    <a href="#">{{ __("International Tax", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-gavel"></i>
                                    <a href="#">{{ __("Tax Compliance", [], $l) }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-chart-bar"></i>
                                    <a href="#">{{ __("Tax Planning", [], $l) }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="services-bar-widget">
                        <h3 class="title">{{ __("Tags", [], $l) }}</h3>
                        <ul class="services-bar-widget-tag">
                            <li><a href="#">{{ __("Corporate Tax", [], $l) }}</a></li>
                            <li><a href="#">{{ __("VAT", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Tax Optimization", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Compliance", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Tax Audit", [], $l) }}</a></li>
                            <li><a href="#">{{ __("Business Advisory", [], $l) }}</a></li>
                        </ul>
                    </div>
                    <div class="services-bar-widget">
                        <div class="services-bar-contact">
                            <i class='bx bx-phone-call'></i>
                            <h3>{{ __("Expert Tax Consultation Available", [], $l) }}</h3>
                            <span><a href="tel:+216 24674032">+216 24674032</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>