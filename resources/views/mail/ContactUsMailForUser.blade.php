@component('mail::message')
# Contact Us Message

Hello <b>{{ $info['name'] }}</b>,

We have received this message from you:<br>
<b>Name</b>: {{ $info['name'] }}<br>
<b>Email</b>: {{ $info['email'] }}<br>
<b>Message</b>: {{ $info['message'] }}<br>

We will contact you soon.
Keep in touch.

Thanks,<br>
{{ config('app.name') }}
@endcomponent