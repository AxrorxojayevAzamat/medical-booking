@component('mail::message')
# {{trans('auth.confirm_email_title') }}

{{trans('auth.confirm_email_nav') }}

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
{{trans('auth.confirm_email_button') }}
@endcomponent

{{ trans ('auth.confirm_email_salulation_line') }}<br>
Medical Booking
@endcomponent
