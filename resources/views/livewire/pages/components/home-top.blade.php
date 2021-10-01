<div class="flex-row col-12 d-flex justify-content-between">
    <div class="container-fluid">
        <div class="row">
            <div id="featuredArticles" class="mt-2 carousel slide col-lg-8" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($featured as $article)
                    <a class="carousel-item{{ $loop->first ? ' active' : '' }}" href="{{ route('viewArticle',$article->slug) }}">
                        <img class="d-block w-100" src="{{ $article->cover->getUrl('big') }}" style="opacity: 0.3" alt="{{ $article->title }} - {{ config('app.name') }}" title="{{ $article->title }} - {{ config('app.name') }}"  loading='lazy' width='800'>
                        <div class="carousel-caption">
                            <div class="text-dark text-uppercase h2" style='z-index: 30;'>{{ $article->title }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#featuredArticles" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#featuredArticles" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="col-lg-4">
                <div class="d-flex flex-column">
                    <h3 class="py-1 my-2 text-white col-12 font-weight-bold text-uppercase bg-danger">
                        Latest Articles
                    </h3>
                    @if($latests->count() > 0)
                    @foreach($latests as $latest)
                    <a href="{{ route('viewArticle',$latest->slug) }}" class="flex-row my-1 ml-0 d-flex col-lg-12 row">
                    <div class="px-0 col-4 row" style="width:100%;"><img src="{{ $latest->cover->getUrl('small') }}" alt="{{ $latest->title }} - {{ config('app.name') }}" title="{{ $latest->title }} - {{ config('app.name') }}" class="px-0 col-12" loading='lazy' width='150' height='100'></div>
                        <div class="pl-4 col-8 d-flex flex-column justify-content-center">
                            <h6>{{ $latest->title }}</h6>
                        </div>
                    </a>
                    @endforeach
                    @else
                    <div class="py-2 text-center border col-lg-12 h5">
                        No Articles published
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@section('styles')
@endsection