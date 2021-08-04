<div class="flex-row col-12 d-flex justify-content-between">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-column">
                    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                        News
                    </h3>
                    <div class="flex-wrap d-flex justify-content-center row">
                        @if($newss->count() > 0)
                        @foreach($newss as $news)
                        <div class="col-lg-3">
                            @livewire('pages.components.home.post-component', ['article' => $news])
                        </div>
                        @endforeach
                        <div class='col-12 text-center py-2'>
                            <a class='btn btn-danger' href='{{ route('viewCategory','news') }}'>View All</a>
                        </div>
                        @else
                        <div class="py-2 text-center border col-lg-6 h5">
                            No News published
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex flex-column">
                    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                        New Releases
                    </h3>
                    <div class="flex-wrap d-flex justify-content-center">
                        @if($releases->count() > 0)
                        @foreach($releases as $release)
                        <div class="col-lg-6">
                            @livewire('pages.components.home.post-component', ['article' => $release])
                        </div>
                        @endforeach
                        <div class='col-12 text-center py-2'>
                            <a class='btn btn-danger' href='{{ route('viewCategory','new-releases') }}'>View All</a>
                        </div>
                        @else
                        <div class="py-2 text-center border col-lg-9 h5">
                            No Articles published
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex flex-column">
                    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                        Articles
                    </h3>
                    <div class="flex-wrap d-flex justify-content-center">
                        @if($articles->count() > 0)
                        @foreach($articles as $article)
                        <div class="col-lg-6">
                            @livewire('pages.components.home.post-component', ['article' => $article])
                        </div>
                        @endforeach
                        <div class='col-12 text-center py-2'>
                            <a class='btn btn-danger' href='{{ route('viewCategory','articles') }}'>View All</a>
                        </div>
                        @else
                        <div class="py-2 text-center border col-lg-9 h5">
                            No Articles published
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-column">
                    <h3 class="py-1 mt-4 text-center text-white col-12 font-weight-bold text-uppercase bg-danger">
                        Songs
                    </h3>
                    <div class="flex-wrap d-flex justify-content-center row">
                        @if($songs->count() > 0)
                        @foreach($songs as $song)
                        <div class="col-lg-3">
                            @livewire('pages.components.song.song-component', ['song' => $song])
                        </div>
                        @endforeach
                        <div class='col-12 text-center py-2'>
                            <a class='btn btn-danger' href='{{ route('listSongs') }}'>View All</a>
                        </div>
                        @else
                        <div class="py-2 text-center border col-lg-6 h5">
                            Nothing Here
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                @livewire('pages.components.home.popular-posts')
            </div>
        </div> --}}
    </div>
</div>