<div class="services-details pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="services-details-content">
                    <img src="{{ asset($service['image']) }}" alt="{{ $service['name'] }}">
                    <div class="row border-bottom">
                        @foreach($service['cards'] as $card)
                        <div class="col-lg-6">
                            <div class="services-details-card">
                                <h3>{{ __($card['title'], [], $l) }}</h3>
                                <p>
                                    {{ __($card['description'], [], $l) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="services-item-area">
                        <div class="row">
                            @foreach($service['items'] as $item)
                            <div class="col-lg-6 col-md-6">
                                <div class="services-details-item">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <h3>{{ __($item['title'], [], $l) }}</h3>
                                    <p>{{ __($item['description'], [], $l) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="service-advantage">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="advantage-item">
                                    <h3>{{ __("Service Advantage", [], $l) }}</h3>
                                    <p> 
                                        {{ __($service['advantage_description'], [], $l) }}
                                    </p>
                                    <ul>
                                        @foreach($service['advantages'] as $advantage)
                                        <li>
                                            <i class='bx bx-check'></i>
                                            {{ __($advantage, [], $l) }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="service-content">
                                    <h3>{{ __("Ready to Get Started?", [], $l) }}</h3>
                                    <h2>{{ __("Contact Us Today", [], $l) }}</h2>
                                    <a href="{{route($l.'.welcome')}}#contact" class="default-btn">{{ __("Contact Us", [], $l) }}</a>
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
                                @foreach($service['categories'] as $category)
                                <li>
                                    <i class="{{ $category['icon'] }}"></i>
                                    <a href="#">{{ __($category['name'], [], $l) }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="services-bar-widget">
                        <h3 class="title">{{ __("Tags", [], $l) }}</h3>
                        <ul class="services-bar-widget-tag">
                            @foreach($service['tags'] as $tag)
                            <li><a href="#">{{ __($tag, [], $l) }}</a></li>
                            @endforeach
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