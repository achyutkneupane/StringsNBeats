<div class="container">
    <div class="row">
        @livewire('pages.components.navbar', ['q' => $q])
        @if($q == '')
        @livewire('pages.components.home-top')
        @livewire('pages.components.home-body')
        @else
        <div class="col-lg-12">
            <div class="d-flex flex-column">
                <div class='d-flex flex-row justify-content-center align-items-center w-100 text-center bg-danger px-4'>
                    <h1 class='text-white pt-2' style='font-size: 1.5rem;'>
                        Search result for {{ $q }}
                    </h1>
                </div>
            </div>
        </div>
        @if($articles->count() > 0)
        @foreach($articles as $article)
            <a class='w-100 border p-2 d-flex flex-column flex-lg-row my-3' href='{{ route('viewArticle',$article->slug) }}'>
                <div class='img-thumbnail w-100'>
                    <img class='w-lg-25 w-100' src='{{ $article->cover->getUrl('medium') }}'>
                </div>
                <div class='d-flex flex-column px-0 px-lg-4 justify-content-center'>
                    <h3 class='text-justify'>
                        {{ $article->title }}
                    </h3>
                    <span class='text-muted'>
                        Written <b>{{ $article->created_at->diffForHumans() }}</b> @if($article->writer_flag)by <b>{{ $article->writer->name }}</b>@endif
                    </span>
                    <div class='text-justify'>
                        {{ substr( strip_tags($article->content), 0, 300) }}...
                    </div>
                </div>
            </a>
        @endforeach
        @else
        <div class='w-100 text-center px-4 py-2 border my-4'>
            Nothing found under query '{{ $q }}'
        </div>
        @endif
        @endif
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
    <title>{{ config('app.name', 'Laravel') }} || Primary Destination for Nepali Music Contents</title>
    <meta name="title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="description" content="Strings N’ Beats is the primary destination for Nepali music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
    <meta name="keywords" content="Strings N' Beats,StringsNBeats,stringsnbeats,stringsnbeats.net,stringsnbeats.com,stringsnbeatsnepal,music,Nepal,Nepali,Nepalese Music,Lyrics,Cover">
    <meta property='article:published_time' content='{{ Carbon\Carbon::create('2021', '6', '6') }}' />
    <meta property='article:section' content='website' />

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}">
    <meta property="og:description" content="Strings N’ Beats is the primary destination for Nepali music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
    <meta property="og:image" content="{{ asset('statics/ogimage.jpg') }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="Strings N’ Beats is the primary destination for Nepali music related matter and stories surrounding it all. We keep you updated on worldwide exclusive news, videos, events and more.">
    <meta name="twitter:image" content="{{ asset('statics/ogimage.jpg') }}">
    <meta name="twitter:site" content="@strings_beats">
@endpush