<div class="container">
    <div class="row">
        @livewire('pages.components.navbar')
        @livewire('pages.components.home-top')
        @livewire('pages.components.home-body')
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
<title>{{ config('app.name', 'Laravel') }} || Primary Destination for Nepali Music Related Matters</title>
<meta name="title" content="{{ config('app.name', 'Laravel') }}">
<meta name="description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
<meta name="keywords" content="Strings N' Beats,StringsNBeats,stringsnbeats,stringsnbeats.net,stringsnbeats.com,stringsnbeatsnepal,music,Nepal,Nepali,Nepalese Music,Lyrics,Cover">
<meta property='article:published_time' content='{{ Carbon\Carbon::create('2021', '6', '6') }}' />
<meta property='article:section' content='website' />

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ config('app.name', 'Laravel') }}">
<meta property="og:description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
<meta property="og:image" content="{{ asset('statics/ogimage.jpg') }}">
<meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
<meta name="twitter:description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
<meta name="twitter:image" content="{{ asset('statics/ogimage.jpg') }}">
<meta name="twitter:site" content="@strings_beats">
@endpush