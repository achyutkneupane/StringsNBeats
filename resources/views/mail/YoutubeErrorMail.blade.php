@component('mail::message')
# Telegram Error

<a href="{{ 'https://youtu.be/'.$videoId }}">{{ $videoTitle }}</a> has crossed {{ $point }} views.

@component('mail::button', ['url' => 'https://youtu.be/'.$videoId])
Watch Video
@endcomponent

@endcomponent
