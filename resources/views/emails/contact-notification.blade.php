@component('mail::message')

## Informations du contact

**Nom :**  {{ $contactData['name'] }} <br>

@if(!empty($contactData['service']))
    **Service :**  {{ $contactData['service'] }} <br>
@endif

@if(!empty($contactData['email']))
    **Email :**  {{ $contactData['email'] }} <br>
@endif

**Téléphone :**  {{ $contactData['phone'] }} <br>

@if(!empty($contactData['address']))
**Adresse :**  {{ $contactData['address'] }} <br>
@endif

**Sujet :**  {{ $contactData['subject'] }} <br>


## Message:  <br>
{{ $contactData['message'] }} <br>

@component('mail::subcopy')
**Equipe {{ config('app.name') }}**  
@endcomponent
@endcomponent
