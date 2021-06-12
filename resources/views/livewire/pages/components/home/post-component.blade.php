<a href="{{ route('viewArticle',$article->slug) }}">
    <div class="my-1 d-flex flex-column">
        <div class="row"><img src="{{ asset('storage/'.$article->featured_image) }}" class="col-12"></div>
        <div class="pt-3 pl-4 text-center">
            <h5>{{ $article->title }}</h5>
        </div>
    </div>
</a>