@component('mail::message')
# Telegram Error

<a href="{{ 'https://youtube.com/channel/'.$channelId }}">{{ $channelTitle }}</a> has crossed {{ $point }} subscribers.

@component('mail::button', ['url' => 'https://youtube.com/channel/'.$channelId])
Visit Channel
@endcomponent

@endcomponent
