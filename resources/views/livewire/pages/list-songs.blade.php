<div class='fullPage container'>
    @section('title',$title)
    <div class="row">
        @livewire('pages.components.navbar')
        @livewire('pages.components.song.songs-list', ['all' => $all])
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
<meta name="title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta name="description" content="Strings N’ Beats is the primary destination for Nepali Music related matter and stories surrounding it all. Click here to see{{ $all ? ' all' : '' }} the songs listed in Strings N' Beats.">
<meta name="keywords" content="Strings N' Beats,StringsNBeats,stringsnbeats,stringsnbeats.net,stringsnbeats.com,stringsnbeatsnepal,music,Nepal,Nepali,Nepalese Music,Lyrics,Cover">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta property="og:description" content="Strings N’ Beats is the primary destination for Nepali Music related matter and stories surrounding it all. Click here to see{{ $all ? ' all' : '' }} the songs listed in Strings N' Beats.">
<meta property="og:image" content="{{ asset('statics/ogimage.jpg') }}">
<meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta name="twitter:description" content="Strings N’ Beats is the primary destination for Nepali Music related matter and stories surrounding it all. Click here to see{{ $all ? ' all' : '' }} the songs listed in Strings N' Beats.">
<meta name="twitter:image" content="{{ asset('statics/ogimage.jpg') }}">
<meta name="twitter:site" content="@strings_beats">
@endpush