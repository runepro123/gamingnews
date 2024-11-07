@component('mail::message')
Hi {{ $data['user']->name ?? '' }},

We've received a request to reset your password.

If this wasn't you, no worries. Your account security is our priority, so simply disregard this email.

Your One-Time Password (OTP) for password reset: <strong>{{ $data['otp'] }}</strong>

Should you encounter any difficulties or require additional assistance with resetting your password, our support team is here to help.

Contact Support: {{ $mailConfiguration->support_email }}

Thanks for choosing {{ config('app.name') }}.

Best regards,

{{ config('app.name') }}
@endcomponent