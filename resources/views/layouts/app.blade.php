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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    @if(Request()->route()->getPrefix() == '/panel')
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    @endif
@livewireStyles
@stack('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60c351e4485ac10011d3049d&product=sop' async='async'></script>
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','G-HS0XEPQE5K');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HS0XEPQE5K"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-HS0XEPQE5K');
    </script>
    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        
        ga('create', 'G-HS0XEPQE5K', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    <!-- Google Analytics -->
    <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', 'G-HS0XEPQE5K', 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <!-- End Google Analytics -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=G-HS0XEPQE5K"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script data-ad-client="ca-pub-2094944997068259" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
@if(Request()->route()->getPrefix() != '/panel')
<body>
    {{ $slot }}
@else
{!! Robots::metaTag() !!}
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @livewire('admin.components.navbar')
        @livewire('admin.components.sidebar')
        {{ $slot }}
        @livewire('admin.components.footer')
    </div>
@endif
<script src="{{ asset('js/app.js') }}" defer></script>
@if(Request()->route()->getPrefix() == '/panel')
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
@endif
@livewireScripts()
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
@stack('scripts')
</body>
</html>
