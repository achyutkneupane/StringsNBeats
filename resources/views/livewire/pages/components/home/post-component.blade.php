<a href="{{ route('viewArticle',$article->slug) }}">
    <div class="my-1 d-flex flex-column">
        <div style="object-fit: cover; overflow: hidden; width:100%; height:250px;"><img src="{{ $article->cover->getUrl('medium') }}" alt="{{ $article->title }} - {{ config('app.name') }}" title="{{ $article->title }} - {{ config('app.name') }}" style="width:100%; height: 100%;"></div>
        <div class="pt-3 text-center">
            <h5>{{ $article->title }}</h5>
        </div>
    </div>
</a>