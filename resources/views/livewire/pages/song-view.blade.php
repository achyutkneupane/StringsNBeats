<div class='fullPage container'>
    @section('title',$song->title)
    <div class="d-flex flex-column align-content-between">
        @livewire('pages.components.navbar')
        @livewire('pages.components.song.view-song', ['song' => $song])
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
<title>{{ $song->title }} - {{ ucwords($song->artists->first()->name) }} - {{ config('app.name', 'Laravel') }}</title>
<meta name="title" content="{{ $song->title }} - {{ ucwords($song->artists->first()->name) }} - {{ config('app.name', 'Laravel') }}">
<meta name="description" content="{{ $song->description }}">
<meta name="keywords" content="Strings N' Beats,StringsNBeats,stringsnbeats,stringsnbeats.net,stringsnbeats.com,stringsnbeatsnepal,music,Nepal,Nepali,Nepalese Music,Lyrics,Cover">
<meta property='article:published_time' content='{{ $song->published_at }}' />
<meta property='article:modified_time' content='{{ $song->updated_at }}' />
<meta property='article:author' content="Strings N' Beats" />
<meta property="fb:app_id" content="931301841077172">
<meta property="fb:pages" content="108590381445890">

<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $song->title }} - {{ ucwords($song->artists->first()->name) }}">
<meta property="og:description" content="{{ $song->description }}">
<meta property="og:image" content="{{ $song->image->getUrl() }}">
<meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">
<meta property="music:duration" content="{{ $duration }}">

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $song->title }} - {{ ucwords($song->artists->first()->name) }} - {{ config('app.name', 'Laravel') }}">
<meta name="twitter:description" content="{{ $song->description }}">
<meta name="twitter:image" content="{{ $song->image->getUrl() }}">
<meta name="twitter:site" content="@strings_beats">
{!! $schemaScripts !!}
@endpush