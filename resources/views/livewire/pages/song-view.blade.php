<div class="container">
    @section('title',$song->title)
    <div class="d-flex flex-column align-content-between">
        @livewire('pages.components.navbar')
        @livewire('pages.components.song.view-song', ['song' => $song])
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
<title>{{ $song->title }} - {{ $song->artists->first()->name }} - {{ config('app.name', 'Laravel') }}</title>
<meta name="title" content="{{ $song->title }} - {{ $song->artists->first()->name }} - {{ config('app.name', 'Laravel') }}">
<meta name="description" content="{{ $song->description }}">
<meta name="keywords" content="Strings N' Beats,StringsNBeats,stringsnbeats,stringsnbeats.net,stringsnbeats.com,stringsnbeatsnepal,music,Nepal,Nepali,Nepalese Music,Lyrics,Cover">
{{-- <meta property='article:published_time' content='{{ Carbon\Carbon::create('2021', '6', '6') }}' />
<meta property='article:section' content='website' /> --}}

<meta property="og:type" content="music.song">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $song->title }} - {{ $song->artists->first()->name }}">
<meta property="og:description" content="{{ $song->description }}">
<meta property="og:image" content="{{ $song->image->getUrl() }}">
<meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">
<meta property="music:duration" content="{{ $duration }}">

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $song->title }} - {{ $song->artists->first()->name }} - {{ config('app.name', 'Laravel') }}">
<meta name="twitter:description" content="{{ $song->description }}">
<meta name="twitter:image" content="{{ $song->image->getUrl() }}">
<meta name="twitter:site" content="@strings_beats">
{!! $schemaScripts !!}
@endpush