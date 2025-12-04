@component('mail::message')

{!! $content !!}

@component('mail::subcopy')

**Equipe {{ config('app.name') }}**  
@endcomponent

@endcomponent