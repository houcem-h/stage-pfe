@component('mail::message')
# Félicitation {{$student->firstname}}

vous êtes acceptés par Mr/Mme {{$user->firstname}}
pour être votre encadrée durant votre stage PFE :
Vous pouvez connecte votre endreur   par mail : {{$user->email}}


**votre stage commance le {{$int->start_date}} et se termine le {{$int->end_date}}**

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
