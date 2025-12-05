<section id="contact">
    <div class="contact-section pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-md-4">
                    <div class="contact-card">
                        <i class='bx bxs-mobile'></i>
                        <div class="content">
                            <h3>{{ __("Contact Number", [], $l)}}</h3>
                            <p><a href="tel:+21624674032">+216 24 674 032</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-4">
                    <div class="contact-card">
                        <i class='bx bxs-mobile'></i>
                        <div class="content">
                            <h3>{{ __("Contact Number", [], $l)}}</h3>
                            <p><a href="tel:+21620674366">+216 20 674 366</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-4">
                    <div class="contact-card">
                        <i class='bx bxs-phone'></i>
                        <div class="content">
                            <h3>{{ __("Contact Number", [], $l)}}</h3>
                            <p><a href="tel:+21636643848">+216 36 643 848</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-4 offset-lg-0 offset-md-0 offset-sm-3">
                    <div class="contact-card">
                        <i class='bx bx-envelope'></i>
                        <div class="content">
                            <h3>{{ __("Email", [], $l)}}</h3>
                            <p><a href="mailto:ybp.businesstn@gmail.com"><span>ybp.businesstn@gmail.com</span></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6 col-md-4">
                    <div class="contact-card">
                        <i class='bx bx-map'></i>
                        <div class="content">
                            <h3>{{ __("Address", [], $l)}}</h3>
                            <p><a href="https://maps.app.goo.gl/anb7BHcUYdM8XTwz7"><span>{{ __("5 -ème étage bureau 2 , immeuble ALQUDS : 85-87 Rue de La Palestine, Tunis, Tunis, Tunisia, 1002", [], $l)}}</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="apply-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h2>{{ __("Contact us", [], $l)}}</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-12">
                    <div class="apply-form">
                        <div class="contact-form">
                            <form id="contactForm" method="POST" action="{{ route('welcome.contact')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name', [], $l)}} *">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('Phone', [], $l)}} *">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('Email Address', [], $l)}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="address" id="address" class="form-control" placeholder="{{ __('Address', [], $l)}}">
                                        </div>
                                    </div>
                                    @if(isset($service))
                                        <input type="hidden" name="service" value="{{$service['name']}}">
                                    @endif
                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <div class="form-group">
                                            <select id="service" class="form-control" placeholder="{{ __('Service', [], $l)}}"
                                                @if(isset($service)) disabled @else name="service" @endif>
                                                <option value=""> --- {{ __("Select Service")}} --- </option>
                                                @foreach ($services as $item)
                                                    <option value="{{$item['name']}}" @if( (isset($service) && ($service['name'] == $item['name'])) ) selected @endif>{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('Your Subject', [], $l)}} *">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="{{ __('Your Message', [], $l)}} *"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 text-center">
                                        <button type="submit" class="default-btn">
                                            {{ __('Submit', [], $l)}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map-area">
        <div class="container-fluid m-0 p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3194.05686327295!2d10.178627513710708!3d36.817157290274196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd35005b054d0b%3A0xb7acf9d60788d396!2sMa%C3%AEtre%20Lotfi%20Alimi%20JURIFISC!5e0!3m2!1sfr!2stn!4v1763385464537!5m2!1sfr!2stn"></iframe>
        </div>
    </div>
</section>
