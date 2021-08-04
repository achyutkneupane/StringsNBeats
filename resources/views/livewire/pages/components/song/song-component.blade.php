<a class='col-lg-4 py-1' href='{{ route('viewSong',$song->slug) }}'>
    <div class='text-center py-2'>
        <img src='{{ $song->image ? $song->image->getUrl('medium') : 'https://dummyimage.com/300x300/ffffff/00CED1?text='.$song->slug }}' alt='{{ $song->title }} - {{ config('app.name') }}' title='{{ $song->title }} - {{ config('app.name') }}' loading='lazy' class='w-100 object-cover' width='300' height='300'>
        <h3 class='my-2'>
            {{ $song->title }}
        </h3>
        <h6 class='text-muted'>
            @foreach($song->artists as $artist)
            @if($loop->last)
            {{ ucwords($artist->name) }}
            @else
            {{ ucwords($artist->name) }},
            @endif
            @endforeach
        </h6>
    </div>
</a>