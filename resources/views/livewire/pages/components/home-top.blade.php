<div class="flex-row col-12 d-flex justify-content-between">
    <div class="container-fluid">
        <div class="row">
            <div id="featuredArticles" class="mt-2 carousel slide col-md-8" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($featured as $article)
                    <a class="carousel-item{{ $loop->first ? ' active' : '' }}" href="{{ route('viewArticle',$article->slug) }}">
                        <img class="d-block w-100" src="{{ asset('storage/'.$article->featured_image) }}" style="opacity: 0.3" alt="Third slide" height="400">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="text-dark text-uppercase h2">{{ $article->title }}</div>
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
            <div class="col-md-4">
                <div class="d-flex flex-column">
                    <h3 class="py-1 my-2 text-white col-12 font-weight-bold text-uppercase bg-danger">
                        Latest Articles
                    </h3>
                    @if($latests->count() > 0)
                    @foreach($latests as $latest)
                    <a href="{{ route('viewArticle',$latest->slug) }}" class="flex-row my-1 d-flex col-12 row">
                        <div class="col-4"><img src="{{ asset('storage/'.$latest->featured_image) }}" width="100%"></div>
                        <div class="pl-4 col-8">
                            <h5>{{ $latest->title }}</h5>
                        </div>
                    </a>
                    @endforeach
                    @else
                    <div class="col-md-12 text-center border py-2 h5">
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