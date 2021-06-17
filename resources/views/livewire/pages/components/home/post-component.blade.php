<a href="{{ route('viewArticle',$article->slug) }}">
    <div class="my-1 d-flex flex-column">
        <div class="row" style="object-fit: cover; overflow: hidden;"><img style="width:200px; height:200px;" src="{{ asset('storage/'.$article->featured_image) }}" class="col-12"></div>
        <div class="pt-3 text-center">
            <h5>{{ $article->title }}</h5>
        </div>
    </div>
</a>