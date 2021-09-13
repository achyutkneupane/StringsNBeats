<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <h5 class="nav-link">
          @yield('title')
        </h5>
      </li>
    </ul>
    <ul class="ml-auto navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <title>@yield('title') - Admin Panel - {{ config('app.name', 'Laravel') }}</title>
  <meta name="title" content="@yield('title') - Admin Panel - {{ config('app.name', 'Laravel') }}">
  <meta name="description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('title') - Admin Panel - {{ config('app.name', 'Laravel') }}">
  <meta property="og:description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
  <meta property="og:image" content="{{ asset('statics/ogimage.jpg') }}">
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="@yield('title') - Admin Panel - {{ config('app.name', 'Laravel') }}">
  <meta property="twitter:description" content="Strings N’ Beats is the primary destination for music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
  <meta property="twitter:image" content="{{ asset('statics/ogimage.jpg') }}">