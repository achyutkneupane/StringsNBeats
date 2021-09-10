<div>
    <title>{{ ucwords($this->long->description) }} - {{ config('app.name', 'Laravel') }}</title>
    <meta name="title" content="{{ ucwords($this->long->description) }} - {{ config('app.name', 'Laravel') }}">
    <meta name="description" content="Strings N’ Beats is the primary destination for Nepali music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
    <meta name="keywords" content="Strings N' Beats,StringsNBeats,stringsnbeats,stringsnbeats.net,stringsnbeats.com,stringsnbeatsnepal,music,Nepal,Nepali,Nepalese Music,Lyrics,Cover">
    <meta property='article:published_time' content='{{ Carbon\Carbon::create('2021', '6', '6') }}' />
    <meta property='article:section' content='website' />

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ ucwords($this->long->description) }} - {{ config('app.name', 'Laravel') }}">
    <meta property="og:description" content="Strings N’ Beats is the primary destination for Nepali music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
    <meta property="og:image" content="{{ asset('statics/ogimage.jpg') }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ ucwords($this->long->description) }} - {{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="Strings N’ Beats is the primary destination for Nepali music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
    <meta name="twitter:image" content="{{ asset('statics/ogimage.jpg') }}">
    <meta name="twitter:site" content="@strings_beats">
    <meta http-equiv="refresh" content="0; url={{ $this->long->long }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176442345-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-176442345-2');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HS0XEPQE5K"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-HS0XEPQE5K');
    </script>
</div>
