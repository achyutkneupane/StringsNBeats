<div class='fullPage container'>
    @section('title','Login')
    <div class="row">
        @livewire('pages.components.navbar')
        @livewire('pages.components.login')
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
<title>Login - {{ config('app.name', 'Laravel') }}</title>
<meta name="title" content="Login - {{ config('app.name', 'Laravel') }}">
<meta name="description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
<meta property="og:type" content="website">
<meta property="fb:app_id" content="935868386814250">
<meta property="fb:pages" content="108590381445890">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="Login - {{ config('app.name', 'Laravel') }}">
<meta property="og:description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
<meta property="og:image" content="{{ asset('statics/ogimage.jpg') }}">
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="Login - {{ config('app.name', 'Laravel') }}">
<meta property="twitter:description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
<meta property="twitter:image" content="{{ asset('statics/ogimage.jpg') }}">
@endpush