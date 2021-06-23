<div class="container">
    @section('title',$article->title)
    <div class="row">
        @livewire('pages.components.navbar')
        <div class="col-12">
            <div class="container">
                <div class="d-flex justify-content-between row">
                    <div class="col-md-9 d-flex flex-column">
                        <div class="text-white card bg-dark">
                            <img class="card-img" src="{{ asset('storage/'.$article->featured_image) }}" style="opacity: 0.2" alt="{{ $article->title }} - {{ config('app.name') }}">
                            <div class="text-center align-middle card-img-overlay d-flex flex-column justify-content-center">
                                <h1 class="card-title text-capitalize">{{ $article->title }}</h1>
                            </div>
                        </div>
                        <h5 class="mt-2 text-capitalize">
                            Category: <strong>{{ $article->category->title }}</strong>
                        </h5>
                        <h5 class="text-muted">
                            Posted <b>{{ $article->created_at->diffForHumans() }}</b>
                        </h5>
                        <div class="mt-4 text-justify articleText">
                            {!! $article->content !!}
                        </div>
                        <div class="py-3 my-2 col-12">
                            <h2>Comments</h2>
                            @livewire('pages.components.comments', ['articleId' => $article->id])
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex flex-column">
                            <h5 class="py-1 my-2 text-white col-12 font-weight-bold text-uppercase bg-danger">
                                Latest News
                            </h5>
                            @foreach($latests as $latest)
                            @livewire('pages.components.home.post-component', ['articleId' => $latest->id])
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
<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
<meta name="title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ asset('storage/'.$article->featured_image) }}">
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="@yield('title') - {{ config('app.name', 'Laravel') }}">
<meta property="twitter:description" content="{{ $description }}">
<meta property="twitter:image" content="{{ asset('storage/'.$article->featured_image) }}">
@endpush