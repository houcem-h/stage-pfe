@component('mail::message')
# Bienvenue à l'application **{{$user->firstname}} {{$user->lastname}}**

Votre compte vient d'être créé avec les paramètres d'accès suivant:
- LOGIN : **{{$user->email}}**
- MOT DE PASSE : **{{$user->cin}}**

@component('mail::button', ['url' => 'http://devserver:8880/laravel/stage-pfe/public/connect'])
Démarer une visite
@endcomponent

Merci et à bientôt,<br>
L'équipe {{ config('app.name') }}
@endcomponent
