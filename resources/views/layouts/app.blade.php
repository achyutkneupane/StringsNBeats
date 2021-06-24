<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
</head>
@if(Request()->route()->getPrefix() != '/panel')
<body>
    {{ $slot }}
</body>
@else
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @livewire('admin.components.navbar')
        @livewire('admin.components.sidebar')
        {{ $slot }}
        @livewire('admin.components.footer')
    </div>
</body>
@endif

<script src="{{ asset('js/app.js') }}" defer></script>
@if(Request()->route()->getPrefix() == '/panel')
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
@else
<script async src="https://www.googletagmanager.com/gtag/js?id=G-HS0XEPQE5K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-HS0XEPQE5K');
</script>
@endif
@livewireScripts()
@stack('scripts')
</html>
