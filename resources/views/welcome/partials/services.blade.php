<div class="services-area pt-100 pb-70" id="services">
    <div class="container">
        <div class="service-widget-title">
            <div class="section-title text-center">
                <span>{{ __("Our Services", [], $l)}}</span>
                <h2>{{ __("Our Best Services Make You To Reach Your Goal", [], $l)}}</h2>
                <p>
                    {{ __("We provide a full range of tax consulting services designed to help businesses stay compliant, reduce financial risks, and improve long-term performance. Our team offers strategic guidance tailored to your industry, operations, and regulatory requirements in Tunisia.", [], $l)}}
                </p>
            </div>
        </div>
        <div class="row pt-45 pb-20 match-height">
            @foreach ($services as $service)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="services-card h-100">
                        <div class="services-icon">
                            <i class="{{ $service['icon']}}"></i>
                        </div>
                        <h3><a href="">{{ __($service['name'], [], $l)}}</a></h3>
                        <p>{{ __($service['description'], [], $l)}}</p>
                        <a href="{{route($l.'.welcome.service', $service['slug'])}}" class="services-more">
                            <i class='flaticon-double-right-arrows-angles'></i>
                        </a>
                        <div class="services-card-bottom"></div>
                    </div>
                </div> 
            @endforeach
        </div>
    </div>
</div>
