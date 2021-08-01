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
                                                        <label for="articleTitle">Title</label>
                                                        <input type="text" class="form-control" wire:model.lazy="articleTitle" placeholder="Enter Title">
                                                        @error('articleTitle')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12" wire:ignore>
                                                        <label>Content</label>
                                                        @error('articleContent')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        <textarea wire:model='articleContent' id="articleContent">
                                                        </textarea>
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
                                                    <div class="flex-row form-group col-lg-12 d-flex justify-content-between">
                                                        <div class="flex-row text-center d-flex">
                                                            <div class="p-1">Featured:</div>
                                                            <label class="switch">
                                                                <input type="checkbox" wire:model='featured'>
                                                                <span class="slider round"></span><br>
                                                            </label>
                                                        </div>
                                                        <div class="justify-content-end">
                                                            <button class="btn btn-outline-primary" wire:click="saveAsDraft">Draft</button>
                                                            <button class="ml-2 btn btn-outline-danger" wire:click="storeArticle">Publish</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label for="articleDescription">Description</label>
                                                        <textarea type="text" class="form-control" wire:model.lazy="articleDescription" placeholder="Enter Description"></textarea>
                                                        @error('articleDescription')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row" wire:ignore>
                                                    <div class="form-group col-lg-12">
                                                        <div class="d-flex justify-content-between">
                                                            <label for="articleSongs">Songs</label>
                                                        </div>
                                                        <select class="form-control select2" id="articleSongs" wire:model.lazy="articleSongs" multiple="multiple">
                                                            @foreach($songs as $song    )
                                                                <option value="{{ $song->id }}">{{ $song->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('articleSongs')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label for="articleCategory">Category</label>
                                                        <select class="form-control" wire:model.lazy="articleCategory">
                                                            <option value="" disabled selected>Select a category</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('articleCategory')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row" wire:ignore>
                                                    <div class="form-group col-lg-12">
                                                        <div class="d-flex justify-content-between">
                                                            <label for="articleTags">Tags</label>
                                                        </div>
                                                        <select class="form-control select2" id="articleTags" wire:model="articleTags" multiple="multiple">
                                                            @foreach($tags as $tag)
                                                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('articleTags')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row" wire:ignore>
                                                    <div class="form-group col-lg-12">
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
                                                <div class="form-row">
                                                    <div class="form-group col-lg-12">
                                                        <label>Featured Image</label>
                                                        <div class="container pb-4">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    @if($featuredImage)
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
<link href="{{ asset('admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
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
<script src="https://cdn.tiny.cloud/1/p47paciinlfiov1oumn6ftva8g3x4qwt5z2z3258ayqs6lf4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function() {
        $('#articleTags').select2({
            placeholder: "Select a tag",
            allowClear: true,
            tags: true,
        });
        $('#articleSongs').select2({
            placeholder: "Select songs",
            allowClear: true,
            tags: true,
        });
        $('#artists').select2({
            placeholder: "Select an Artist",
            allowClear: true,
            tags: true,
        });
        $('#articleTags').on('change', function (e) {
            var data = $('#articleTags').select2("val");
            @this.set('articleTags', data);
        });
        $('#articleSongs').on('change', function (e) {
            var data = $('#articleSongs').select2("val");
            @this.set('articleSongs', data);
        });
        $('#artists').on('change', function (e) {
            var data = $('#artists').select2("val");
            @this.set('artists', data);
        });
    });
    tinymce.init({
        selector: 'textarea#articleContent',
        height: 800,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist | blockquote media ',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
                @this.set('articleContent', editor.getContent());
            });
        },
    });
</script>
@endpush