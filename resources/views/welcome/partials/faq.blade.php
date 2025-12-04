<div class="faq-area pt-100 pb-70" id="faq">
    <div class="container">
        <div class="section-title text-center">
            <span>{{ __("FAQ", [], $l)}}</span>
            <h2>{{ __("Frequently Asked Questions About YBP Services", [], $l)}}</h2> 
        </div>
        <div class="row align-items-center pt-45">
            <div class="col-lg-6">
                <div class="faq-accordion">
                    <ul class="accordion">
                        @foreach(array_slice($faqs, 0, ceil(count($faqs)/2)) as $index => $faq)
                            <li class="accordion-item {{ $faq['active'] ? 'active' : '' }}">
                                <a class="accordion-title" href="javascript:void(0)">
                                    <i class='bx bx-chevron-down'></i>
                                    {{ __($faq['question'], [], $l)}}
                                </a>
                                <div class="accordion-content {{ $faq['active'] ? 'show' : '' }}">
                                    <p> 
                                        {{ __($faq['answer'], [], $l)}}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-accordion">
                    <ul class="accordion">
                        @foreach(array_slice($faqs, ceil(count($faqs)/2)) as $index => $faq)
                            <li class="accordion-item {{ $faq['active'] ? 'active' : '' }}">
                                <a class="accordion-title" href="javascript:void(0)">
                                    <i class='bx bx-chevron-down'></i>
                                    {{ __($faq['question'], [], $l)}}
                                </a>
                                <div class="accordion-content {{ $faq['active'] ? 'show' : '' }}">
                                    <p> 
                                        {{ __($faq['answer'], [], $l)}}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>   
            </div>
        </div>
    </div>
</div>