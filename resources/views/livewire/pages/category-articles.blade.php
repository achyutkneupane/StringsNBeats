<div class='fullPage container'>
    @section('title',$title)
    <div class="row">
        @livewire('pages.components.navbar')
        @livewire('pages.components.category.article-list', ['category' => $category])
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
<meta name="title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta name="description" content="Strings N’ Beats is the primary destination for Nepali Music related matter and stories surrounding it all. Check this page to get informations about the {{ $slug != 'all' ? $category->title : 'updates' }} in Nepali Music.">
<meta name="keywords" content="Strings N' Beats,StringsNBeats,stringsnbeats,stringsnbeats.net,stringsnbeats.com,stringsnbeatsnepal,music,Nepal,Nepali,Nepalese Music,Lyrics,Cover">
<meta property='article:published_time' content='{{ Carbon\Carbon::create('2021', '6', '6') }}' />
<meta property='article:section' content='website' />
<meta property="fb:app_id" content="931301841077172">
<meta property="fb:pages" content="108590381445890">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta property="og:description" content="Strings N’ Beats is the primary destination for Nepali Music related matter and stories surrounding it all. Check this page to get informations about the {{ $slug != 'all' ? $category->title : 'updates' }} in Nepali Music.">
<meta property="og:image" content="{{ asset('statics/ogimage.jpg') }}">
<meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta name="twitter:description" content="Strings N’ Beats is the primary destination for Nepali Music related matter and stories surrounding it all. Check this page to get informations about the {{ $slug != 'all' ? $category->title : 'updates' }} in Nepali Music.">
<meta name="twitter:image" content="{{ asset('statics/ogimage.jpg') }}">
<meta name="twitter:site" content="@strings_beats">
@endpush