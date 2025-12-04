<div class="services-area pt-100 pb-70" id="customers">
    <div class="container">
        <div class="service-widget-title">
            <div class="section-title text-center">
                <h2>{{ __("Our Customers", [], $l)}}</h2>
            </div>
        </div>
    </div>
</div>
<section id="customers" class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Conteneur marquee -->
                <div class="marquee-container position-relative">
                    <!-- Première piste de défilement -->
                    <div class="marquee-track d-inline-flex align-items-center">
                        <!-- Logos originaux -->
                        @for($i = 1; $i <= 13; $i++)
                        <div class="marquee-image mx-4">
                            <img 
                                src="{{ asset('img/clients/' . $i . '.jpeg') }}" 
                                alt="Client {{ $i }}"
                                class="img-fluid customer-img"
                                loading="lazy"
                            >
                        </div>
                        @endfor
                        
                        <!-- Duplication pour l'effet continu -->
                        @for($i = 1; $i <= 13; $i++)
                        <div class="marquee-image mx-4">
                            <img 
                                src="{{ asset('img/clients/' . $i . '.jpeg') }}" 
                                alt="Client {{ $i }}"
                                class="img-fluid customer-img"
                                loading="lazy"
                            >
                        </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Deuxième piste (optionnelle) pour direction opposée -->
                <div class="marquee-container position-relative mt-4">
                    <div class="marquee-track d-inline-flex align-items-center marquee-reverse">
                        <!-- Logos originaux -->
                        @for($i = 13; $i >= 1; $i--)
                        <div class="marquee-image mx-4">
                            <img 
                                src="{{ asset('img/clients/' . $i . '.jpeg') }}" 
                                alt="Client {{ $i }}"
                                class="img-fluid customer-img"
                                loading="lazy"
                            >
                        </div>
                        @endfor
                        
                        <!-- Duplication pour l'effet continu -->
                        @for($i = 13; $i >= 1; $i--)
                        <div class="marquee-image mx-4">
                            <img 
                                src="{{ asset('img/clients/' . $i . '.jpeg') }}" 
                                alt="Client {{ $i }}"
                                class="img-fluid customer-img"
                                loading="lazy"
                            >
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

