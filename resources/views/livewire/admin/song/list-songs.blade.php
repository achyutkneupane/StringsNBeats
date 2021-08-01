<div>
    @section('title',$title)
    <div class="pt-4 content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <div class="card col-lg-10">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">All Songs</h5>
                                        <a class="px-3 py-2 btn btn-success" href="">+ Add</a>
                                    </div>
                                    <p class="card-text">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                              <tr class="text-center">
                                                <th scope="col">ID</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Artist</th>
                                                <th scope="col">Album</th>
                                                <th scope="col">Articles</th>
                                                <th scope="col" class="text-right">Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody class="user-select-none">
                                                @if($songs->count() > 0)
                                                @foreach ($songs as $song)
                                                <tr>
                                                    <th scope="row">{{ $song->id }}</th>
                                                    <td>
                                                        {{ ucwords($song->title) }}
                                                    </td>
                                                    <td>
                                                        @foreach($song->artists as $artist)
                                                        @if($loop->last)
                                                        {{ ucwords($artist->name) }}
                                                        @else
                                                        {{ ucwords($artist->name) }},
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ $song->album ? $song->album->name : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {{ $song->articles->count() }}
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="{{ route('adminEditSong',$song->id) }}" class="btn btn-warning">Edit</a>
                                                        <a class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No songs till now. Click <b>+Add</b> to add new.
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
@endpush
@push('scripts')
@endpush