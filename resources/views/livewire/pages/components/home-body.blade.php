<div class="flex-row col-12 d-flex justify-content-between">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex flex-column">
                    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                        News
                    </h3>
                    <div class="flex-wrap d-flex justify-content-center row">
                        @if($newss->count() > 0)
                        @foreach($newss as $news)
                        <div class="col-md-3">
                            @livewire('pages.components.home.post-component', ['articleId' => $news->id])
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-6 text-center border py-2 h5">
                            No News published
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                        New Releases
                    </h3>
                    <div class="flex-wrap d-flex justify-content-center">
                        @if($releases->count() > 0)
                        @foreach($releases as $release)
                        <div class="col-md-6">
                            @livewire('pages.components.home.post-component', ['articleId' => $release->id])
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-9 text-center border py-2 h5">
                            No Articles published
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                        Articles
                    </h3>
                    <div class="flex-wrap d-flex justify-content-center">
                        @if($articles->count() > 0)
                        @foreach($articles as $article)
                        <div class="col-md-6">
                            @livewire('pages.components.home.post-component', ['articleId' => $article->id])
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-9 text-center border py-2 h5">
                            No Articles published
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-12">
                @livewire('pages.components.home.popular-posts')
            </div>
        </div> --}}
    </div>
</div>