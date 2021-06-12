<div>
    @section('title',$title)
    <div class="pt-4 content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between row">
                            <div class="col-lg-8">
                                <div class="col-12 card">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label for="articleTitle">Title</label> (<a href="{{ route('viewArticle',$article->slug) }}" target="_blank">View Article</a>)
                                                        <input type="text" class="form-control" wire:model.lazy="articleTitle" placeholder="Enter Title">
                                                        @error('articleTitle')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row" wire:ignore>
                                                    <div class="form-group col-lg-12 row-editor">
                                                        <label>Content</label>
                                                        @error('articleContent')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        <textarea id="articleContent" wire:model.defer="articleContent">{{ $articleContent }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="col-12 card">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12 d-flex flex-row justify-content-between">
                                                        <div class="text-center d-flex flex-row">
                                                            <div class="p-1">Featured:</div>
                                                            <label class="switch">
                                                                <input type="checkbox" wire:model='featured'>
                                                                <span class="slider round"></span><br>
                                                            </label>
                                                        </div>
                                                        {{-- <button class="btn btn-outline-primary">Save as draft</button> --}}
                                                        <button class="btn btn-outline-danger ml-2" wire:click="editArticle">Publish</button>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label for="articleCategory">Category</label>
                                                        <select class="form-control" wire:model.lazy="articleCategory">
                                                            <option value="" disabled>Select a category</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}"{{ $category->id == $articleCategory ? ' selected' : '' }}>{{ $category->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('articleCategory')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <div class="d-flex justify-content-between">
                                                            <label for="articleTags">Tags</label>
                                                        </div>
                                                        <div class="d-flex flex-row my-2">
                                                            <input type="text" wire:model.lazy='addTagValue' class="form-control" placeholder="Enter Tag Title">
                                                            <button class="btn btn-danger py-1 ml-2" wire:click="addTag">Add</button>
                                                        </div>
                                                        @error('addTagValue')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        <select class="form-control" id="articleTags" wire:model.lazy="articleTags" multiple="multiple">
                                                            @foreach($tags as $tag)
                                                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('articleTags')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <div class="d-flex justify-content-between">
                                                            <label for="artists">Artists</label>
                                                        </div>
                                                        <div class="d-flex flex-row my-2">
                                                            <input type="text" wire:model.lazy='addArtistValue' class="form-control" placeholder="Enter Artist Name">
                                                            <button class="btn btn-danger py-1 ml-2" wire:click="addArtist">Add</button>
                                                        </div>
                                                        @error('addArtistValue')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        <select class="form-control" id="artists" wire:model.lazy="artists" multiple="multiple">
                                                            @foreach($artistList as $artist)
                                                                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('artists')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label>Featured Image</label>
                                                        <div class="container pb-4">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    @if($featuredImageView)
                                                                    <img src="{{ asset('storage/'.$featuredImage) }}" width="100%">
                                                                    @elseif($featuredImage)
                                                                    <img src="{{ $featuredImage->temporaryUrl() }}" width="100%">
                                                                    @else
                                                                    <img src="https://sewabsnlchq.com/wp-content/uploads/2020/10/gallery-dummy-img-1.jpg" width="100%">
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    /* The slider */
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: red;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: green;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px green;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $('#articleContent').summernote({
        placeholder: 'Enter Article Content',
        tabsize: 2,
        height: 600,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table'],
            ['insert', ['link', 'video']],
            ['mybutton', ['hello']]
        ],
        callbacks: {
            onChange: function(e) {
                    @this.set('articleContent', e);
            },
        }
    });
</script>
@endpush