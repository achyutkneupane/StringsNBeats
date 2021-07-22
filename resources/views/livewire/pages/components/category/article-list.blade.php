<div class="flex-row col-12 d-flex justify-content-between">
    <div class="container-fluid">
        <div class="row my-2">
            <div class="col-lg-12">
                <div class="d-flex flex-column">
                    <div class='d-flex flex-column flex-lg-row justify-content-between align-items-center w-100 text-center bg-danger px-4'>
                        <h1 class='text-white pt-2' style='font-size: 1.5rem;'>
                            {{ $category->title }}
                        </h1>
                        <div class='py-2 categoryBar'>
                            <input type="text" class='form-control' wire:model='q' placeholder='Search Article in {{ $category->title }}'>
                        </div>
                    </div>
                    @if($articles->count() > 0)
                    @foreach($articles as $article)
                    <a class='w-100 border p-2 d-flex flex-column flex-lg-row my-3' href='{{ route('viewArticle',$article->slug) }}'>
                        <div class='img-thumbnail w-100'>
                            <img class='w-lg-25 w-100' src='{{ $article->cover->getUrl('medium') }}' alt="{{ $article->title }} - {{ config('app.name') }}" title="{{ $article->title }} - {{ config('app.name') }}" loading='lazy' width='300' height='300'>
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
                    <div
                        x-data="{
                            observe () {
                                let observer = new IntersectionObserver((entries) => {
                                    entries.forEach(entry => {
                                        if (entry.isIntersecting) {
                                            @this.call('loadMore')
                                        }
                                    })
                                }, {
                                    root: null
                                })

                                observer.observe(this.$el)
                            }
                        }"
                        x-init="observe"
                    ></div>
                    @else
                    <div class='w-100 text-center px-4 py-2 border mt-4'>
                        No {{ strtolower($category->title) }} found
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-12 text-center my-4">
                <div wire:loading wire:target='loadMore'>
                    <img src='{{ asset('statics/loader.gif') }}' alt='Loader - Strings N Beats' title='Loader - Strings N Beats' width="40%" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    .categoryBar {
        width: 100%;
    }
    @media (min-width: 992px) {
        .categoryBar {
            max-width: 35%;
        }
    }
</style>
@endpush