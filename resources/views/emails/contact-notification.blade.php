@component('mail::message')

## Informations du contact

<em>**Nom :**</em>  {{ $contactData['name'] }} <br>

@if(!empty($contactData['service']))
    <em>**Service :**</em>  {{ $contactData['service'] }} <br>
@endif

@if(!empty($contactData['email']))
    <em>**Email :**</em>  {{ $contactData['email'] }} <br>
@endif

<em>**Téléphone :**</em>  {{ $contactData['phone'] }} <br>

@if(!empty($contactData['address']))
<em>**Adresse :**</em>  {{ $contactData['address'] }} <br>
@endif

<em>**Sujet :**</em>  {{ $contactData['subject'] }} <br>


<em>## Message:</em>  <br>
{{ $contactData['message'] }} <br>

@component('mail::subcopy')
**Equipe {{ config('app.name') }}**  
@endcomponent
@endcomponent
