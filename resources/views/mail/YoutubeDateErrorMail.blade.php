@component('mail::message')
# Telegram Error

<a href="{{ 'https://youtu.be/'.$videoId }}">{{ $videoTitle }}</a> was released on this day {{ $diff }} years ago.

@component('mail::button', ['url' => 'https://youtu.be/'.$videoId])
Watch Video
@endcomponent

@endcomponent
