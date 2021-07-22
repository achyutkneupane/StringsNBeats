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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    @if(Request()->route()->getPrefix() == '/panel')
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    @endif
@livewireStyles
@stack('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60c351e4485ac10011d3049d&product=sop' async='async'></script>
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
<script>
    (function() {
        var link = document.createElement('link');
        link.rel = "stylesheet";
        link.href = "https://fonts.googleapis.com/css?family=Nunito";
        document.querySelector("head").appendChild(link);
    })();
</script>
</body>
</html>
