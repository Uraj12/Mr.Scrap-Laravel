@component('mail::message')
# Login Notification

Hello **{{ $user->name }}**,

You have successfully logged in to your Mr. Scrap account.

**Login Details:**
- **Email:** {{ $user->email }}
- **IP Address:** {{ $ip }}
- **Login Time:** {{ $time }}

If this was not you, please reset your password immediately.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
