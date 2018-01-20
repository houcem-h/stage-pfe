

@component('mail::message')


{!! $text !!}



Merci et à bientôt,<br>
L'équipe {{ config('app.name') }}
@endcomponent
