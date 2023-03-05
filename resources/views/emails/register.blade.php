@component('mail::message')
# Hi {{ $fullname }},
Thank you for signing up. To activate your account, please click below.

@component('mail::button', ['color' => 'green' ,'url' => config('app.url') . "/verify/$validation_code"])
ACTIVATE MY ACCOUNT
@endcomponent

@endcomponent