<div class="flex-row col-12 d-flex justify-content-between">
    <div class="container-fluid">
        <div class="my-2 row">
            <div class="col-lg-12">
                <div class="d-flex flex-column">
                    <div class='px-4 text-center d-flex flex-column flex-lg-row justify-content-center align-items-center w-100 bg-danger'>
                        <h1 class='pt-2 text-white' style='font-size: 1.3rem;'>
                            {{ $song->title }} - {{ $song->artists->first()->name }}
                        </h1>
                    </div>
                    <div class='my-2 row'>
                        <div class='col-lg-5 d-flex flex-column justify-content-center'>
                            <img src='{{ $song->image->getUrl('big') }}' width='100%' alt='{{ $song->title }} - {{ config('app.name') }}' title='{{ $song->title }} - {{ config('app.name') }}'>
                        </div>
                        <div class='col-lg-7 d-flex flex-column justify-content-center'>
                            <div class='flex-row my-1 d-flex w-100'>
                                <div class='text-justify w-100'>
                                    {{ $song->summary }}
                                </div>
                            </div>
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Artist:
                                </strong>
                                <div class='w-60'>
                                    @foreach($song->artists as $artist)
                                    @if($loop->last)
                                    {{ ucwords($artist->name) }}
                                    @else
                                    {{ ucwords($artist->name) }},
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @if($song->duration)
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Duration:
                                </strong>
                                <div class='w-60'>
                                    {{ $song->duration }}
                                </div>
                            </div>
                            @endif
                            @if($song->composer)
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Composed by:
                                </strong>
                                <div class='w-60'>
                                    {{ ucwords($song->composer) }}
                                </div>
                            </div>
                            @endif
                            @if($song->lyricist)
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Written by:
                                </strong>
                                <div class='w-60'>
                                    {{ ucwords($song->lyricist) }}
                                </div>
                            </div>
                            @endif
                            @if($song->lyricist)
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Arranged by:
                                </strong>
                                <div class='w-60'>
                                    {{ ucwords($song->arranger) }}
                                </div>
                            </div>
                            @endif
                            @if($song->genre)
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Genre:
                                </strong>
                                <div class='w-60'>
                                    {{ ucwords($song->genre) }}
                                </div>
                            </div>
                            @endif
                            @if($song->recorded_at)
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Recorded At:
                                </strong>
                                <div class='w-60'>
                                    {{ Carbon\Carbon::parse($song->recorded_at)->isoFormat('Do MMM YYYY') }}
                                </div>
                            </div>
                            @endif
                            @if($song->released_at)
                            <div class='flex-row my-1 d-flex w-100'>
                                <strong class='w-40'>
                                    Released At:
                                </strong>
                                <div class='w-60'>
                                    {{ Carbon\Carbon::parse($song->released_at)->isoFormat('Do MMM YYYY') }}
                                </div>
                            </div>
                            @endif
                            <div class="my-4 sharethis-inline-share-buttons" style='z-index: 9;'></div>
                        </div>
                    </div>
                    <hr />
                    <div class='container'>
                        <div class='row'>
                            <div class='col-lg-5'>
                                <div class='py-2 d-flex flex-column'>
                                    <h3>
                                        Lyrics
                                    </h3>
                                    {{-- <div class='flex-row d-flex justify-content-center'>
                                        @if($song->lyrics_en)<a href='' class='btn btn-danger'>Romanized</a>@endif
                                        @if($song->lyrics_en && $song->lyrics_np)<div class='px-4'> | </div>@endif
                                        @if($song->lyrics_np)<a href='' class='btn btn-danger'>नेपाली</a>@endif
                                    </div> --}}
                                    <div>
                                        {!! $song->lyrics_en !!}
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-7 d-flex flex-column articleText'>
                                <p class='mt-4 mb-0'>
                                    <iframe src="https://www.youtube.com/embed/{{ $song->youtube }}?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </p>
                                @if($song->noodle)
                                <p class='my-0'>
                                    <a href='https://noodlerex.com.np/songs/{{ $song->noodle }}' target='_blank' ref='nofollow'><img src='{{ asset('statics/buy-from-noodle.webp') }}' loading='lazy' width='100%' alt="Buy from Noodle - Strings N' Beats" title="Buy from Noodle - Strings N' Beats"></a>
                                    
                                </p>
                                @endif
                                @if($song->noodle)
                                    <a href='https://open.spotify.com/track/{{ $song->spotify }}' target='_blank' ref='nofollow' loading='lazy' class='mt-2 text-center'><img src='{{ asset('statics/listen-on-spotify.webp') }}' width="40%" alt="Listen on Spotify - Strings N' Beats" title="Listen on Spotify - Strings N' Beats"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    .w-40 {
        width: 40% !important;
    }
    .w-60 {
        width: 60% !important;
    }
    strong {
        font-weight: 900 !important;
    }
</style>
@endpush
@push('scripts')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60c351e4485ac10011d3049d&product=sop' async='async'></script>
@endpush