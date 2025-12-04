<div class="client-area-two ptb-100" id="testimonials">
    <div class="container">
        <div class="section-title text-center">
            <span>{{ __("Clients Review", [], $l)}}</span>
            <h2>{{ __("What Our Business Partners Say About YBP", [], $l)}}</h2>
            <p>
                {{ __("Our clients across various industries trust YBP for comprehensive business solutions. From startups to established enterprises, their feedback reflects our commitment to excellence, reliability, and personalized service in the Tunisian market.", [], $l)}}
            </p>
        </div>
        <div class="client-slider owl-carousel owl-theme pt-45">
            @foreach ($testimonials as $testimonial)
                <div class="client-card">
                    <h3>{{ __($testimonial['name'], [], $l)}}</h3>
                    <span>{{ __($testimonial['position'], [], $l)}}</span>
                    <ul>
                        <li>
                            @for ($i = 0; $i < $testimonial['rating']; $i++)
                                <i class='bx bxs-star'></i>
                            @endfor
                        </li>
                    </ul>
                    <p>
                        {{ __($testimonial['comment'], [], $l)}}
                    </p>
                    <i class="flaticon-quote client-card-quote"></i>
                    <div class="client-card-img">
                        <img src="{{ asset($testimonial['image']) }}" alt="{{ $testimonial['name'] }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>