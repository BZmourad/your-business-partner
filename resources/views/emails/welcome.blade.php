@component('mail::message')
# Bienvenue, {{ $user->name }} ! 🎉

Merci d’avoir confirmé votre adresse e-mail.  
Nous sommes ravis de vous compter parmi nous !

@component('mail::button', ['url' => URL::to('/home')])
Consulter votre espace
@endcomponent

@endcomponent
