@component('mail::message')

{{ __('Hello')}} {{ $user->name }},<br>

{{ __('Above the access parameters for')}} <strong>{{ config('app.name') }}</strong>   <br>

&nbsp;&nbsp;&nbsp; {{ __('email')}} : {{ $user->email}}  <br>
&nbsp;&nbsp;&nbsp; {{ __('Password')}} : {{$plainPassword}}   <br>

@component('mail::button', ['url' => URL::to('/login')])
{{ __('Login')}}
@endcomponent

@endcomponent