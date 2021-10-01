<div class='fullPage container'>
    @section('title',$article->title)
    <div class="row">
        @livewire('pages.components.navbar')
        <div class="col-12">
            <div class="container">
                <div class="d-flex flex-column flex-lg-row justify-content-between">
                    <div class="col-12 col-lg-9">
                        <div class='d-flex flex-column'>
                            <div class="text-white card bg-dark">
                                <img class="card-img" src="{{ $article->cover ? $article->cover->getUrl('big') : '' }}" style="opacity: 0.2" alt="{{ $article->title }} - {{ config('app.name') }}" title="{{ $article->title }} - {{ config('app.name') }}" loading='lazy' width='800'>
                                <div class="text-center align-middle card-img-overlay d-flex flex-column justify-content-center">
                                    <h1 class="card-title text-capitalize articleTitle">
                                        {{ $article->title }}<span style='display:none'> - Strings N' Beats</span>
                                    </h1>
                                </div>
                            </div>
                            <h5 class="mt-2 text-capitalize">
                                Category: <a href='{{ route('viewCategory',$article->category->slug) }}'><strong>{{ $article->category->title }}</strong></a>
                            </h5>
                            <h5 class="text-muted">
                                Posted <b>{{ $article->created_at->diffForHumans() }}</b>
                            </h5>
                            <div class="my-4 sharethis-inline-share-buttons" style='z-index: 9;'></div>
                            @if($article->writer_flag)
                            <h4 class="card-title text-capitalize articleTitle">
                                Written by: <a href='https://facebook.com/{{ $article->writer->facebook_link }}' target='_blank' class='text-danger'>{{ $article->writer->name }}</a>
                            </h4>
                            @endif
                            <div class="mt-2 text-justify articleText">
                                {!! $article->content !!}
                            </div>
                            <div class="my-4 sharethis-inline-share-buttons" style='z-index: 9;'></div>
                            <div class="py-3 my-2 col-12">
                                <h2>Comments</h2>
                                @livewire('pages.components.comments', ['articleId' => $article->id])
                            </div>
                            <div class="d-flex flex-column">
                                <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                                    Related Articles
                                </h3>
                                <div class="flex-wrap d-flex justify-content-center">
                                    @if($artistArticles->count() > 0)
                                    @foreach($artistArticles as $article)
                                    <div class="col-lg-4">
                                        @livewire('pages.components.home.post-component', ['article' => $article])
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="py-2 text-center border col-lg-9 h5">
                                        No Articles published
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="d-flex flex-column">
                            <h5 class="py-1 my-2 text-white col-12 font-weight-bold text-uppercase bg-danger">
                                Latest News
                            </h5>
                            @foreach($latests as $latest)
                            @livewire('pages.components.home.post-component', ['article' => $latest])
                            @endforeach
                        </div>
                        <div class="d-flex flex-column mt-4">
                            <h5 class="py-1 my-2 text-white col-12 font-weight-bold text-uppercase bg-danger">
                                Populars
                            </h5>
                            @foreach($populars as $popular)
                            @livewire('pages.components.home.post-component', ['article' => $popular])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @livewire('pages.components.footer')
    </div>
</div>
@push('meta_tags')
    <title>@yield('title')</title>
    <meta name="title" content="@yield('title')">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta property='article:published_time' content='{{ $article->created_at }}' />
    <meta property='article:section' content='article' />
    <meta property='article:author' content='https://www.facebook.com/StringsNBeatsNepal' />
    <meta property='article:publisher' content='https://www.facebook.com/StringsNBeatsNepal' />
    <meta property="fb:app_id" content="931301841077172">
    <meta property="fb:pages" content="108590381445890">

    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $coverImage }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $coverImage }}">
    <meta name="twitter:site" content="@strings_beats">
    {!! $schemaScripts !!}
    <link rel="amphtml" href="{{ strtolower(route('viewAmpArticle',$slug)) }}">
@endpush
@push('scripts')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60c351e4485ac10011d3049d&product=sop' async='async'></script>
@endpush