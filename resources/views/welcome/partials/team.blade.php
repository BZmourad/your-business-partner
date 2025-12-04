<div class="team-area pt-100 pb-70" id="team">
    <div class="container">
        <div class="section-title text-center">
            <span>{{ __("Our Team", [], $l)}}</span>
            <h2>{{ __("Our Best Expert Team Make You To Reach Your Goal", [], $l)}}</h2>
            <p>
                {{ __("Our team is composed of experienced tax consultants dedicated to providing accurate, strategic, and client-focused guidance. We combine technical expertise with a deep understanding of Tunisian and international tax regulations to help businesses achieve long-term financial stability.", [], $l)}}
            </p>
        </div>
        <div class="row border-bottom pt-45 pb-20 justify-content-center align-items-center">
            @foreach ($teams as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="team-card">
                        <div class="team-img">
                            <img src="{{ asset($item['image']) }}" alt="Images">
                            <div class="social-icon">
                                <ul class="social-link">
                                    @if($item['facebook'])<li><a href="{{$item['facebook']}}" target="_blank"><i class='bx bxl-facebook'></i></a></li> @endif
                                    @if($item['twitter'])<li><a href="{{$item['twitter']}}" target="_blank"><i class='bx bxl-twitter'></i></a></li>  @endif
                                    @if($item['linkedin'])<li><a href="{{$item['linkedin']}}" target="_blank"><i class='bx bxl-linkedin'></i></a></li>  @endif
                                    @if($item['instagram'])<li><a href="{{$item['instagram']}}" target="_blank"><i class='bx bxl-instagram'></i></a></li>  @endif
                                </ul>
                            </div>
                        </div>
                        <div class="content">
                            <h3>{{ __($item['name'], [], $l)}}</h3>
                            <span>{{ __($item['titre'], [], $l)}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
