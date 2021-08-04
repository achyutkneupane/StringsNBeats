<div class="flex-row col-12 d-flex justify-content-between">
    <div class="container-fluid">
        <div class="row my-2">
            <div class="col-lg-12">
                <div class="d-flex flex-column">
                    <div class='d-flex flex-column flex-lg-row justify-content-between align-items-center w-100 text-center bg-danger px-4'>
                        <h1 class='text-white pt-2' style='font-size: 1.5rem;'>
                            {{ $title }}
                        </h1>
                        <div class='py-2 songsBar'>
                            <input type="text" class='form-control' wire:model='q' placeholder='Search for the songs'>
                        </div>
                    </div>
                    @if($songs->count() > 0)
                    <div class='d-flex flex-wrap justify-content-center my-4'>
                    @foreach($songs as $song)
                    @livewire('pages.components.song.song-component', ['song' => $song],key(time().$loop->index.$song->id))
                    @endforeach
                    </div>
                    @if($all != 'all')
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
                    @endif
                    @else
                    <div class='w-100 text-center px-4 py-2 border mt-4'>
                        No results found
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
    .songsBar {
        width: 100%;
    }
    @media (min-width: 992px) {
        .songsBar {
            max-width: 35%;
        }
    }
</style>
@endpush