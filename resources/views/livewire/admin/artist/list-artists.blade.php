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
                                        <h5 class="card-title">All Artists</h5>
                                        <a class="px-3 py-2 btn btn-success" href="{{ route('adminAddArtist') }}">+ Add</a>
                                    </div>
                                    <p class="card-text">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                              <tr class="text-center">
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Slug</th>
                                                <th scope="col">Articles</th>
                                                <th scope="col">Albums</th>
                                                <th scope="col">Songs</th>
                                                <th scope="col" class="text-right">Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody class="user-select-none">
                                                @if($artists->count() > 0)
                                                @foreach ($artists as $artist)
                                                <tr>
                                                    <th scope="row">{{ $artist->id }}</th>
                                                    <td>
                                                        {{ $artist->name }}
                                                    </td>
                                                    <td>
                                                        {{ $artist->slug }}
                                                    </td>
                                                    <td>
                                                        {{ $artist->articles->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $artist->albums->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $artist->songs->count() }}
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="" class="btn btn-warning">Edit</a>
                                                        <a wire:click="deleteArtist({{ $artist->id }})" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No artists till now. Click <b>+Add</b> to add new.
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