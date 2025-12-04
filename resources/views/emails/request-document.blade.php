@component('mail::message')

{!! $content !!}

@component('mail::subcopy')
Pour toute question concernant ce document, vous pouvez répondre directement à cet email. <br> <br>

**Equipe {{ config('app.name') }}**  
@endcomponent

@endcomponent