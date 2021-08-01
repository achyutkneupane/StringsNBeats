<div>
    @section('title',$title)
    <div class="pt-4 content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between row">
                            <div class="col-lg-6">
                                <div class="col-12 card">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <div class="container">
                                                <div class="form-row">
                                                    <button class="mb-3 btn btn-outline-danger" wire:click="editSong" wire:loading.attr='disabled'>
                                                        <div wire:loading wire:target='editSong'>
                                                            Saving
                                                        </div>
                                                        <div wire:loading.remove wire:target='editSong' data-turbolinks="false">
                                                            Publish
                                                        </div>
                                                    </button>
                                                    <div class="form-group col-lg-12">
                                                        <label>Title</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songTitle" placeholder="Enter Title">
                                                        @error('songTitle')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songName" placeholder="Enter Alternate Title(If Any)">
                                                        @error('songName')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Slug</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songSlug" placeholder="Enter Slug">
                                                        @error('songSlug')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Composer</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songComposer" placeholder="Enter Composer Name">
                                                        @error('songComposer')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Arranger</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songArranger" placeholder="Enter Arranger Name">
                                                        @error('songArranger')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Lyricist</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songLyricist" placeholder="Enter Lyricist Name">
                                                        @error('songLyricist')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Genre</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songGenre" placeholder="Enter Genre">
                                                        @error('songGenre')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Duration</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songDuration" placeholder="Enter Duration">
                                                        @error('songDuration')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>ISRC Code</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songISRCCode" placeholder="Enter ISRC Code">
                                                        @error('songISRCCode')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Youtube Link</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songYoutube" placeholder="Enter Youtube Link">
                                                        @error('songYoutube')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Spotify Link</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songSpotify" placeholder="Enter Spotify Link">
                                                        @error('songSpotify')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Noodle Link</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songNoodle" placeholder="Enter Noodle Link">
                                                        @error('songNoodle')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Description</label>
                                                        <textarea class="form-control" wire:model.lazy="songDescription" placeholder="Enter Description"></textarea>
                                                        @error('songDescription')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Summary</label>
                                                        <textarea class="form-control" wire:model.lazy="songSummary" placeholder="Enter Summary"></textarea>
                                                        @error('songSummary')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12" wire:ignore>
                                                        <div class="d-flex justify-content-between">
                                                            <label for="artists">Artists</label>
                                                        </div>
                                                        <select class="form-control select2" id="artists" wire:model.lazy="artists" multiple="multiple">
                                                            @foreach($artistList as $artist)
                                                                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('artists')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-12 card">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label>Recorded At</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songRecordedAt" placeholder="Enter Recorded At Date">
                                                        @error('songRecordedAt')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Released At</label>
                                                        <input type="text" class="form-control" wire:model.lazy="songReleasedAt" placeholder="Enter Released At Date">
                                                        @error('songReleasedAt')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Lyrics (En)</label>
                                                        <textarea class="form-control" wire:model.lazy="songLyricsEn" placeholder="Enter Lyrics in En" rows='20'></textarea>
                                                        @error('songLyricsEn')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Lyrics (Np)</label>
                                                        <textarea class="form-control" wire:model.lazy="songLyricsNp" placeholder="Enter Lyrics in Np" rows='20'></textarea>
                                                        @error('songLyricsNp')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Featured Image</label>
                                                        <div class="container pb-4">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    @if($featuredImageView)
                                                                    <img src="{{ $featuredImage }}" width="100%">
                                                                    @elseif(!$featuredImage)
                                                                    <img src="https://sewabsnlchq.com/wp-content/uploads/2020/10/gallery-dummy-img-1.jpg" width="100%">
                                                                    @else
                                                                    <img src="{{ $featuredImage->temporaryUrl() }}" width="100%">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="file" class="form-control-file" wire:model.lazy='featuredImage'>
                                                        @error('featuredImage')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
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
</div>

@push('styles')
<link href="{{ asset('admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<style>

.select2-selection__choice {
    -webkit-box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0, 0, 0, 0.05) !important;
    -moz-box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0, 0, 0, 0.05) !important;
    box-shadow: 0 0 2px #ffffff inset, 0 1px 0 rgba(0, 0, 0, 0.05) !important;
    color: black !important;
    border: 1px solid #aaaaaa !important;
    }
</style>
@endpush
@push('scripts')
<script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}" defer></script>
<script>
    $(document).ready(function() {
        $('#artists').select2({
            placeholder: "Select an Artist",
            allowClear: true,
            tags: true,
        });
        $('#artists').on('change', function (e) {
            var data = $('#artists').select2("val");
            @this.set('artists', data);
        });
    });
</script>
@endpush