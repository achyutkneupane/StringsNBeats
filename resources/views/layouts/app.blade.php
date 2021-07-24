<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="g8kQzHJudE0myLYnBHSKkZbNQzmQrGtndQGZ6GkLZDI" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('statics/snb-favicon.png') }}"/>
	
@stack('meta_tags')
@if(!request()->routeIs('viewArticle') && request()->route()->getPrefix() != '/panel')
{!! Spatie\SchemaOrg\Schema::webSite()->url(route('homepage'))->name('Strings N\' Beats')->image(asset('statics/ogimage.jpg'))
                            ->publisher(Spatie\SchemaOrg\Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Spatie\SchemaOrg\Schema::imageObject()->url(asset('statics/logo-small.png'))))
                            ->author(Spatie\SchemaOrg\Schema::organization()->name('Strings N\' Beats')->email('info@stringsnbeats.net')->logo(Spatie\SchemaOrg\Schema::imageObject()->url(asset('statics/logo-small.png'))))
                            ->sameAs(array('https://www.facebook.com/StringsNBeatsNepal/','https://www.instagram.com/stringsnbeats/','https://www.twitter.com/strings_beats'))->toScript() !!}
@endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> --}}
    @if(Request()->route()->getPrefix() == '/panel')
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    @endif
@livewireStyles
@stack('styles')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HS0XEPQE5K"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-HS0XEPQE5K');
    </script>
    <script data-ad-client="ca-pub-2094944997068259" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
@if(Request()->route()->getPrefix() != '/panel')
<body>
    {{ $slot }}
@else
{!! Robots::metaTag() !!}
<body class="hold-transition sidebar-mini">
    <div class="wrapper" data-turbolinks="false">
        @livewire('admin.components.navbar')
        @livewire('admin.components.sidebar')
        {{ $slot }}
        @livewire('admin.components.footer')
    </div>
@endif
<script src="{{ asset('js/app.js') }}" defer></script>
@if(Request()->route()->getPrefix() == '/panel')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
@endif
@livewireScripts()
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@stack('scripts')
</body>
</html>
